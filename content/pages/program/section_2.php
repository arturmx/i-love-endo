<div class="program--section-2">
    <div class="container">
        <h2><?php the_field('section_2_title'); ?></h2>
        
        <?php $button = get_field('section_2_button'); if ($button) : ?>
            <a class="button-default" href="<?php echo $button['link'] ?>"><?php echo $button['text'] ?></a>
        <?php endif; ?>
          
        <div class="row justify-content-center">
            <?php $boxes = get_field('section_2_boxes'); ?>
            <?php foreach ($boxes as $box) : ?>
                    <?php if ($box['enabled']) : ?>

                        <div class="col-12 col-lg-6 box">
                            <div class="body">
                                <h4><?php echo $box['title']; ?></h4>
                                <?php if ($box['date']) { echo '<p class="date">'. $box['date'] .'</p>'; } ?>

                                <?php foreach ($box['row'] as $row) : ?>
                                    <?php if ($row['icon_date']['icon']) : ?>
                                        <div class="line has-icon" style="margin-top: <?php echo $box['margin']; ?>px">
                                            <img src="<?php echo $row['icon_date']['icon']; ?>" alt="icon">
                                            <div class="text"><?php echo $row['text']; ?></div>
                                            <div class="grey"><?php echo $row['icon_date']['date']; ?></div>
                                        </div>
                                    <?php else : ?>
                                        <div class="line" style="margin-top: <?php echo $box['margin']; ?>px">
                                            <div class="text"><?php echo $row['text']; ?></div>
                                            <div class="grey"><?php echo $row['icon_date']['date']; ?></div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>