<?php
/* Template Name: Custom Login */
get_header();

// Handle registration POST
$register_errors = array();
if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['custom_action'] ) && $_POST['custom_action'] === 'register' ) {
  if ( ! isset( $_POST['custom_register_nonce'] ) || ! wp_verify_nonce( $_POST['custom_register_nonce'], 'custom_register' ) ) {
    $register_errors[] = 'خطای امنیتی. دوباره تلاش کنید.';
  } else {
    $username = sanitize_user( wp_unslash( $_POST['reg_username'] ?? '' ) );
    $email = sanitize_email( wp_unslash( $_POST['reg_email'] ?? '' ) );
    $password = trim( wp_unslash( $_POST['reg_password'] ?? '' ) );

    if ( empty( $username ) ) {
      $register_errors[] = 'نام کاربری لازم است.';
    } elseif ( username_exists( $username ) ) {
      $register_errors[] = 'این نام کاربری قبلا ثبت شده است.';
    }

    if ( empty( $email ) || ! is_email( $email ) ) {
      $register_errors[] = 'ایمیل معتبر وارد کنید.';
    } elseif ( email_exists( $email ) ) {
      $register_errors[] = 'این ایمیل قبلا ثبت شده است.';
    }

    if ( empty( $password ) || strlen( $password ) < 6 ) {
      $register_errors[] = 'رمز عبور باید حداقل 6 کاراکتر باشد.';
    }

    if ( empty( $register_errors ) ) {
      $user_id = wp_create_user( $username, $password, $email );
      if ( is_wp_error( $user_id ) ) {
        $register_errors[] = $user_id->get_error_message();
      } else {
        // set customer role for WooCommerce
        $user = new WP_User( $user_id );
        $user->set_role( 'customer' );

        // log the user in
        $creds = array();
        $creds['user_login'] = $username;
        $creds['user_password'] = $password;
        $creds['remember'] = true;
        $signon = wp_signon( $creds, is_ssl() );
        if ( is_wp_error( $signon ) ) {
          $register_errors[] = $signon->get_error_message();
        } else {
          wp_safe_redirect( home_url( '/account' ) );
          exit;
        }
      }
    }
  }
}

?>

<div class="container login-page">
  <h2>ورود / ثبت‌نام</h2>

  <?php if ( is_user_logged_in() ) : ?>
    <p>شما وارد شده‌اید. <a href="<?php echo esc_url( home_url('/account') ); ?>">ناحیه کاربری</a></p>
  <?php else : ?>

    <div class="auth-columns" style="display:flex;gap:40px;flex-wrap:wrap;">
      <div class="login-column" style="flex:1;min-width:280px;">
        <h3>ورود</h3>
        <?php
          $args = array(
            'redirect' => home_url('/account'),
            'form_id' => 'custom_loginform',
            'label_username' => 'نام کاربری یا ایمیل',
            'label_password' => 'رمز عبور',
            'label_remember' => 'مرا به خاطر بسپار',
            'label_log_in' => 'ورود',
            'remember' => true
          );
          wp_login_form($args);
          if ( isset($_GET['login']) && $_GET['login'] == 'failed' ) {
            echo '<p class="login-error">نام کاربری یا رمز عبور اشتباه است.</p>';
          }
        ?>
      </div>

      <div class="register-column" style="flex:1;min-width:280px;">
        <h3>ثبت‌نام</h3>
        <?php if ( ! empty( $register_errors ) ) : ?>
          <div class="register-errors" style="color:#c00;">
            <?php foreach ( $register_errors as $err ) : ?>
              <p><?php echo esc_html( $err ); ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <form method="post" class="register-form">
          <?php wp_nonce_field( 'custom_register', 'custom_register_nonce' ); ?>
          <input type="hidden" name="custom_action" value="register" />
          <p>
            <label for="reg_username">نام کاربری</label><br />
            <input name="reg_username" id="reg_username" type="text" required />
          </p>
          <p>
            <label for="reg_email">ایمیل</label><br />
            <input name="reg_email" id="reg_email" type="email" required />
          </p>
          <p>
            <label for="reg_password">رمز عبور</label><br />
            <input name="reg_password" id="reg_password" type="password" required />
          </p>
          <p>
            <button type="submit">ثبت‌نام</button>
          </p>
        </form>
      </div>
    </div>

  <?php endif; ?>

</div>

<?php get_footer(); ?>
