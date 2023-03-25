<?php $trenings = get_field('option_trenings', $packet->ID);
if ($trenings) : ?>
    <div class="row option--row">
        <div class="col-5 col-sm-6 text-left option-name">
            <?php pll_e('Wybierz warsztat'); ?>
        </div>
        <div class="col-7 col-sm-6 text-left pdr">
            <div class="select-body trening-select" data-id="<?php echo $packet->ID; ?>">
                <div class="active">- <?php pll_e('Wybierz'); ?></div>
                <div class="select-list">
                    <?php echo $trenings; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;
