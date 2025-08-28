<?php get_header(); ?>

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

                            <div class="single-article-content">

                                <?php the_content(); ?>
                            </div>
                           
                        </div>
                            <?php endwhile; else : ?>

                                <p><?php esc_html_e( 'متاسفیم' ); ?></p>

                                <?php endif; ?>
          </section>
          <section class="related">
    <h2>محصولات مشابه</h2>
    <?php
    $post_id = get_the_ID();
    
    // Get the product object
    $current_product = wc_get_product($post_id);
    
    // Get the related products based on the current post
    $related_product_ids = wc_get_related_products($post_id, 4);
    
    // Query the related products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 8,
        'post__in' => $related_product_ids,
        'post__not_in' => array($post_id),
    );
    
    $related_products = new WP_Query($args);
    
    // Display the related products
    if ($related_products->have_posts()) {
        echo '<ul class="related-products">';
        
        while ($related_products->have_posts()) {
            $related_products->the_post();
            global $product;
            ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                    <div class="each-img">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <h3>
                        <?php the_title(); ?>
                    </h3>
                </a>
            </li>
            <?php
        }
        
        echo '</ul>';
        wp_reset_postdata();
    } else {
        echo 'No related products found.';
    }
    ?>
</section>
      </main>

      <?php get_footer(); ?>