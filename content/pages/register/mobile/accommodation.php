<?php $accommodation = get_field('noclegi', $packet->ID);
if ($accommodation) : ?>
    <div class="row option--row">
        <div class="col-5 col-sm-6 text-left option-name">
            <?php pll_e('Współlokator w pokoju'); ?>
        </div>
        <div class="col-7 col-sm-6 text-left pdr">
            <div class="select-body accommodation-select" data-id="<?php echo $packet->ID; ?>">
                <div class="active"><?php pll_e('Zakwaterowanie'); ?></div>
                <div class="select-list">
                    <p><?php pll_e('Wybrana osoba'); ?></p>
                    <p><?php pll_e('Losowa osoba'); ?></p>
                    <?php /* <p>
                        <?php pll_e('Pokój jednoosobowy'); ?> -<br>
                        <b>
                            <?php pll_e('dodatkowo platne'); ?> 
                            <?php the_field('cena_noclegi', $packet->ID); ?>zł
                        </b>
                    </p> */ ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;
