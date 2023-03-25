<div class="row option--row">
    <div class="col-12 col-lg-3 option-name">
        <?php pll_e('Wybierz warsztat'); ?>
    </div>
    <div class="col-12 col-lg-9">
        <div class="row">
            <?php foreach ($packets as $packet) : ?>
                <div class="col">
                    <?php $trenings = get_field('option_trenings', $packet->ID);
                        if ($trenings) : ?>
                        <div class="select-body trening-select" data-id="<?php echo $packet->ID; ?>">
                            <div class="active">- <?php pll_e('Wybierz'); ?></div>
                            <div class="select-list">
                                <?php echo $trenings; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>