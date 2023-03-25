<?php $lecturers = get_field('lecturers_list'); if ($lecturers) : ?>
    <div class="container">
        <div class="row">
            <?php $count = 1; ?>
            <?php foreach ($lecturers as $lector) : ?>
                <div class="col-12 col-lg-5 lecturer <?php echo ($count++ % 2 == 1) ? "offset-lg-1" : ""; ?>">
                    <article>
                        <?php $photo = $lector['photo'] ? $lector['photo']['sizes']['thumbnail'] : public_uri().'/img/photo-default.jpg'; ?>
                        <img src="<?php echo $photo; ?>" alt="<?php echo $lector['name']; ?>">
                        <p class="status"><?php echo $lector['status']; ?></p>
                        <h3><?php echo $lector['name']; ?></h3>
                        <div class="desc">
                            <?php echo $lector['short_description']; ?>...
                        </div>
                        <a class="link" href="/wykladowcy/#<?php echo slugify($lector['name']); ?>">Dowiedz się więcej »</a>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>