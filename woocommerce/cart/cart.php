<?php
/**
 * Template Name: Custom Cart Page
 * Description: A custom cart page template for WooCommerce with Persian styling
 */
get_header();
?>

  <div class="cart-header">
    <?php if ( WC()->cart->get_cart_contents_count() > 0 ) : ?>
      <span class="success-message"><?php esc_html_e( 'محصول به سبد خرید اضافه شد.', 'woocommerce' ); ?></span>
    <?php endif; ?>
    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="continue-link"><?php esc_html_e( 'ادامه خرید', 'woocommerce' ); ?></a>
  </div>
  <div class="cart-container">
    <!-- سبد خرید -->
    <section class="cart-items">
      
      <?php if ( WC()->cart->is_empty() ) : ?>
        <p><?php esc_html_e( 'سبد خرید شما خالی است.', 'woocommerce' ); ?></p>
      <?php else : ?>
        <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : 
          $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
          $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
        ?>
          <div class="cart-item">
            <div class="item-info">
              <?php
                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                echo $thumbnail;
              ?>
              <div class="item-details">
                <p class="item-name">
                  <?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ); ?>
                </p>
                <span class="item-price"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></span>
              </div>
            </div>
            <div class="item-actions">
              <div class="quantity-control">
                <?php
                  if ( $_product->is_sold_individually() ) :
                    $product_quantity = sprintf( '<input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                  else :
                    $product_quantity = woocommerce_quantity_input(
                      array(
                        'input_name'  => "cart[{$cart_item_key}][qty]",
                        'input_value' => $cart_item['quantity'],
                        'max_value'   => $_product->get_max_purchase_quantity(),
                        'min_value'   => '1',
                        'class'       => 'qty-input',
                      ),
                      $_product,
                      false
                    );
                  endif;
                  echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                ?>
              </div>
              <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" class="remove-link"><?php esc_html_e( 'حذف', 'woocommerce' ); ?></a>
            </div>
          </div>
        <?php endforeach; ?>
        <button type="submit" class="update-cart" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'بروزرسانی سبد خرید', 'woocommerce' ); ?></button>
        <?php do_action( 'woocommerce_cart_actions' ); ?>
        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
      <?php endif; ?>
    </section>
    <!-- خلاصه سفارش -->
    <aside class="cart-summary">
      <h3><?php esc_html_e( 'جمع جز', 'woocommerce' ); ?></h3>
      <p><?php wc_cart_totals_subtotal_html(); ?></p>
      <p class="shipping">
        <span><?php esc_html_e( 'حمل و نقل', 'woocommerce' ); ?></span><br />
        <?php esc_html_e( 'آدرس خود را برای مشاهده گزینه‌های حمل و نقل وارد کنید.', 'woocommerce' ); ?>
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"><?php esc_html_e( 'محاسبه حمل و نقل', 'woocommerce' ); ?></a>
      </p>
      <div class="cart-total">
        <strong><?php esc_html_e( 'مجموع:', 'woocommerce' ); ?></strong>
        <span><?php wc_cart_totals_order_total_html(); ?></span>
      </div>
      <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-btn"><?php esc_html_e( 'ادامه جهت تسویه حساب', 'woocommerce' ); ?></a>
    </aside>
  </div>
