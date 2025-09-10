<?php
/* Template Name: Orders */
get_header();
?>
<div class="container orders-page">
  <h2>سفارش‌های من</h2>

  <div class="orders-list-wrap">
    <?php if ( is_user_logged_in() ) :
      $current_user = wp_get_current_user();
      if ( function_exists( 'wc_get_orders' ) ) {
        $orders = wc_get_orders( array( 'customer' => $current_user->ID, 'limit' => 50 ) );
        if ( ! empty( $orders ) ) : ?>

          <div class="orders-grid">
            <?php foreach ( $orders as $order ) :
              $order_id = $order->get_id();
              $date = wc_format_datetime( $order->get_date_created() );
              $total = $order->get_formatted_order_total();
              $status = wc_get_order_status_name( $order->get_status() );
              $items = $order->get_items();
            ?>
              <article class="order-card">
                <div class="order-head">
                  <div class="order-meta">
                    <strong>سفارش #<?php echo esc_html( $order_id ); ?></strong>
                    <div class="text-muted"><?php echo esc_html( $date ); ?></div>
                  </div>
                  <div class="order-status"><?php echo esc_html( $status ); ?></div>
                </div>

                <div class="order-body">
                  <ul class="order-items">
                    <?php foreach ( $items as $item ) :
                      $name = $item->get_name();
                      $qty = $item->get_quantity();
                    ?>
                      <li><?php echo esc_html( $name ); ?> × <?php echo esc_html( $qty ); ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>

                <div class="order-foot">
                  <div class="order-total"><?php echo wp_kses_post( $total ); ?></div>
                  <a class="order-view" href="<?php echo esc_url( wc_get_endpoint_url( 'view-order', $order_id, wc_get_page_permalink( 'myaccount' ) ) ); ?>">مشاهده</a>
                </div>
              </article>
            <?php endforeach; ?>
          </div>

        <?php else : ?>
          <div class="orders-empty">
            <img src="<?php echo get_template_directory_uri(); ?>/img/bg-low-size.jpg" alt="empty" />
            <p>هیچ سفارشی ثبت نشده است.</p>
          </div>
        <?php endif;
      } else {
        echo '<p>برای مشاهده سفارش‌ها ووکامرس باید فعال باشد.</p>';
      }
    else :
      echo '<p>برای مشاهده سفارش‌ها ابتدا <a href="' . esc_url( home_url('/login') ) . '">وارد شوید</a>.</p>';
    endif; ?>
  </div>

</div>

<?php get_footer(); ?>
