<section class="page--default page--register-form">
    <h1><?php the_title(); ?></h1>
    
    <div class="container">
        <div class="form-wrapper">
            <h2><?php echo $form_data['title']; ?></h2>
            
            <form method="POST">

                <?php if ($form_data['dates']) : ?>
                    <!-- data -->
                    <h3 class="mt20"><?php pll_e('Data'); ?></h3>
                    <div class="checkbox-radio-body radio clearfloat" style="margin: 10px 0 20px;">
                        <?php foreach ($form_data['dates'] as $key => $value) { if (isset($value['data'])) { ?>
                            <label>
                                <input type="radio" name="form-date" 
                                    value="<?php echo $value['data']; ?>" 
                                    <?php echo $key == 0 ? 'checked="checked"' : ''; ?>
                                >
                                <span><?php echo $value['data']; ?></span>
                            </label>
                        <?php } } ?>
                    </div>
                <?php endif; ?>

                <!-- packet -->
                <div class="packet-body">
                    <?php echo $form_data['packets'] ? $form_data['packets']['select_html'] : ''; ?>
                </div>

                <!-- trening -->
                <div class="trenings-body">
                    <?php echo $form_data['trenings'] ? $form_data['trenings']['select_html'] : ''; ?>
                </div>

                <h3 class="mt40">Dane osobowe</h3>
                <p class="grey">Wypełnij uważnie poniższe pola.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <input type="text" name="firstname" placeholder="Imię">
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" name="lastname" placeholder="Nazwisko">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <input type="email" name="email" placeholder="Adres e-mail">
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" name="phone" placeholder="Numer telefonu">
                    </div>
                </div>

                <!-- accommodation -->
                <input type="hidden" name="accommodation" value="<?php echo $form_data['accommodation']; ?>">
                <?php if ($form_data['accommodation'] == 1) : ?>
                    <h3 class="mt20"><?php pll_e('Współlokator w pokoju'); ?></h3>
                    <p class="grey"><?php pll_e('Wpisz dane osoby do zameldowania w pokoju'); ?>.</p>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <input type="text" name="accommodation-firstname" placeholder="Imię">
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" name="accommodation-lastname" placeholder="Nazwisko">
                        </div>
                    </div>
                <?php elseif ($form_data['accommodation'] == 2) : ?>
                    <h3 class="mt20"><?php pll_e('Współlokator w pokoju'); ?></h3>
                    <div class="mb40">
                        <p><?php pll_e('Losowa osoba'); ?></p>
                    </div>
                <?php elseif ($form_data['accommodation'] == 3) : ?>
                    <h3 class="mt20"><?php pll_e('Współlokator w pokoju'); ?></h3>
                    <div class="mb40">
                        <p>
                            <?php pll_e('Pokój jednoosobowy'); ?> -
                            <b style="color:#d52212">
                                <?php pll_e('dodatkowo platne'); ?> 
                                <?php the_field('cena_noclegi', $form_data['packet_id']); ?> zł
                            </b>
                        </p>
                    </div>
                <?php endif; ?>
                
                <h3 class="mt20">Dane do faktury</h3>
                <p class="grey">Wypełnij uważnie poniższe pola.</p>
                
                <div class="invoice-info">
                    <div class="checkbox-radio-body radio clearfloat">
                        <label data-name="Nazwa firmy" data-nip="NIP" data-name-f="company" data-nip-f="nip">
                            <input type="radio" name="invoice-type" value="company" checked="checked">
                            <span>Faktura na firmę</span>
                        </label>
                        <label data-name="Imię" data-nip="Nazwisko" data-name-f="name" data-nip-f="surname">
                            <input type="radio" name="invoice-type" value="private">
                            <span>Faktura na osobę prywatną</span>
                        </label>
                    </div>
                    <div class="row main">
                        <div class="col-12 col-md-6">
                            <input type="text" class="invoice-name" name="company" placeholder="Nazwa firmy">
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" class="invoice-nip" name="nip" placeholder="NIP">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <input type="text" name="street" placeholder="Ulica">
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <input type="text" name="house" placeholder="Nr. budynku">
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="apartment" placeholder="Nr. lokalu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <input type="text" name="city" placeholder="Miasto">
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" name="postcode" placeholder="Kod pocztowy">
                        </div>
                    </div>
                </div>
                
                <div class="payment-info">
                    <div class="checkbox-radio-body radio clearfloat">
                        <label>
                            <input type="radio" name="payment-type" value="dotpay" checked="checked">
                            <span>Szybki przelew Przelewy24</span>
                        </label>
                        <label>
                            <input type="radio" name="payment-type" value="transfer">
                            <span>Przelew tradycyjny <br><small>(7 dni na płatność)</small></span>
                        </label>
                    </div>
                </div>

                <div class="sale-info">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <h3 class="mt40">Rabat</h3>
                            <p class="grey">Posiadasz kod rabatowy? Uzupełni poniższe pole.</p>
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <input type="text" name="sale-code" placeholder="Kod rabatowy">
                                </div>
                                <div class="col-12 col-md-4">
                                    <span class="button-default">Potwierdź</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 sale-col">
                            <h3 class="mt40">Cena po rabacie:</h3>
                            <p>&nbsp;</p>
                            <div class="sale-result"></div>
                        </div>
                    </div>
                </div>
                
                <h3 class="mt20">Uwagi</h3>
                <p class="grey">Napisz nam wszystkie niezbędne informacje</p>
                <textarea name="message" placeholder="Uwagi"></textarea>
                
                <div class="bottom">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="checkbox-radio-body checkbox">
                                <label>
                                    <input type="checkbox" name="regulations">
                                    <span>
                                        Zapoznałem się i akceptuję
                                        <a href="<?php the_field('regulations_file'); ?>" target="_blank">
                                            Regulaminem uczestnictwa w konferencji I Love Endo *
                                        </a>
                                    </span>
                                </label>
                            </div>
                            <div class="checkbox-radio-body checkbox">
                                <label>
                                    <input type="checkbox" name="rodo">
                                    <span>
                                        Zapoznałem się z
                                        <a href="<?php the_field('rodo_file'); ?>" target="_blank">
                                            Informacją o przetwarzaniu danych osobowych dla uczestników konferencji I Love Endo *
                                        </a>
                                    </span>
                                </label>
                            </div>
                            <div class="checkbox-radio-body checkbox">
                                <label>
                                    <input type="checkbox" name="marketing">
                                    <span>
                                        Wyrażam zgodę na otrzymywanie od Poldent sp. z o. o ofert i informacji handlowych drogą elektroniczną 
                                        z użyciem urządzeń telekomunikacyjnych na adres e-mail i numer telefonu podany przeze mnie w formularzu rejestracyjnym, 
                                        zgodnie z przepisami ustawy z dnia 18 lipca 2002 r. o świadczeniu usług drogą elektroniczną 
                                        (Dz. U. z 2002 r. Nr 144 poz. 1204 z późniejszymi zmianami).
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" name="payment-form-send" value="1">
                            <input type="submit" class="button-default" value="Zapisuję się">
                        </div>
                    </div>
                </div> 
            </form>
            
            <?php // var_dump($form_data); ?>
        </div>
    </div>
</section>