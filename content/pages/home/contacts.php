<?php $contacts_page = get_field('home_contacts_relation'); if ($contacts_page) : ?>
  
  <?php
      $contacts_page_fields = get_field('contacts_content_fields', $contacts_page->ID);
  ?>
  
  <section class="home--contacts">
      <div class="container contacts--box">
          <div class="row more__contacts">
              <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                  <?php 
                      echo isset($contacts_page_fields['title']) ? '<h2 class="more__contacts-title">'. $contacts_page_fields['title'] .'</h2>' : '';
                      echo apply_filters('the_content', $contacts_page->post_content);
                  ?>
              </div>
          </div>
      </div>
  </section>
  
  <?php endif; 