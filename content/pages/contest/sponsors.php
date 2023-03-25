<div class="contest--sponsors">
    <div class="container">
        <p><?php pll_e('Sponsorzy nagród'); ?></p>

        <div class="row">
            <?php foreach (get_field('sponsors') as $item) : ?>
                <div class="col-6 col-md-3">
                    <?php if ($item['link']) : ?>
                        <a href="<?php echo $item['link']; ?>" target="_blank">
                        <?php endif; ?>
                        <div class="item">
                            <img src="<?php echo $item['logo']['sizes']['medium']; ?>" alt="<?php echo $item['logo']['title']; ?>">
                        </div>
                        <?php if ($item['link']) : ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>