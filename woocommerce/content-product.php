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
<div class="product-item<?php echo ($product->get_stock_status() !== 'instock') ? ' out-of-stock' : ''; ?>">
    
        <a href="<?php the_permalink(); ?>">
            <div class="each-prd-img">
                <?php
                // show discount percent if on sale and in stock
                $regular_price = ( $product->get_regular_price() !== '' ) ? (float) $product->get_regular_price() : 0;
                $sale_price = ( $product->get_sale_price() !== '' ) ? (float) $product->get_sale_price() : 0;
                if ( $product->get_stock_status() === 'instock' && $product->is_on_sale() && $regular_price > 0 && $sale_price > 0 && $regular_price > $sale_price ) {
                  $discount_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                  echo '<span class="discount-percentage">' . $discount_percent . '% تخفیف</span>';
                }
                ?>
                <?php the_post_thumbnail(); ?>
            </div>
        </a>

        <a href="<?php the_permalink(); ?>"><h2 class="product-name"><?php the_title(); ?></h2></a>

        <div class="product-card-description">
                        <?php // **تغییر اصلی اینجاست** ?>
            <div class="product-price-column">
                <?php if ( $product->get_price_html() && $product->get_stock_status() === 'instock' ) : ?>
                    <?php if ( $product->is_on_sale() && $regular_price > 0 && $sale_price > 0 && $regular_price > $sale_price ) : ?>
                        <span class="discounted-price"><?php echo wc_price( $sale_price ); ?></span>
                        <span class="original-price"><?php echo wc_price( $regular_price ); ?></span>
                    <?php else : ?>
                        <span class="discounted-price"><?php echo $product->get_price_html(); ?></span>
                    <?php endif; ?>
                <?php else: ?>
                    <?php // یک فضای خالی برای حفظ ارتفاع ?>
                    <span class="no-price">&nbsp;</span>
                <?php endif; ?>
            </div>
        </div>
   

    <?php if ( $product->get_stock_status() === 'instock' ) : ?>
        <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="buy-btn">خرید</a>
    <?php else : ?>
        <a class="buy-btn disabled" href="#" tabindex="-1" aria-disabled="true" onclick="return false;">ناموجود</a>
    <?php endif; ?>
</div>
          
