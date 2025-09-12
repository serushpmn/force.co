<?php
/*
Template Name: Custom Cart Page
*/
get_header(); ?>
 <h1 class="cart-title">سبد خرید</h1>
      <?php echo do_shortcode("[woocommerce_cart]"); ?>
<?php get_footer(); ?>
