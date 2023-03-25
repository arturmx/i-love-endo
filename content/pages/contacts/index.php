<?php
    $contacts_page_fields = get_field('contacts_content_fields');
    
?>
<section class="page--default contacts--page">
    <div class="container contacts--box">
        <?php echo isset($contacts_page_fields['title']) ? '<h1 class="title-line">'. $contacts_page_fields['title'] .'</h1>' : ''; ?>
        <div class="row more__contacts">
            <div class="col-12 col-lg-5 col-xl-4 content-body">
                <?php the_content(); ?>
                <br>
                <?php echo $contacts_page_fields['payments']; ?>
            </div>
        </div>
    </div>
</section>