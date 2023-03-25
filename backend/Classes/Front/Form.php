<?php

namespace Classes\Front;

use Classes\Front\DotPay;

/**
 * Application register Form
 */
class Form {
    
    /**
     * GET request parametrs
     * @var array|false
     */
    private $get;
    
    /**
     * POST request parametrs
     * @var array|false
     */
    private $post;
    
    /**
     * Packet id
     * @var int 
     */
    private $packet_id;
    
    /**
     * Trening position in list
     * @var int 
     */
    private $trening_id;

    /**
     * Accommodation position in list
     * @var int
     */
    private $accommodation_id;
    
    /**
     * New order token
     * @var string 
     */
    private $newOrderToken;
    
    
    /**
     * Set request parametrs
     */
    public function setRequest()
    {
        $this->get = filter_input_array(INPUT_GET);
        $this->post = filter_input_array(INPUT_POST);
    }
    
    
    /**
     * Using Get method
     */
    public function useGet ()
    {
        $this->packet_id = $this->get['pakiet'];
        $this->trening_id = $this->get['warsztat'];
        $this->accommodation_id = $this->get['noclegi'];
    }
    
    
    /**
     * Using Post method
     */
    public function usePost ()
    {
        $this->packet_id = $this->post['pakiet'];
        $this->trening_id = $this->post['warsztat'];
        $this->accommodation_id = $this->post['noclegi'];
    }

    
    /**
     * Get post data
     *
     * @param bool $key
     * @return array|mixed|null
     */
    public function getPostData ($key = false)
    {
        if ($key) {
            return isset($this->post[$key]) ? $this->post[$key] : null;
        } else {
            return $this->post;
        }
    }
    
    
    /**
     * Check form send status
     * 
     * @return boolean
     */
    public function isSubmited()
    {
        return $this->post && isset($this->post['payment-form-send']) ? true : false;
    }

    
    /**
     * Get form build data
     * 
     * @return array|boolean
     */
    public function getFormData ()
    {
        $packet = false;
        $packetID = $this->packet_id;
        $treningPos = $this->trening_id;
    
        if ($packetID) {
            $packet = get_post(intval($packetID));
        }

        // redirect if not has Packet post
        if (!$packet || $packet->post_type !== 'packet') {
            return false;
        }

        // Current packet title
        $currentTitle = $packet->post_title;
        $currentDesc = get_field('description', $packetID);
        if ($currentDesc) {
            $currentTitle .= " - " . strip_tags(trim(preg_replace('/\s+/', ' ', $currentDesc)));
        }

        // Current price
        $currentPrice = get_field('cena', $packetID) ?: get_field('cena_stara', $packetID) ?: 0;

        // packets list
        $packetsSelect = false;
        $packetsArray = ['list' => [], 'active' => intval($packetID)];
        $packets = get_posts(['numberposts' => -1, 'post_type' => 'packet', 'order' => 'ASC']);
        foreach ($packets as $value) {
            $title = $value->post_title;
            $price = get_field('cena', $value->ID);
            if ($price) {
                $title .= " - " . $price .' zł';
            }
            $packetsArray['list'][$value->ID] = $title;
        }
        if (!empty($packetsArray['list'])) {
            $packetsArray['select_html'] = $this->selectHtmlGenerate ($packetsArray, 'packet', 'Wybrana Opcje');
            $packetsSelect = $packetsArray;
        }

        // get trenings list
        $treningsSelect = false;
        $trenings = get_field('option_trenings', $packetID);
        if ($trenings) {
            $treningsList  = preg_split('/\r\n|\r|\n/', $trenings);
            $treningsArray = ['list' => [], 'active' => intval($treningPos)];
            foreach ($treningsList as $value) {
                $value = strip_tags($value);
                if ($value !== '') {
                    $treningsArray['list'][] = $value;
                }
            }
            if (!empty($treningsArray['list'])) {
                $treningsArray['select_html'] = $this->selectHtmlGenerate ($treningsArray, 'trening', 'Wybrany warsztat');
                $treningsSelect = $treningsArray;
            }
        }

        // accommodation
        $accommodation = get_field('noclegi', $packetID);
        if ($accommodation) {
            $accommodation = $this->accommodation_id;
        } else {
            $accommodation = null;
        }

        // get sale
        $sale = 0;
        $sales = get_field('sales', $packetID);

        if ($sales) {
            foreach ($sales as $item) {
                if ($item['code'] === $this->post['sale']) {
                    $sale = $item['sale'];
                }
            }
        }

        // dates
        $dates = null;
        $datesList = get_field('dates_list', $packetID);
        if ($datesList && is_array($datesList) && !empty($datesList)) {
            $dates = $datesList;
        }

        // return form data
        return [
            'title'         => $currentTitle,
            'price'         => $currentPrice,
            'packets'       => $packetsSelect, 
            'trenings'      => $treningsSelect,
            'sale'          => $sale,
            'accommodation' => $accommodation,
            'packet_id'     => $packetID,
            'dates'         => $dates,
        ];
    }
    
    
    /**
     * Form: post data validation
     * 
     * @param string $key
     * @return boolean
     */
    public function formValid ($key)
    {
        if ($key === 'post') {
            return false;
        }
        
        return true;
    }


    /**
     * Check sale by Ajax
     *
     * @return mixed
     */
    public function checkSaleAjax ()
    {
        $data = $this->getFormData();
        if ($data['sale'] && $data['sale'] > 0) {
            return $data['price'] - $data['sale'];
        }
    }


    /**
     * Run DotPay payment form generation
     *
     * @param array $settings
     * @return string
     */
    public function dotPayRenderForm ($settings)
    {
        //$DotpayId = 474381;
        //$DotpayPin = 'I6bFDJOqV7rYLs7hzRaILYsFbp3WxQ0L';

        $data = $this->getFormData();
        $apiV               = $settings['dotPay']['api'];
        $DotPayId           = $settings['dotPay']['id'];
        $DotPayPin          = $settings['dotPay']['pin'];
        $Environment        = $settings['dotPay']['environment'];
        $Currency           = $settings['dotPay']['currency'];
        $url                = $settings['url'] . '?token=' . $this->newOrderToken;
        // $urlC            = $settings['url'] . '?token=' . $this->newOrderToken .'&urlc=yes';
        $RedirectionMethod  = 'POST';

        // random control string
        $control = substr(
            str_shuffle(
                str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(12/strlen($x)))
            ),
            1,
            12
        );
        
        $ParametersArray = [
            "api_version"   => $apiV,
            'url'           => $url,
            'currency'      => $Currency,
            'control'       => $control,
            'type'          => 4,

            //'type'        => 3,
            //'urlc'        => $urlC,
            //'buttontext'  => 'Wróć do skłepu'
        ];
        
        if (isset($this->post['firstname']) && !empty($this->post['firstname'])) {
            $ParametersArray['firstname'] = $this->post['firstname'];
        }
        if (isset($this->post['lastname']) && !empty($this->post['lastname'])) {
            $ParametersArray['lastname'] = $this->post['lastname'];
        }
        if (isset($this->post['email']) && !empty($this->post['email'])) {
            $ParametersArray['email'] = $this->post['email'];
        }
        if (isset($this->post['phone']) && !empty($this->post['phone'])) {
            $ParametersArray['phone'] = $this->post['phone'];
        }
        if (isset($this->post['city']) && !empty($this->post['city'])) {
            $ParametersArray['city'] = $this->post['city'];
        }
        if (isset($this->post['street']) && !empty($this->post['street'])) {
            $ParametersArray['street'] = $this->post['street'];
        }
        if (isset($this->post['postcode']) && !empty($this->post['postcode'])) {
            $ParametersArray['postcode'] = $this->post['postcode'];
        }
        $ParametersArray['description'] = $data['title'];

        // Price
        if ($data['sale'] && $data['sale'] > 0) {
            $ParametersArray['amount'] = number_format ($data['price'] - $data['sale'], 2, '.', false);
        } else {
            $ParametersArray['amount'] = number_format ($data['price'], 2, '.', false);
        }

        $dotpay = new DotPay();
        return $dotpay->dotPayGenerateChkRedirection($DotPayId, $DotPayPin, $Environment, $RedirectionMethod, $ParametersArray);
    }


    /**
     * Get form: transfer payment method
     *
     * @param array $settings
     * @return string
     */
    public function transferPaymentForm ($settings) 
    {
        $output  = '<form method="GET" action="' .$settings['url']. '">';
        $output .= '<input type="hidden" name="token" value="'. $this->newOrderToken .'">';
        $output .= '<input type="hidden" name="status" value="TRANSFER">';
        $output .= '</form>';

        return $output;
    }


    /**
     * Check Payment status
     */
    public function checkPaymentStatus ()
    {
        // $urlc   = $this->get['urlc'];
        $status = $this->get['status'];
        $token  = $this->get['token'];
        
        if ($status == 'OK' || $status == 'TRANSFER') {
            // get Order by ID
            $orders = $this->getOrederByToken($token);
            
            if (empty($orders)) {
                $order = false;
                $status = 'FAIL';
            } else {
                $order = $orders[0];
            }
            
            // Send mail
            if ($order && !$order->mail_sended) {
                $this->sendMail($order, $status);
            } 
        }
        
        return ($status == 'OK' || $status == 'FAIL' || $status == 'TRANSFER') ? $status : false;
    }

    
    /**
    * Generate select HTML by data
    * 
    * @param array $data
    * @param string $name
    * @return string
    */
    private function selectHtmlGenerate ($data, $name, $label = false)
    {
       $output = '';

       // html: label
       if ($label) {
           $output .= '<label for="form-'. $name .'">'. $label .'</label>';
       }

       // html: select
       $output .= '<select name="'. $name .'" id="form-'. $name .'">';
       foreach ($data['list'] as $key => $value) {
           if ($key == $data['active']) {
               $output .= '<option value="'. $key .'" selected>'. $value .'</option>';
           } else {
               $output .= '<option value="'. $key .'">'. $value .'</option>';
           }

       }
       $output .= '</select>';

       return $output;
    }

    
    /**
     * Insert order data to database
     * 
     * @global object $wpdb
     * @param array $data
     * @return boolean|string
     */
    public function insertDataToDB ($data)
    {
        $formData = $this->getFormData();
        if (!$formData) { return false; }
        
        // create order token
        $this->newOrderToken = substr(md5(uniqid(rand(20, 30), true)), 0, 40);
        
        $insertData = [
            'token'             => $this->newOrderToken,
            'packet_id'         => $data['pakiet'],
            'packet_title'      => $formData['title'],
            'trening'           => null,
            'price'             => $formData['price'],
            'personal'          => serialize ([
                'firstname'     => $data['firstname'],
                'lastname'      => $data['lastname'],
                'email'         => $data['email'],
                'phone'         => $data['phone']
            ]),
            'invoice'           => serialize ([
                'currency'      => 'zł',
                'sale'          => $data['sale'] ? ($data['sale'].' (zniżka '.$formData['sale'].'zł)') : '- brak',
                'sale_value'    => $formData['sale'],
                'type'          => $data['invoice-type'],
                'company'       => isset($data['company'])  ? $data['company']  : '',
                'nip'           => isset($data['nip'])      ? $data['nip']      : '',
                'name'          => isset($data['name'])     ? $data['name']     : '',
                'surname'       => isset($data['surname'])  ? $data['surname']  : '',
                'street'        => $data['street'],
                'house'         => $data['house'],
                'apartment'     => $data['apartment'],
                'city'          => $data['city'],
                'postcode'      => $data['postcode'],
            ]),
            'payment'           => ($data['payment-type'] === 'dotpay') ? 'DotPay' : 'Przelew tradycyjny', 
            'payment-status'    => 'Nowe',
            'message'           => $data['message'],
            'regulations'       => isset($data['regulations'])  ? 'Tak' : 'Nie',
            'rodo'              => isset($data['rodo'])         ? 'Tak' : 'Nie',
            'marketing'         => isset($data['marketing'])    ? 'Tak' : 'Nie',
            'accommodation'     => serialize ([
                'type'          => isset($data['accommodation'])            ? $data['accommodation']            : null,
                'firstname'     => isset($data['accommodation-firstname'])  ? $data['accommodation-firstname']  : null,
                'lastname'      => isset($data['accommodation-lastname'])   ? $data['accommodation-lastname']   : null,
            ]),
            'date'              => isset($data['form-date']) && $data['form-date'] ? $data['form-date'] : null,
            'create_at'         => (new \DateTime('now'))->format('Y-m-d H:i:s'),
            'error_message'		=> null
        ];
        
        // set trening data
        if ( isset($formData['trenings']['list']) && !empty($formData['trenings']['list']) && isset($data['warsztat']) ) {
            $insertData['trening'] = $formData['trenings']['list'][$data['warsztat']];
        }
        
        // db driver
        global $wpdb;
        
        // form table name
        $table_name = $wpdb->prefix . 'orders';

        // save to db
        return $wpdb->insert($table_name, $insertData);
    }
    
    
    /**
     * Get order by token
     * 
     * @global object $wpdb
     * @param string $token
     * @return array
     */
    private function getOrederByToken ($token)
    {
        // db driver
        global $wpdb;
        
        // form table name
        $table_name = $wpdb->prefix . 'orders';
        
        return $wpdb->get_results("SELECT * FROM {$table_name} WHERE token = '{$token}'");
    }
    
    
    /**
     * Send order mail
     * 
     * @param object $data
     */
    private function sendMail ($data)
    {
        // send to email
        $email = get_field('send_to_email', $data->packet_id);
        
        // email title
        $subject = 'Nowa rejestracja na stronie "'. get_bloginfo('name').'" - '. $data->payment;

        $personal = unserialize($data->personal);
        $invoice = unserialize($data->invoice);
        $accommodation = unserialize($data->accommodation);
        
        // mail: message body
        $msg  = '<table style="width:100%;max-width:600px">';
            // Date
            if ($data->date) {
                $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Data:</strong></td><td>'. $data->date .'</td>
                        </tr>';
            }

            // Packet
            $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Pakiet:</strong></td><td>'. $data->packet_title .'</td>
                    </tr>';
            
            // Trening
            $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Warsztat:</strong></td><td>'. $data->trening .'</td>
                    </tr>';

            // Price
            $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Cena:</strong></td><td>'. $data->price . $invoice['currency'] .'</td>
                    </tr>';

            // Sale
            $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Kod rabatowy:</strong></td><td>'. $invoice['sale'] .'</td>
                        </tr>';

            // Price after Sale
            if (floatval($invoice['sale_value']) > 0) {
                $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Cena po rabacie:</strong></td><td>'.
                            (floatval($data->price) - floatval($invoice['sale_value'])) . $invoice['currency']
                        .'</td>
                    </tr>';
            }
            
            // Payment
            $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Płatnośc:</strong></td><td>'. $data->payment .'</td>
                    </tr>';
            
            // Personal data
            $msg .= '<tr style="vertical-align: top;">
                        <td colspan="2"><br><strong>Dane osobowe</strong></td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Imię:</strong></td><td>'. $personal['firstname'] .'</td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Nazwisko:</strong></td><td>'. $personal['lastname'] .'</td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>E-mail:</strong></td><td>'. $personal['email'] .'</td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Telefon:</strong></td><td>'. $personal['phone'] .'</td>
                    </tr>';
            
            // Invoice
            $msg .= '<tr style="vertical-align: top;">
                        <td colspan="2"><br><strong>Dane do faktury</strong></td>
                    </tr>';
            if ($invoice['type'] == 'company') {
                $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Faktura na:</strong></td><td>Firmę</td>
                        </tr>
                        <tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Nazwa firmy:</strong></td><td>'. $invoice['company'] .'</td>
                        </tr>
                        <tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>NIP:</strong></td><td>'. $invoice['nip'] .'</td>
                        </tr>';
            } else {
                $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Faktura na:</strong></td><td>Osobę prywatną</td>
                        </tr>
                        <tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Imię:</strong></td><td>'. $invoice['name'] .'</td>
                        </tr>
                        <tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Nazwisko:</strong></td><td>'. $invoice['surname'] .'</td>
                        </tr>';
            }
            $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Ulica:</strong></td><td>'. $invoice['street'] .'</td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Nr.budynku:</strong></td><td>'. $invoice['house'] .'</td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Nr.lokalu:</strong></td><td>'. $invoice['apartment'] .'</td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Miasto:</strong></td><td>'. $invoice['city'] .'</td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Kod pocztowy:</strong></td><td>'. $invoice['postcode'] .'</td>
                    </tr>';

            // accommodation
            $msg .= '<tr style="vertical-align: top;">
                        <td colspan="2"><br><strong>Noclegi</strong></td>
                    </tr>';
                    if ($accommodation['type'] == null || $accommodation['type'] == 0) {
                        $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Współlokator w pokoju:</strong></td><td>Brak</td>
                        </tr>';
                    } elseif ($accommodation['type'] == 1) {
                        $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Współlokator w pokoju:</strong></td><td>Wybrana osoba</td>
                        </tr>';
                        if ($accommodation['firstname']) {
                            $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                                <td><strong>Imię:</strong></td><td>'. $accommodation['firstname'] .'</td>
                            </tr>';
                        }
                        if ($accommodation['lastname']) {
                            $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                                <td><strong>Nazwisko:</strong></td><td>'. $accommodation['lastname'] .'</td>
                            </tr>';
                        }
                    } elseif ($accommodation['type'] == 2) {
                        $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Współlokator w pokoju:</strong></td><td>Losowa osoba</td>
                        </tr>';
                    } elseif ($accommodation['type'] == 3) {
                        $msg .= '<tr style="background: #f1f1f1; vertical-align: top;">
                            <td><strong>Współlokator w pokoju:</strong></td><td>Pokój jednoosobowy</td>
                        </tr>';
                    }
            
            // checkboxes
            $msg .= '<tr style="vertical-align: top;">
                        <td colspan="2"><br><strong>Zgody</strong></td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Regulamin:</strong></td><td>'. $data->regulations .'</td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Rodo:</strong></td><td>'. $data->rodo .'</td>
                    </tr>
                    <tr style="background: #f1f1f1; vertical-align: top;">
                        <td><strong>Marketing:</strong></td><td>'. $data->marketing .'</td>
                    </tr>';
            
            // message
            if (!empty($data->message)) {
                $msg .= '<tr style="vertical-align: top;">
                            <td colspan="2"><br><strong>Wiadomość:</strong></td>
                        </tr>
                        <tr style="background: #f1f1f1; vertical-align: top;">
                            <td colspan="2">'. nl2br($data->message) .'</td>
                        </tr>';
            }

            // mail: message footer
            $msg .= '<tr><td colspan="2">--</td></tr>';
            $msg .= '<tr><td colspan="2">Wiadomośc wysłana przez: '. site_url('/') .'</td></tr>';
        $msg .= '<table>';

        // headers
        $headers = array('Content-Type: text/html; charset=UTF-8');

        // send emails
        try {
            // send email to admin
            $isSent = wp_mail($email, $subject, $msg, $headers);

            // update order send mail status
            if ($isSent) $this->updateOrderSendMailStatus($data->id);
            else $this->setErrorMessageToOrder($data->id, "MAILS SENDING DON'T WORK");

            // send email to user
            if ( isset($personal['email']) && !empty($personal['email']) ) {
                $this->sendMailToUser($personal['email'], $msg, $headers, $data->payment);
            }
        } catch (\Exception $e) {
            $this->setErrorMessageToOrder($data->id, $e->getMessage());
        }
    }
    
    
    /**
     * Send registation confirm message
     * 
     * @param string $email
     * @param string $msg
     * @param array $headers
     * @param string $payment
     */
    private function sendMailToUser ($email, $msg, $headers, $payment)
    {
        $thankPageId = 269;
        
        if ($payment === 'DotPay') {
            $subject  = strip_tags(get_field('ok_title', $thankPageId));
            $content  = apply_filters('the_content', get_post_field('post_content', $thankPageId));
            
            $message  = '<div style="width:100%;max-width:600px;background-color:#e8e8e8;color:#353535;padding:10px 5px">';
            if ($content) { $message .= $content . '<br>'; }
            $message .=  $msg;
            $message .=  '</div>';
        } else {
            $subject  = strip_tags(get_field('transfer_title', $thankPageId));
            $content  = get_field('transfer', $thankPageId);
            
            $message  = '<div style="width:100%;max-width:600px;background-color:#e8e8e8;color:#353535;padding:10px 5px">';
            if ($content) { $message .= $content . '<br>'; }
            $message .=  $msg;
            $message .=  '</div>';
        }
        
        // send email to user
        wp_mail($email, $subject, $message, $headers);
    }
    
    
    /**
     * Update order send mail status
     * 
     * @global object $wpdb
     * @param int $order_id
     */
    private function updateOrderSendMailStatus ($order_id) 
    {
        // db driver
        global $wpdb;
        
        // form table name
        $table_name = $wpdb->prefix . 'orders';
        
        // update record
        $wpdb->update($table_name, ['mail_sended' => 1], ['id' => $order_id]);
    }


    /**
     * @global object $wpdb
     * @param int $order_id
     * @param string|null $message
     */
    private function setErrorMessageToOrder ($order_id, $message)
    {
        // db driver
        global $wpdb;

        // form table name
        $table_name = $wpdb->prefix . 'orders';

        // update record
        $wpdb->update($table_name, ['error_message' => $message], ['id' => $order_id]);
    }
}
