<?php $squares = get_field('squares_list'); if ($squares) : ?>
    <div class="row justify-content-center premium--squares">
        <?php foreach ($squares as $item) : ?>
            <div class="col-12 col-lg-4 box">
                <div class="body">
                    <img src="<?php echo $item['image']; ?>" alt="box-image">
                    <p><?php echo $item['text']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;