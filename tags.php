<?php get_header(); ?>
      <main>
        <!-- Hero -->
        <div class="hero article-cat">
          <div class="round-circle"></div>
          <div class="img-slider">
            <img src="<?php echo get_template_directory_uri();?>/img/image 1 (3).jpg" alt="شرکت فیلتراسین فرس" />
          </div>

          <h1 class="brand-title">
          <?php single_tag_title(); ?>
          </h1>
        </div>
        <section >
          <div class="container-content">
            <div class="article-category">

              
              <?php
                                 $the_query = new WP_Query( array( 'post_type' => 'post' ) ) ?>
                                <?php if ( $the_query->have_posts() ) : ?>
                                  <?php
                                    while ( $the_query->have_posts() ) :
                                        $the_query->the_post();
                                        ?>
                                         <div class="each-news">
                                         <?php the_post_thumbnail('maghalethumb'); ?>
                                        <h2><?php the_title(); ?></h2>
                                        <p><?php the_date(); ?></p>
                                        <a href="<?php the_permalink() ?>">ادامه مطلب</a>
                                    </div>
                                      
                                        


                                             
                                    <?php endwhile; ?>
                                      <?php wp_reset_postdata(); ?>
                                <?php else : ?>
                                    <p><?php esc_html_e( 'متاسفانه محتوایی پیدا نشد' ); ?></p>
                                <?php endif; ?>


            </div>
            <div class="pagenumbers">
            <?php the_posts_pagination( array( 'mid_size' => 5 ) ); ?>
              
              </div>
            </div>
          </section>
          
      </main>
      <?php get_footer(); ?>