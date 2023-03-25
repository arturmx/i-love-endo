<div class="packet-name" style="background-color: <?php the_field('background_color', $packet->ID); ?>">
    <h2><?php echo $packet->post_title; ?></h2>
    <span><?php the_field('description', $packet->ID); ?></span>
</div>