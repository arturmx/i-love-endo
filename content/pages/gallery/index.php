<?php
    // Homepage custom JS
    add_js_to_footer(['gallerypage' => '/public/build/js/gallery.js']);
?>

<section class="page--default">
    <div class="container">

        <div class="gallery-wrapper">
            <div class="gallery__row">
                <div class="gallery__year">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.4275 0H2.5725C1.155 0 0 1.155 0 2.5725V21.4275C0 21.4275 0 21.4725 0 21.5025C0 21.525 0 21.555 0.0075 21.5775C0.09 22.9275 1.2 24 2.565 24H21.42C22.8375 24 23.9925 22.845 23.9925 21.4275V2.5725C23.9925 1.155 22.8375 0 21.42 0H21.4275ZM22.2825 15.105L21.96 14.7825C20.985 13.815 19.2975 13.815 18.3225 14.7825C18.3 14.805 18.2775 14.8275 18.2625 14.85L16.59 16.92L11.355 11.895C10.845 11.385 10.1325 11.1075 9.42 11.145C8.7 11.175 8.025 11.5125 7.56 12.0675L1.7025 19.095V2.5725C1.7025 2.1 2.085 1.7175 2.5575 1.7175H21.4125C21.885 1.7175 22.2675 2.1 22.2675 2.5725V15.105H22.2825Z" fill="#E63021"/>
                    </svg>
                    <h2 class="gallery__h2"><?php the_field('naglowek_1'); ?></h2>
                </div>
            </div>
            <?php if( have_rows('galeria_1') ): ?>
            <div class="gallery">
                <?php while( have_rows('galeria_1') ) : the_row(); ?>
                    <div class="gallery__item">
                        <img src="<?php the_sub_field('zdjecie'); ?>"/>
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_504_680)">
                            <path d="M18.1083 35.1337C27.3759 35.1337 34.8889 27.568 34.8889 18.2353C34.8889 8.90258 27.3759 1.33691 18.1083 1.33691C8.84058 1.33691 1.32764 8.90258 1.32764 18.2353C1.32764 27.568 8.84058 35.1337 18.1083 35.1337Z" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                            <path d="M29.8442 29.7727L39.0576 39.0508" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_504_680">
                            <rect width="40" height="40" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                <?php endwhile; ?>
                <?php else : ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="gallery__line"></div>

        <div class="gallery-wrapper">
            <div class="gallery__row">
                <div class="gallery__year">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.4275 0H2.5725C1.155 0 0 1.155 0 2.5725V21.4275C0 21.4275 0 21.4725 0 21.5025C0 21.525 0 21.555 0.0075 21.5775C0.09 22.9275 1.2 24 2.565 24H21.42C22.8375 24 23.9925 22.845 23.9925 21.4275V2.5725C23.9925 1.155 22.8375 0 21.42 0H21.4275ZM22.2825 15.105L21.96 14.7825C20.985 13.815 19.2975 13.815 18.3225 14.7825C18.3 14.805 18.2775 14.8275 18.2625 14.85L16.59 16.92L11.355 11.895C10.845 11.385 10.1325 11.1075 9.42 11.145C8.7 11.175 8.025 11.5125 7.56 12.0675L1.7025 19.095V2.5725C1.7025 2.1 2.085 1.7175 2.5575 1.7175H21.4125C21.885 1.7175 22.2675 2.1 22.2675 2.5725V15.105H22.2825Z" fill="#E63021"/>
                    </svg>
                    <h2 class="gallery__h2"><?php the_field('naglowek_2'); ?></h2>
                </div>
            </div>
            <?php if( have_rows('galeria_2') ): ?>
            <div class="gallery">
                <?php while( have_rows('galeria_2') ) : the_row(); ?>
                    <div class="gallery__item">
                        <img src="<?php the_sub_field('zdjecie'); ?>"/>
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_504_680)">
                            <path d="M18.1083 35.1337C27.3759 35.1337 34.8889 27.568 34.8889 18.2353C34.8889 8.90258 27.3759 1.33691 18.1083 1.33691C8.84058 1.33691 1.32764 8.90258 1.32764 18.2353C1.32764 27.568 8.84058 35.1337 18.1083 35.1337Z" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                            <path d="M29.8442 29.7727L39.0576 39.0508" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_504_680">
                            <rect width="40" height="40" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                <?php endwhile; ?>
                <?php else : ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="gallery__line"></div>
        
        <div class="gallery__lightbox">
            <svg class="gallery__offBtn" width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_505_915)">
                <path d="M14.11 28.22C21.9027 28.22 28.22 21.9027 28.22 14.11C28.22 6.31726 21.9027 0 14.11 0C6.31726 0 0 6.31726 0 14.11C0 21.9027 6.31726 28.22 14.11 28.22Z" fill="#3A3A38"/>
                <path d="M18.3504 9.85999L9.86035 18.35" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                <path d="M18.3504 18.35L9.86035 9.85999" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                </g>
                <defs>
                <clipPath id="clip0_505_915">
                <rect width="28.21" height="28.21" fill="white"/>
                </clipPath>
                </defs>
            </svg>
            <div class="gallery__container">
                <h2 class="lightbox-text"></h2>
                <img id="lightboxImg" src=""/>
                <div class="gallery__arrow-left">
                    <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.95616 0.875244L1.90795 8.92345L10.0923 17.1248" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                    </svg>
                </div>
                <div class="gallery__arrow-right">
                    <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.95616 0.875244L1.90795 8.92345L10.0923 17.1248" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>