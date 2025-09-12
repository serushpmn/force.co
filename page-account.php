<?php
/* Template Name: User Account */
get_header(); ?>
<div class="container account-page">
  <h2>ناحیه کاربری</h2>
  <div class="account-container">
  <?php get_template_part("template-parts/account", "sidebar"); ?>
    <main>
      <?php if (is_user_logged_in()):
        $current_user = wp_get_current_user(); ?>
      <section class="account-orders">
        <h3>سفارش‌های شما</h3>
      <?php if (function_exists("wc_get_orders")) {
        $orders = wc_get_orders([
          "customer" => $current_user->ID,
          "limit" => 20,
        ]);
        if (!empty($orders)) {
          echo '<table class="orders-table" style="width:100%;border-collapse:collapse;">';
          echo "<thead><tr><th>شماره</th><th>تاریخ</th><th>مبلغ</th><th>وضعیت</th><th>مشاهده</th></tr></thead>";
          echo "<tbody>";
          foreach ($orders as $order) {
            $order_id = $order->get_id();
            $order_date = wc_format_datetime($order->get_date_created());
            $order_total = $order->get_formatted_order_total();
            $order_status = wc_get_order_status_name($order->get_status());
            $view_url = esc_url(
              wc_get_endpoint_url(
                "view-order",
                $order_id,
                wc_get_page_permalink("myaccount"),
              ),
            );
            echo '<tr style="border-top:1px solid #eee;">';
            echo "<td>#{$order_id}</td>";
            echo "<td>{$order_date}</td>";
            echo "<td>{$order_total}</td>";
            echo "<td>{$order_status}</td>";
            echo "<td><a href='{$view_url}'>مشاهده</a></td>";
            echo "</tr>";
          }
          echo "</tbody></table>";
        } else {
          echo "<p>هیچ سفارش فعالی یافت نشد.</p>";
        }
      } else {
        echo "<p>برای مشاهده سفارش‌ها ووکامرس باید فعال باشد.</p>";
      } ?>
    </section>
    </main>

    
  </div>
  <?php
        // Fallback: show page content if any (useful if WP page exists but template not assigned)

        // Admin debug info to help diagnose issues


      else:
         ?>
      <p>برای مشاهده ناحیه کاربری ابتدا <a href="<?php echo esc_url(
        home_url("/login"),
      ); ?>">وارد شوید</a>.</p>
      <?php
      if (have_posts()):
        while (have_posts()):
          the_post();
          the_content();
        endwhile;
      endif;

      if (current_user_can("manage_options")):
        global $post;
        echo '<div style="margin-top:18px;padding:12px;background:#f9f9f9;border:1px solid #eee">';
        echo "<strong>Debug:</strong><br>";
        if (isset($post)) {
          echo "Page ID: " . esc_html($post->ID) . "<br>";
          echo "Post Name (slug): " . esc_html($post->post_name) . "<br>";
          echo "Template: " .
            esc_html(get_page_template_slug($post->ID)) .
            "<br>";
        } else {
          echo 'No global $post available.';
        }
        echo "</div>";
      endif;
      ?>
  <?php
      endif; ?>
</div>
<?php get_footer(); ?>
