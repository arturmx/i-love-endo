<?php $price = get_field('cena', $packet->ID);
if ($price) : ?>
    <div class="row option--row pos-1">
        <div class="col-5 col-sm-6 text-left option-name">
            <?php pll_e('Cena'); ?>
        </div>
        <div class="col-7 col-sm-6 text-right pdr">
            <?php $oldPrice = get_field('cena_stara', $packet->ID);
                if ($oldPrice) : ?>
                <span class="old-price"><?php echo $oldPrice; ?>zł</span>
            <?php endif; ?>

            <span class="price"><?php echo $price; ?>zł</span>
        </div>
    </div>
<?php endif;
