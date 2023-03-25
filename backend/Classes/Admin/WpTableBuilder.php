<?php

namespace Classes\Admin;

class WpTableBuilder extends \WP_List_Table
{
    /**
     * Database object
     * @var object
     */
    protected $db;


    /**
     * Table name
     * @var string
     */
    protected $table;


    /**
     * GET data
     * @var array || null
     */
    public $get;


    /**
     * POST data
     * @var array || null
     */
    public $post;


    /**
     * REQUEST data
     * @var array || null
     */
    public $request;


    /**
     * Class construct
     *
     * @param string $table_name
     * @global object $wpdb
     */
    public function __construct($table_name)
    {
        parent::__construct( [
            'singular' => __('Record', 'AppCore'), //singular name of the listed records
            'plural'   => __('Records', 'AppCore'), //plural name of the listed records
            'ajax'     => false //should this table support ajax?
        ] );

        global $wpdb;
        $this->db = $wpdb;
        $this->table = $this->db->prefix . $table_name;

        $this->get = $_GET;
        $this->post = $_POST;
        $this->request = $_REQUEST;
    }


    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items()
    {
        // headers info
        $this->_column_headers = $this->get_column_info();

        /** Process bulk action */
        $this->process_bulk_action();

        $per_page     = $this->get_items_per_page('formrecords_per_page', $this->records_per_page());
        $current_page = $this->get_pagenum();
        $total_items  = $this->record_count();

        $this->set_pagination_args( [
            'total_items' => $total_items,  //WE have to calculate the total number of items
            'per_page'    => $per_page      //WE have to determine how many items to show on a page
        ] );

        // records
        $this->items = $this->get_db_records($per_page, $current_page);

        // table header
        $this->_column_headers = array(
            $this->get_columns(),		// columns
            array(),                            // hidden
            $this->get_sortable_columns(),	// sortable
        );
    }


    /**
     * Show records per page
     *
     * @return int
     */
    private function records_per_page ()
    {
        if ( isset($this->get['per_page']) ) {
            if ($this->get['per_page'] == 'all') {
                return 9999999;
            } else {
                return $this->get['per_page'];
            }
        }

        return 10;
    }


    /**
     * Get data from form table
     *
     * @param int $per_page
     * @param int $page_number
     * @return array
     */
    private function get_db_records ($per_page = 10, $page_number = 1)
    {
        $request = $this->request;
        $sql = "SELECT * FROM {$this->table}";

        // set rows filter
        $sql .= $this->setListSQLFilter();

        // order by
        if ( ! empty($request['orderby']) ) {
            $sql .= ' ORDER BY ' . esc_sql( $request['orderby'] );
            $sql .= ! empty( $request['order'] ) ? ' ' . esc_sql( $request['order'] ) : ' ASC';
        } else {
            $sql .= ' ORDER BY ID DESC';
        }

        // per page (for pagination)
        $sql .= " LIMIT $per_page";

        // offset (for pagination)
        $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

        $result = $this->db->get_results( $sql, 'ARRAY_A' );

        return $result;
    }


    /**
     * Set SQL filter
     *
     * @return string
     */
    private function setListSQLFilter () {
        $sql = '';
        $where = 'WHERE';

        // filter: post id
        if ( isset($this->get['post_id']) && !empty($this->get['post_id']) ) {
            $sql .= " {$where} post_id = {$this->get['post_id']}";
            $where = 'AND';
        }

        // filter: name
        if ( isset($this->get['name']) && !empty($this->get['name']) ) {
            $sql .= " {$where} name LIKE '%{$this->get['name']}%'";
            $where = 'AND';
        }

        // filter: email
        if ( isset($this->get['email']) && !empty($this->get['email']) ) {
            $sql .= " {$where} email = '{$this->get['email']}'";
            $where = 'AND';
        }

        // filter: phone
        if ( isset($this->get['phone']) && !empty($this->get['phone']) ) {
            $sql .= " {$where} phone LIKE '%{$this->get['phone']}%'";
            $where = 'AND';
        }

        // filter: message subject
        if ( isset($this->get['subject']) && !empty($this->get['subject']) ) {
            $sql .= " {$where} subject LIKE '%{$this->get['subject']}%'";
            $where = 'AND';
        }

        // filter: date from
        if ( isset($this->get['date_from']) && !empty($this->get['date_from']) ) {
            $sql .= " {$where} create_at >= '{$this->get['date_from']} 00:00:00'";
            $where = 'AND';
        }

        // filter: date to
        if ( isset($this->get['date_to']) && !empty($this->get['date_to']) ) {
            $sql .= " {$where} create_at <= '{$this->get['date_to']} 23:59:59'";
            $where = 'AND';
        }

        // filter: marketing_email
        if ( isset($this->get['email_only']) ) {
            $sql .= " {$where} marketing_email = 1";
            $where = 'AND';
        }

        // filter: marketing_sms
        if ( isset($this->get['sms_only']) ) {
            $sql .= " {$where} marketing_sms = 1";
            $where = 'AND';
        }

        return $sql;
    }


    /**
     * Delete record
     *
     * @param int $id recored id
     */
    private function delete_table_row ($id)
    {
        $this->db->delete(
            $this->table,
            ['ID' => $id],
            [ '%d' ]
        );
    }


    /**
     * Returns the count of records in the database.
     *
     * @return null|string
     */
    private function record_count() {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        $sql .= $this->setListSQLFilter();

        return $this->db->get_var($sql);
    }


    /**
     * Text displayed when no records data is available
     */
    public function no_items() {
        __('Brak wpisów', 'AppCore');
    }


    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     * @param string $column_name
     *
     * @return string
     */
    private function column_actions ( $item, $column_name )
    {
        $request = $this->request;

        // create a nonce
        $delete_nonce = wp_create_nonce('sp_delete_record');

        $title = '<strong>'. $item[$column_name] .'</strong>';

        $actions = [
            'delete' => sprintf(
                '<a href="?page=%s&action=%s&record=%s&_wpnonce=%s">'. __('Delete', 'AppCore') .'</a>',
                esc_attr( $request['page'] ),
                'delete',
                absint( $item['ID'] ),
                $delete_nonce
            )
        ];

        return $title . $this->row_actions( $actions ); // for admin
    }


    /**
     * Render a column when no column specific method exists.
     *
     * @param array $item
     * @param string $column_name
     *
     * @return mixed
     */
    public function column_default( $item, $column_name ) {
        switch ($column_name) {
            case 'create_at':
                return $this->column_actions ($item, $column_name);

            case 'regulations':
            case 'marketing_email':
            case 'marketing_sms':
                return $item[$column_name] ? '<span style="color:green">'. __('Tak', 'AppCore') .'</span>' :
                    '<span style="color:red">'. __('Nie', 'AppCore') .'</span>';

            case 'subject':
                return $item[$column_name] ? $item[$column_name] : '<span style="color:red">'. __('- Brak', 'AppCore') .'</span>';

            case 'post_id':
                return $item[$column_name]
                    ? '<a href="'. get_permalink($item[$column_name]) .'" target="_blank">'. get_the_title($item[$column_name]) .'</a>'
                    : '<span style="color:red">'. __('- Brak', 'AppCore') .'</span>';

            default:
                return $item[$column_name];
        }
    }


    /**
     * Render the bulk edit checkbox
     *
     * @param array $item
     *
     * @return string
     */
    protected function column_cb( $item )
    {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
        );
    }


    /**
     *  Associative array of columns
     *
     * @return array
     */
    public function get_columns()
    {
        $columns = [
            'cb'        => '<input type="checkbox" />',
            'create_at' => __('Data', 'AppCore'),
            'name'      => __('Imię i nazwisko', 'AppCore'),
            'email'     => __('E-mail', 'AppCore'),
        ];

        // contacts form
        if ($this->table == $this->db->prefix . 'form_contacts') {
            $columns['subject'] = __('Temat', 'AppCore');
            $columns['message'] = __('Wiadomość', 'AppCore');
        }

        // application forms
        if ($this->table == $this->db->prefix . 'form_default') {
            $columns['phone'] = __('Telefon', 'AppCore');
            $columns['regulations'] = __('Regulamin', 'AppCore');
            $columns['marketing_email'] = __('Marketing E-mail', 'AppCore');
            $columns['marketing_sms'] = __('Marketing SMS/MMS', 'AppCore');
            $columns['post_id'] = __('Oferta pracy', 'AppCore');
        }

        return $columns;
    }


    /**
     * Columns to make sortable.
     *
     * @return array
     */
    protected function get_sortable_columns() {
        $sortable_columns = array(
            'name'      => array('name', true),
            'email'     => array('email', true),
            'subject'   => array('subject', true),
            'create_at' => array('create_at', true),
            'post_id'   => array('post_id', true)
        );

        return $sortable_columns;
    }


    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    protected function get_bulk_actions() {
        $actions = ['bulk-delete' => __('Delete', 'AppCore')];

        return $actions;
    }


    /**
     * Bulk action process
     */
    private function process_bulk_action()
    {
        $request = $this->request;
        $post = $this->post;
        $get = $this->get;

        //Detect when a bulk action is being triggered...
        if ( 'delete' === $this->current_action() ) {

            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr( $request['_wpnonce'] );

            if ( ! wp_verify_nonce($nonce, 'sp_delete_record') ) {
                die( 'Go get a life script kiddies' );
            } else {
                $this->delete_table_row (absint($get['record']));
            }
        }

        // If the delete bulk action is triggered
        if (
            ( isset($post['action']) && $post['action'] == 'bulk-delete' ) ||
            ( isset($post['action2']) && $post['action2'] == 'bulk-delete' )
        ) {
            // id's to delete
            $delete_ids = esc_sql( $post['bulk-delete'] );

            // loop over the array of record IDs and delete them
            foreach ( $delete_ids as $id ) {
                $this->delete_table_row ($id);
            }
        }
    }
}