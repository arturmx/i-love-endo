<?php $grey = get_field('option_grey', $packet->ID); if ($grey) : ?>
<div class="row option--row">
    <div class="col-12 text-left option-name pdr">
        <span class="grey"><?php echo $grey ?></span>
    </div>
</div>
<?php endif; 