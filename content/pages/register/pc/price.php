<div class="row option--row pos-1">
    <div class="col-12 col-lg-3 option-name">
        <?php pll_e('Cena'); ?>
    </div>
    <div class="col-12 col-lg-9">
        <div class="row">
            <?php foreach ($packets as $packet) : ?>
                <div class="col">
                    <?php $oldPrice = get_field('cena_stara', $packet->ID);
                        if ($oldPrice) : ?>
                        <span class="old-price"><?php echo $oldPrice; ?>zł</span>
                    <?php endif; ?>

                    <span class="price"><?php the_field('cena', $packet->ID); ?>zł</span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>