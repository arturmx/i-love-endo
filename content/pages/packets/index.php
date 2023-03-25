<section class="page--default">
    <h1><?php the_title(); ?></h1>
    <div class="container">
      <div class="packets">
        <div class="packets__heading-wrapper">
          <?php get_template_part('content/caret.svg'); ?>
          <div class="packets__heading">Package</div>
          <div class="packets__heading-text"><?php the_field('naglowek'); ?></div>
        </div>
        <div class="packets__items">
          <?php  while( have_rows('pakiety') ) : the_row(); ?>
          <div class="packets__item">
            <?php get_template_part('content/caret.svg'); ?>
            <div class="packets__text"><?php the_sub_field('tekst'); ?></div>
          </div>
          <?php endwhile; ?>
        </div>
        <div class="packets__bottom">
          <svg width="31" height="41" viewBox="0 0 31 41" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M29.6337 39.6428H1.36621V1.35718H21.9281L29.6337 9.0116V39.6428Z" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
            <path d="M21.0538 18.3489L14.5915 24.7683L9.94629 20.1539" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
          </svg>
          <div class="packets__bottom-text"><?php the_field('bottom_text'); ?></div>
        </div>
      </div>
    </div>
</section>