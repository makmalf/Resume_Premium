<?php get_header(); ?>
   <!-- About Section
   ================================================== -->
   <section id="about">
      <div class="row">

         <div class="three columns">
            <?php echo get_avatar( get_the_author_email(), '123' ); ?>
         </div>

         <div class="nine columns main-col">
            <?php
               $page = get_page_by_title( of_get_option( 'about_page', 'no entry' ) );
               $content = apply_filters('the_content', $page->post_content); 
               $title = apply_filters('the_title', $page->post_title);
            ?>
            <h2><?php echo $title; ?></h2>
            <p>
              <?php echo $content; ?>
            </p>

            <div class="row">

               <div class="columns contact-details">
                  <h2>Contact Details</h2>
                  <p class="address">
                     <?php global $post; $author_id0=$post->post_author; ?>
                     <span> <?php the_author_meta( 'display_name', $author_id0 ); ?> </span>
                     <br/>
                     <?php the_author_meta('address', $author_id0); ?>
                     <br/>
                     Phone: <?php the_author_meta('phone', $author_id0); ?>
                     <br/>
                     BBM: <?php the_author_meta('bbm', $author_id0); ?>
                  </p>
               </div>

               <div class="columns download">
                  <p>
                     <a href="#" class="button"><i class="fa fa-download"></i>Download Resume</a>
                  </p>
               </div>

            </div> <!-- end row -->

         </div> <!-- end .main-col -->

      </div>
   </section> <!-- About Section End-->


   <!-- Resume Section
   ================================================== -->
   <section id="resume">
      <!-- Education
      ----------------------------------------------- -->
      <?php
         $page2 = get_page_by_title( of_get_option( 'resume_page_1', 'NO ENTRY' ) );
         $content2 = apply_filters('the_content', $page2->post_content); 
         $title2 = apply_filters('the_title', $page2->post_title);
      ?>
      <div class="row education">
         <div class="three columns header-col">
            <h1><span><?php echo $title2; ?></span></h1>
         </div>
         <div class="nine columns main-col">
            <?php echo $content2; ?>   
         </div>      
      </div> <!-- End Education -->

      <!-- Work
      ----------------------------------------------- -->
      <?php
         $page3 = get_page_by_title( of_get_option( 'resume_page_2', 'NO ENTRY' ) );
         $content3 = apply_filters('the_content', $page3->post_content); 
         $title3 = apply_filters('the_title', $page3->post_title);
      ?>
      <div class="row work">
         <div class="three columns header-col">
            <h1><span><?php echo $title3; ?></span></h1>
         </div>
         <div class="nine columns main-col">
            <?php echo $content3; ?>
         </div> <!-- main-col end -->

      </div> <!-- End Work -->


      <!-- Skills
      ----------------------------------------------- -->
      <?php
         $page4 = get_page_by_title( of_get_option( 'resume_page_3', 'NO ENTRY' ) );
         $content4 = apply_filters('the_content', $page4->post_content); 
         $title4 = apply_filters('the_title', $page4->post_title);
      ?>
      <div class="row skill">
         <div class="three columns header-col">
            <h1><span><?php echo $title4; ?></span></h1>
         </div>
         <div class="nine columns main-col">
            <?php echo $content4; ?>
         </div> <!-- main-col end -->
      </div> <!-- End skills -->

   </section> <!-- Resume Section End-->


   <!-- Portfolio Section
   ================================================== -->
   <section id="portfolio">
      <div class="row">
         <?php
            // Get the ID of a given category
            $category_id = get_cat_ID( of_get_option( 'portofolio_cat', 'no entry' ) );
             // Get the URL of this category
            $category_link = get_category_link( $category_id );
         ?>
          <div class="three columns header-col">
            <h1><span><?php echo of_get_option( 'portofolio_cat', 'no entry' ); ?></span></h1>
            <a href="<?php echo esc_url( $category_link ); ?>" class="button">View all</a>
         </div>
         <div class="nine columns collapsed">
            <!-- portfolio-wrapper -->
            <div id="portfolio-wrapper" class="bgrid-quarters s-bgrid-thirds cf">
               <?php query_posts('category_name=' . of_get_option('portofolio_cat') . '&showposts=8'); ?>
               <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
               <?php $count == 1 ?>
               <div class="columns portfolio-item">
                  <div class="item-wrap">
                     <?php $count++; ?>
                        <?php the_post_thumbnail('thumbnail'); ?>
                        <div class="overlay">
                           <div class="portfolio-item-meta">
                              <h5><?php the_title(); ?></h5>
                              <p><?php
                                 $posttags = get_the_tags();
                                    if ($posttags) {
                                       foreach($posttags as $tag) {
                                          echo $tag->name . ' ';
                                       }
                                    }
                              ?></p>
                           </div>
                        </div>
                        <div class="link-icon"><a href="#modal-0<?php echo $count; ?>" title=""><i class="fa fa-arrows-alt"></i></a></div>
                  </div>
               </div> <!-- item end -->
               <?php endwhile; endif; wp_reset_query(); ?>
            </div> <!-- portfolio-wrapper end -->

         </div> <!-- twelve columns end -->


         <!-- Modal Popup
         --------------------------------------------------------------- -->
         <?php query_posts('category_name=' . of_get_option('portofolio_cat') . '&showposts=8'); ?>
         <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         <?php $count_modal == 1 ?>
         <?php $count_modal++; ?>
         <div id="modal-0<?php echo $count_modal; ?>" class="popup-modal mfp-hide">
            <?php the_post_thumbnail('full'); ?>
            <div class="description-box">
               <h4><?php the_title(); ?></h4>
               <p><?php the_excerpt(); ?></p>
               <span class="categories"><i class="fa fa-tag"></i><?php the_tags(); ?></span>
            </div>
            <div class="link-box">
               <a href="<?php the_permalink(); ?>">Details</a>
               <a class="popup-modal-dismiss">Close</a>
            </div>
         </div><!-- modal-01 End -->
         <?php endwhile; endif; wp_reset_query(); ?>

      </div> <!-- row End -->

   </section> <!-- Portfolio Section End-->

   <!-- Testimonials Section
   ================================================== -->
   <?php if (of_get_option('testimonials_section_display') == 1) { 
      echo '<style> #testimonials {display: block;}</style>'; 
   } else { 
            echo '<style> #testimonials {display: none;}</style>'; 
         } 
   ?>
   <section id="testimonials">
      <div class="text-container">
         <div class="row">

            <div class="two columns header-col">

               <h1><span>Client Testimonials</span></h1>

            </div>

            <div class="ten columns flex-container">

               <div class="flexslider">

                  <ul class="slides">
                  <?php query_posts('category_name=' . of_get_option('testimonials_section') . '&showposts=8'); ?>
                  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                     <li>
                        <blockquote>
                           <?php the_content(); ?>
                           <cite><?php the_title(); ?></cite>
                        </blockquote>
                     </li> <!-- slide ends -->
                  <?php endwhile; endif; wp_reset_query(); ?>
                  </ul>

               </div> <!-- div.flexslider ends -->

            </div> <!-- div.flex-container ends -->

         </div> <!-- row ends -->

       </div>  <!-- text-container ends -->

   </section> <!-- Testimonials Section End-->


   <!-- Call-To-Action Section
   ================================================== -->
   <?php if (of_get_option('call_to_action_section_display') == 1) { 
      echo '<style> #call-to-action {display: block;}</style>'; 
   } else { 
            echo '<style> #call-to-action {display: none;}</style>'; 
         } 
   ?>
   <section id="call-to-action">

      <div class="row">

         <div class="two columns header-col">
            <h1><span>Yours now?.</span></h1>
         </div>

         <div class="seven columns">
            <h2><?php echo of_get_option('call_to_action_section', 'no entry'); ?></h2>
            <p><?php echo of_get_option('desc_call_to_action_section', 'no entry'); ?></p>
         </div>

         <div class="three columns action">
            <a rel="nofollow" href="<?php echo of_get_option('url_call_to_action_button'); ?>" class="button">
               <?php echo of_get_option('words_call_to_action_button', 'no entry'); ?>
            </a>
         </div>

      </div>

   </section> <!-- Call-To-Action Section End-->


   <!-- Contact Section
   ================================================== -->
   <section id="contact">

         <div class="row section-head">

            <div class="two columns header-col">
               <?php
                  $page5 = get_page_by_title( of_get_option('words_contact_section') );
                  $content5 = apply_filters('the_content', $page5->post_content); 
                  $title5 = apply_filters('the_title', $page5->post_title);
               ?>
               <h1><span><?echo $title5; ?></span></h1>
            </div>

            <div class="ten columns">

                  <p class="lead">
                     <?php echo $content5; ?>
                  </p>

            </div>

         </div>

         <div class="row">

            <div class="eight columns">

               <!-- form -->
               <form action="" method="post" id="contactForm" name="contactForm">
               <fieldset>

                  <div>
                     <input type="text" value="" size="35" id="contactName" name="contactName" placeholder="Your name">
                  </div>

                  <div>
                     <input type="text" value="" size="35" id="contactEmail" name="contactEmail" placeholder="Your e-mail">
                  </div>

                  <div>
                     <input type="text" value="" size="35" id="contactSubject" name="contactSubject" placeholder="Subject">
                  </div>

                  <div>
                     <textarea cols="30" rows="5" id="contactMessage" name="contactMessage" placeholder="Your message"></textarea>
                  </div>

                  <div>
                     <button class="submit">Submit</button>
                     <span id="image-loader">
                        <img alt="" src="<?php bloginfo('template_url'); ?>/images/loader.gif">
                     </span>
                  </div>

               </fieldset>
               </form> <!-- Form End -->

               <!-- contact-warning -->
               <div id="message-warning"> Error boy</div>
               <!-- contact-success -->
               <div id="message-success">
                  <i class="fa fa-check"></i>Your message was sent, thank you!<br>
               </div>

            </div>


            <aside class="four columns footer-widgets">

               <div class="widget widget_contact">

                  <h4>Address and Phone</h4>
                  <p class="address">
                     <span> <?php the_author_meta( 'display_name', $author_id ); ?> </span>
                     <br/>
                     <?php the_author_meta('address', $author_id); ?>
                     <br/>
                     Phone: <?php the_author_meta('phone', $author_id); ?>
                     <br/>
                     BBM: <?php the_author_meta('bbm', $author_id); ?>
                  </p>
                  <p class="gmaps">
                     <iframe width="100%" height="380" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                        src="<?php echo of_get_option('gmaps'); ?>">
                     </iframe>
                  </p>

               </div>

            </aside>

      </div>

   </section> <!-- Contact Section End-->


   <!-- footer
   ================================================== -->
  <?php get_footer(); ?>