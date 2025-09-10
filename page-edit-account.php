<?php
/*
Template Name: Edit Account
*/

if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) );
    exit;
}

get_header();

$current_user = wp_get_current_user();
$updated = false;
$errors = array();
$password_changed = false;

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['edit_account_nonce'] ) ) {
  if ( ! wp_verify_nonce( $_POST['edit_account_nonce'], 'edit_account_action' ) ) {
    $errors[] = 'خطای امنیتی رخ داد.';
  } else {
    // Basic profile
    $first_name = sanitize_text_field( $_POST['first_name'] ?? '' );
    $last_name = sanitize_text_field( $_POST['last_name'] ?? '' );
    $display_name = sanitize_text_field( $_POST['display_name'] ?? '' );
    $email = sanitize_email( $_POST['email'] ?? '' );

    // Billing info
    $phone = sanitize_text_field( $_POST['billing_phone'] ?? '' );
    $address = sanitize_textarea_field( $_POST['billing_address_1'] ?? '' );
    $city = sanitize_text_field( $_POST['billing_city'] ?? '' );
    $state = sanitize_text_field( $_POST['billing_state'] ?? '' );
    $postcode = sanitize_text_field( $_POST['billing_postcode'] ?? '' );
    $company = sanitize_text_field( $_POST['billing_company'] ?? '' );

    // Password change
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation
    if ( empty( $display_name ) ) $errors[] = 'نام نمایشی نمی‌تواند خالی باشد.';
    if ( empty( $phone ) ) $errors[] = 'تلفن تماس نمیتواند خالی باشد.';

    if ( ! empty( $email ) ) {
      if ( ! is_email( $email ) ) {
        $errors[] = 'آدرس ایمیل نامعتبر است.';
      } else {
        $owner = email_exists( $email );
        if ( $owner && $owner != $current_user->ID ) {
          $errors[] = 'این ایمیل قبلاً در سایت ثبت شده است.';
        }
      }
    }

    // Password rules
    if ( ! empty( $new_password ) || ! empty( $confirm_password ) ) {
      if ( empty( $current_password ) ) {
        $errors[] = 'برای تغییر رمز، رمز فعلی را وارد کنید.';
      } elseif ( ! wp_check_password( $current_password, $current_user->data->user_pass, $current_user->ID ) ) {
        $errors[] = 'رمز فعلی نامعتبر است.';
      } elseif ( $new_password !== $confirm_password ) {
        $errors[] = 'رمز جدید و تکرار آن همخوانی ندارند.';
      } elseif ( strlen( $new_password ) < 6 ) {
        $errors[] = 'رمز جدید باید حداقل 6 کاراکتر باشد.';
      }
    }

    if ( empty( $errors ) ) {
      // Update WP user fields
      $user_updates = array( 'ID' => $current_user->ID );
      if ( ! empty( $first_name ) ) $user_updates['first_name'] = $first_name;
      if ( ! empty( $last_name ) ) $user_updates['last_name'] = $last_name;
      if ( ! empty( $display_name ) ) $user_updates['display_name'] = $display_name;
      if ( ! empty( $email ) && $email !== $current_user->user_email ) $user_updates['user_email'] = $email;
      if ( ! empty( $new_password ) ) $user_updates['user_pass'] = $new_password;

      if ( count( $user_updates ) > 1 ) {
        wp_update_user( $user_updates );
      }

      // Billing meta
      update_user_meta( $current_user->ID, 'billing_phone', $phone );
      update_user_meta( $current_user->ID, 'billing_address_1', $address );
      update_user_meta( $current_user->ID, 'billing_city', $city );
      update_user_meta( $current_user->ID, 'billing_state', $state );
      update_user_meta( $current_user->ID, 'billing_postcode', $postcode );
      update_user_meta( $current_user->ID, 'billing_company', $company );

      $updated = true;
      // refresh user data
      $current_user = wp_get_current_user();
    }
  }
}
?>
<div class="container account-page">
  <h2>ناحیه کاربری</h2>
  <div class="account-container">
  <?php get_template_part( 'template-parts/account', 'sidebar' ); ?>
    <main>
      <?php if ( is_user_logged_in() ) :
        $current_user = wp_get_current_user();
      ?>
      <section class="account-main">
      <h2>ویرایش اطلاعات حساب</h2>

      <?php if ( $updated ) : ?>
        <div class="notice success">اطلاعات با موفقیت بروزرسانی شد.</div>
      <?php endif; ?>

      <?php if ( ! empty( $errors ) ) : ?>
        <div class="notice error">
          <ul>
          <?php foreach( $errors as $e ) echo '<li>' . esc_html( $e ) . '</li>'; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="post" class="edit-account-form">
        <?php wp_nonce_field( 'edit_account_action', 'edit_account_nonce' ); ?>

        <div class="grid two-col">
          <label>نام
            <input type="text" name="first_name" value="<?php echo esc_attr( $current_user->first_name ); ?>" />
          </label>

          <label>نام خانوادگی
            <input type="text" name="last_name" value="<?php echo esc_attr( $current_user->last_name ); ?>" />
          </label>

          <label>نام نمایشی
            <input type="text" name="display_name" value="<?php echo esc_attr( $current_user->display_name ); ?>" />
          </label>

          <label>ایمیل
            <input type="text" name="email" value="<?php echo esc_attr( $current_user->user_email ); ?>" />
          </label>
        </div>

        <h4 style="margin-top:16px">اطلاعات صورتحساب</h4>
        <div class="grid two-col">
          <label>شرکت
            <input type="text" name="billing_company" value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'billing_company', true ) ); ?>" />
          </label>

          <label>شهر
            <input type="text" name="billing_city" value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'billing_city', true ) ); ?>" />
          </label>

          <label>استان
            <input type="text" name="billing_state" value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'billing_state', true ) ); ?>" />
          </label>

          <label>کد پستی
            <input type="text" name="billing_postcode" value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'billing_postcode', true ) ); ?>" />
          </label>

          <label>تلفن
            <input type="text" name="billing_phone" value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'billing_phone', true ) ); ?>" />
          </label>

          <label>آدرس
            <textarea name="billing_address_1"><?php echo esc_textarea( get_user_meta( $current_user->ID, 'billing_address_1', true ) ); ?></textarea>
          </label>
        </div>

        <h4 style="margin-top:16px">تغییر رمز عبور</h4>
        <div class="grid two-col">
          <label>رمز فعلی
            <input type="password" name="current_password" value="" autocomplete="current-password" />
          </label>

          <label>رمز جدید
            <input type="password" name="new_password" value="" autocomplete="new-password" />
          </label>

          <label>تکرار رمز جدید
            <input type="password" name="confirm_password" value="" autocomplete="new-password" />
          </label>
        </div>

        <div style="margin-top:14px; display:flex; gap:12px;">
          <button type="submit" class="button save-btn">ذخیره تغییرات</button>
          <a href="<?php echo esc_url( home_url('/account') ); ?>" class="button" style="background:#f3f4f6;color:#111;padding:10px 12px;border-radius:8px;text-decoration:none">انصراف</a>
        </div>
      </form>

    </section>
    </main>

    
  </div>
  <?php else : ?>
      <p>برای مشاهده ناحیه کاربری ابتدا <a href="<?php echo esc_url( home_url('/login') ); ?>">وارد شوید</a>.</p>
      <?php
      // Fallback: show page content if any (useful if WP page exists but template not assigned)
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;
      endif;

      // Admin debug info to help diagnose issues
      if ( current_user_can( 'manage_options' ) ) :
        global $post;
        echo '<div style="margin-top:18px;padding:12px;background:#f9f9f9;border:1px solid #eee">';
        echo '<strong>Debug:</strong><br>';
        if ( isset( $post ) ) {
          echo 'Page ID: ' . esc_html( $post->ID ) . '<br>';
          echo 'Post Name (slug): ' . esc_html( $post->post_name ) . '<br>';
          echo 'Template: ' . esc_html( get_page_template_slug( $post->ID ) ) . '<br>';
        } else {
          echo 'No global $post available.';
        }
        echo '</div>';
      endif;
      ?>
  <?php endif; ?>
</div>


<?php get_footer();
