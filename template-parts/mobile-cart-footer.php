<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Only display on the cart page and if the cart is not empty
if ( function_exists('is_cart') && is_cart() && ! WC()->cart->is_empty() ) :
?>
<div class="mobile-cart-footer">
    <div class="mobile-cart-footer-container">
        <div class="mobile-cart-total">
            <span class="total-label"><?php esc_html_e( 'مجموع:', 'woocommerce' ); ?></span>
            <span class="total-amount"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>
        <div class="mobile-checkout-button">
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-btn">
                <?php esc_html_e( 'ادامه جهت تسویه حساب', 'woocommerce' ); ?>
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
