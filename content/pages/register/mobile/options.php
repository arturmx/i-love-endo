<?php $count = 0; ?>
<?php foreach ($options as $row) : ?>
    <div class="row option--row pos-<?php echo $count++ % 2; ?>">
        <div class="col-9 col-sm-10 text-left option-name">
            <?php echo $row->description; ?>
        </div>
        <div class="col-3 col-sm-2 text-right pdr">
            <?php if (has_term($row->name, 'option', $packet->ID)) : ?>
            <img src="<?php echo public_uri(); ?>/img/svg/love.svg" alt="check" class="check">
            <?php endif; ?>
        </div>
    </div>
<?php endforeach;