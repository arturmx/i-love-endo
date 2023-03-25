<?php $awards = get_field('awards'); ?>

<div class="awards">
    <?php if ($awards['title']) : ?>
        <div class="aw-title">
            <?php echo $awards['title']; ?>
        </div>
    <?php endif; ?>

    <?php foreach($awards['list'] as $item) : ?>
        <article>
            <img src="<?php echo $item['Image']; ?>" alt="<?php echo $item['position']; ?>">
            <div>
                <h4><?php echo $item['position']; ?></h4>
                <p><?php echo $item['text']; ?></p>
            </div>
        </article>
    <?php endforeach; ?>
</div>