<?php get_header(); ?>
<section>
            <div class="title-search-bar">
              <div class="titlebar">
 <?php
 do_action( 'woocommerce_before_main_content' );
?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	* @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
 </div>  
      <?php get_search_form(); ?>
            </div>
        </section>

      <main>

        <!-- Hero -->
        <div class="hero-single">
          <div class="round-circle"></div>
          <div class="hero-img">
            <img src="<?php echo get_template_directory_uri();?>/img/bg-low-size.jpg" alt="شرکت فیلتراسین فرس" />
          </div>

          <h1 class="brand-title">
          <?php woocommerce_page_title(); ?>
           </h1>
        </div>
        <section>
  <div class="container-content">
  <?php
      $search_query = get_search_query(); // Retrieve the search term
      $the_query = new WP_Query(array(
      'post_type' => array(
        'post',
        'page',
        'product',
        'logo',
        'certificate'
      ),
      'posts_per_page' => '12',
      's' => $search_query // Pass the search term to the query
    ) );
    ?>

    <?php if ( $the_query->have_posts() ) : ?>
      <div class="article-category">
        <?php
        while ( $the_query->have_posts() ) :
          $the_query->the_post();
          // Display search result post content
        ?>
          <div class="each-news">
            <div class="each-news-img">

              <?php the_post_thumbnail('maghalethumb'); ?>
            </div>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
            <a href="<?php the_permalink() ?>" class="edame">ادامه مطلب</a>
          </div>
        <?php
        endwhile;
      
        ?>
      </div>
      <div class="pagenumbers">
        <?php the_posts_pagination( array( 'mid_size' => 5 ) ); ?>
      </div>
    <?php else : ?>
      <div class="no-result">
        <h2>متاسفانه محتوایی پیدا نشد</h2>

      </div>
    <?php endif; ?>

  </div>
</section>
      </main>
      <?php get_footer(); ?>