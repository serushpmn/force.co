<?php
/* Template Name: Custom Logout */
get_header();
?>
<div class="container logout-page">
  <h2>خروج از حساب کاربری</h2>
  <?php
  if ( is_user_logged_in() ) {
    // perform logout and redirect to home
    wp_logout();
    wp_safe_redirect( home_url('/') );
    exit;
  } else {
    echo '<p>شما وارد نشده‌اید.</p>';
    echo '<a href="' . esc_url( home_url('/login') ) . '">ورود</a>';
  }
  ?>
</div>
<?php get_footer(); ?>
