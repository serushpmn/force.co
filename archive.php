<?php get_header(); ?>
      <main>
        <!-- Hero -->
        <div class="hero-single">
          <div class="round-circle"></div>
          <div class="hero-img">
            <img src="<?php echo get_template_directory_uri();?>/img/bg-low-size.jpg" alt="شرکت فیلتراسین فرس" />
          </div>

          <h1 class="brand-title">
          <?php the_category(); ?>
           </h1>
        </div>

        <section >
          <div class="container-content">
          
            <div class="article-category">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                         <div class="each-news">
                                          <div class="each-news-img">
                                            <?php the_post_thumbnail('maghalethumb'); ?>
                                          </div>
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <p><?php the_date(); ?></p>
                                        <a href="<?php the_permalink() ?>" class="edame">ادامه مطلب</a>
                                    </div>
                                    
                                    <?php endwhile; else : ?>
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