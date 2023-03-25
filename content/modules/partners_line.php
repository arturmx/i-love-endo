<?php $partnersList = get_field('partners_list', get_field('partners_grey_list', 2)); if ($partnersList) : ?>
<section class="partners--line">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10">
                <p><?php pll_e($partnersList['title_1']); ?></p>
                <div class="row">  
                <?php foreach($partnersList['default'] as $item) : ?>
                    <div class="col-6 col-sm-4 col-lg-2-5">
                        <?php echo $counter; ?>
                        <?php if ($item['link']) : ?>
                            <a href="<?php echo $item['link']; ?>" target="_blank">
                        <?php endif; ?>
                            <div class="item">
                                <img src="<?php echo $item['logo']['sizes']['medium']; ?>" alt="<?php echo $item['logo']['title']; ?>">
                            </div>
                        <?php if ($item['link']) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-2">
                <p><?php pll_e($partnersList['title_2']); ?></p>
                <div class="row"> 
                <?php foreach($partnersList['media'] as $item) : ?>
                    <div class="col-6 col-sm-4 col-lg-12">
                        <?php if ($item['link']) : ?>
                            <a href="<?php echo $item['link']; ?>" target="_blank">
                        <?php endif; ?>
                            <div class="item">
                                <img src="<?php echo $item['logo']['sizes']['medium']; ?>" alt="<?php echo $item['logo']['title']; ?>">
                            </div>
                        <?php if ($item['link']) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>  
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <p><?php pll_e($partnersList['title_3']); ?></p>
                <div class="row"> 
                <?php foreach($partnersList['patron_medialny'] as $item) : ?>
                    <div class="col-6 col-sm-4 col-lg-12">
                        <?php if ($item['link']) : ?>
                            <a href="<?php echo $item['link']; ?>" target="_blank">
                        <?php endif; ?>
                            <div class="item">
                                <img src="<?php echo $item['logo']['sizes']['medium']; ?>" alt="<?php echo $item['logo']['title']; ?>">
                            </div>
                        <?php if ($item['link']) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>  
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif;