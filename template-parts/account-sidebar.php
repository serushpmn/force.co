<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;
$slug = isset( $post->post_name ) ? $post->post_name : '';
?>
 <aside>
      <div class="profile-card">
        <div class="profile-avatar">
          <?php echo get_avatar( $current_user->ID, 96 ); ?>
        </div>
        <div class="profile-name"><?php echo esc_html( $current_user->display_name ); ?></div>
        <?php if ( ! empty( $current_user->user_email ) ) : ?>
          <div class="profile-phone text-muted"><?php echo esc_html( $current_user->user_email ); ?></div>
        <?php endif; ?>

        <ul class="account-links" style="margin-top:16px;">
          <li><a href="<?php echo esc_url( home_url('/account') ); ?>"><span class="icon">🏠</span> <span>پروفایل</span></a></li>
          <?php if ( function_exists('wc_get_account_endpoint_url') ) : ?>
            <li><a href="<?php echo esc_url( wc_get_account_endpoint_url('orders') ); ?>"><span class="icon">📦</span> <span>سفارش‌ها</span></a></li>
            <li><a href="<?php echo esc_url( wc_get_account_endpoint_url('edit-account') ); ?>"><span class="icon">✏️</span> <span>ویرایش اطلاعات</span></a></li>
          <?php endif; ?>
          <li><a class="logout-link" href="<?php echo esc_url( home_url('/logout') ); ?>">خروج از حساب</a></li>
        </ul>
      </div>
    </aside>
