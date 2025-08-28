<?php
/*
Template Name: Custom Cart Page
*/
get_header();
?>
<main class="cart-page">
  <section class="cart-container">
    <h1 class="cart-title">سبد خرید</h1>
    <div class="cart-content">
      <?php echo do_shortcode('[woocommerce_cart]'); ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>
