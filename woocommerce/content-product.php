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
<div class="each-product-card<?php echo ($product->get_stock_status() !== 'instock') ? ' out-of-stock' : ''; ?>">
            <div class="full-w">
              <a href="<?php the_permalink() ?>">
                <div class="each-prd-img">
                <?php
                // نمایش بج درصد تخفیف فقط اگر محصول موجود و تخفیف‌دار باشد
                if ( $product->get_stock_status() === 'instock' && $product->is_on_sale() ) {
                  $regular_price = (float) $product->get_regular_price();
                  $sale_price = (float) $product->get_sale_price();
                  if ( $regular_price > 0 && $sale_price > 0 && $regular_price > $sale_price ) {
                    $discount_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                    echo '<span class="discount-badge">' . $discount_percent . '% تخفیف</span>';
                  }
                }
                ?>
                <?php the_post_thumbnail(); ?>
              </div>
              </a>
                  <a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
                  <div class="product-card-description">
                    <p class="prd_stock<?php echo ($product->get_stock_status() !== 'instock') ? ' out-of-stock-text' : ''; ?>"><?php echo (wc_get_product( $post->ID )->get_stock_status()=='instock') ? 'موجود ' :'ناموجود  ';?></p>
                    <?php if ($product->get_stock_status() === 'instock') : ?>
                    <div class="product-price-column">
                      <?php echo wc_get_product( $post->ID )->get_price_html(); ?>
                    </div>
                    <?php endif; ?>
                  </div>
                       </div>
            <?php if ($product->get_stock_status() === 'instock') : ?>
              <a href="<?php the_permalink() ?>" class="buy-btn">خرید</a>
            <?php else : ?>
              <a class="buy-btn disabled" href="#" tabindex="-1" aria-disabled="true" onclick="return false;">ناموجود</a>
            <?php endif; ?>
          </div>
          
