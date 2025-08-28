<?php get_header(); ?>
      <main>
        <!-- Hero -->
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section class="single-article">
          <div class="container-content">
            <h3 class="home-title"><?php the_title(); ?></h3>
            
                            <div class="single-article-content">

                                <?php the_content(); ?>
                            </div>
                            <div class="cat-tag">

                              <div class="cats"><i class="fa fa-bars"></i>دسته بندی:
                              <?php the_category(' , '); ?>
                            </div>
                            <div class="tags"><i class="fa fa-tags"></i>برچسب ها:
                            <?php the_tags(' , '); ?>
                          </div>
                        </div>

                        </div>
                            <?php endwhile; else : ?>
                                <p><?php esc_html_e( 'متاسفیم' ); ?></p>
                                <?php endif; ?>
                                
          </section>
      </main>
      <?php get_footer(); ?>