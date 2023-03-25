<?php $count = 0; ?>
<?php foreach ($options as $row) : ?>
    <div class="row option--row pos-<?php echo $count++ % 2; ?>">
        <div class="col-12 col-lg-3 option-name">
            <?php echo $row->description; ?>
        </div>
        <div class="col-12 col-lg-9">
            <div class="row">
                <?php foreach($packets as $packet) : ?>
                    <div class="col">
                        <?php if (has_term($row->name, 'option', $packet->ID)) : ?>
                        <img src="<?php echo public_uri(); ?>/img/svg/love.svg" alt="check" class="check">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach;