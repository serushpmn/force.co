<?php 
/*
Template Name: About-Us
*/

get_header(); ?>
      <main>
        
        <!-- Hero -->
        <div class="hero-single">
          <div class="round-circle"></div>
          <div class="hero-img">
            <img src="<?php echo get_template_directory_uri();?>/img/bg-low-size.jpg" alt="شرکت فیلتراسین فرس" />
          </div>

          <h1 class="brand-title">
          <?php the_title(); ?>
           </h1>
        </div>


        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section class="single-article">
          <div class="container-content">
          <div class="about-us-single-contents">
              
              <?php the_content(); ?>  
              
                    </div>
                        </div>
                            <?php endwhile; else : ?>
                                <p><?php esc_html_e( 'متاسفیم' ); ?></p>
                                <?php endif; ?>
          </section>
      </main>
      <?php get_footer(); ?>