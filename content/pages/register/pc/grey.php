<div class="row option--row">
    <div class="col-12 col-lg-3 option-name">
        &nbsp; 
    </div>
    <div class="col-12 col-lg-9">
        <div class="row">
            <?php foreach($packets as $packet) : ?>
                <div class="col">
                    <span class="grey"><?php the_field('option_grey', $packet->ID); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>