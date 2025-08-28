<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="each-product-card">
            <div class="full-w">
              <a href="<?php the_permalink() ?>">
                <div class="each-prd-img">
                <?php the_post_thumbnail(); ?>
              </div>
              </a>
                  <a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
                  <div class="product-card-description">
                    <p class="prd_stock"><?php echo (wc_get_product( $post->ID )->get_stock_status()=='instock') ? 'موجود در انبار' :'ناموجود در انبار';?></p>
                    <p><?php echo wc_get_product( $post->ID )->get_price_html(); ?></p>
                  </div>
                       </div>
            <a href="<?php the_permalink() ?>">خرید</a>
          </div>
          
