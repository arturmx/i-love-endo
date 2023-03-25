<div class="row">
    <div class="col-12 col-lg-3">
        &nbsp; 
    </div>
    <div class="col-12 col-lg-9">
        <div class="row">
            <?php foreach($packets as $packet) : ?>
            <div class="col">
                <div class="packet-name" style="background-color: <?php the_field('background_color', $packet->ID); ?>">
                    <h2><?php echo $packet->post_title; ?></h2>
                    <span><?php the_field('description', $packet->ID); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>