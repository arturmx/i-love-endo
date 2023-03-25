<!-- top bar -->
<div class="top-bar">
    <?php
    if (pll_current_language() == 'en') {
        $top_bar = get_field('header_top_bar', 504);
    } else {
        $top_bar = get_field('header_top_bar', 2);
    }
    ?>

    <?php if (
        isset($top_bar['link_title']) &&
        isset($top_bar['link']) &&
        $top_bar['link_title'] &&
        $top_bar['link']
    ) : ?>

        <a class="link more__gallery-link" href="/galeria">Galeria</a>
        <a href="<?php echo $top_bar['link']; ?>" target="_blank" title="<?php echo $top_bar['link_title']; ?>" class="link">
            <?php echo $top_bar['link_title']; ?>
        </a>
            
    <?php endif; ?>

    <?php if (isset($top_bar['social']) && !empty($top_bar['social'])) : ?>
        <ul class="social-links">
            <?php foreach ($top_bar['social'] as $social) : ?>
                <li><a href="<?php echo $social['link']; ?>" target="_blank">
                        <img src="<?php echo $social['icon']; ?>" alt="<?php echo $social['link']; ?>">
                    </a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <ul class="social-links">
        <?php pll_the_languages(array(
            'show_names' => 0,
            'show_flags' => 1
        )); ?>
    </ul>
</div>