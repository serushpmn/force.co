<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Only display on single product pages
if ( is_product() ) :
    global $product;
    if ( ! is_a( $product, 'WC_Product' ) ) {
        $product = wc_get_product( get_the_ID() );
    }
    
    // Ensure product is valid
    if ( ! is_a( $product, 'WC_Product' ) ) {
        return;
    }
?>
<div class="mobile-product-footer">
    <div class="mobile-product-footer-container">
        <div class="mobile-product-price">
            <span class="price-label">قیمت:</span>
            <span class="price-amount"><?php echo $product->get_price_html(); ?></span>
        </div>
        <div class="mobile-add-to-cart">
            <?php
            // Output the add to cart button for the specific product
            do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
            ?>
        </div>
    </div>
</div>
<?php endif; ?>
