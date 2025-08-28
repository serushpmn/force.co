<?php
/*
Template Name: Custom Checkout Page
*/
get_header();
?>
<main class="checkout-page">
  <section class="checkout-container">
    <h1 class="checkout-title">تسویه حساب</h1>
    <div class="checkout-content">
      <?php echo do_shortcode('[woocommerce_checkout]'); ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>
