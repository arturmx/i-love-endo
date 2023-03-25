<?php $sections = get_field('sectiions'); if (!empty($sections)) : ?>
<div class="hotel--sections">
    <?php foreach ($sections as $key => $value) : ?>
        <div class="section" style="background-image: url(<?php echo $value['background']; ?>)">
            <div class="container">
                <div class="row">
                    <?php if ($key % 2 == 0) : ?>
                        <div class="col-12 col-md-8 col-xl-6 offset-md-4 offset-xl-6">
                            <div class="box"><?php echo $value['text']; ?></div>
                        </div>
                    <?php else : ?>
                        <div class="col-12 col-md-8 col-xl-6">
                            <div class="box"><?php echo $value['text']; ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif;