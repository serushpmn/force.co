
<?php 
function loadfiles(){
    wp_enqueue_style( 'style', get_template_directory_uri().'/style.css',false);
    wp_enqueue_style( 'swiper','https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css',false);
    wp_enqueue_style( 'Font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',false);
  wp_enqueue_style( 'force-account', get_template_directory_uri() . '/css/account.css', array('style'), '1.0' );
  wp_enqueue_style( 'force-orders', get_template_directory_uri() . '/css/orders.css', array('style'), '1.0' );
  wp_enqueue_style( 'force-cart', get_template_directory_uri() . '/css/cart-custom.css', array('style'), '1.0' );
    wp_enqueue_script( 'swiper','https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', false );
  // Theme toggle script
  wp_enqueue_script( 'force-theme-toggle', get_template_directory_uri() . '/js/theme-toggle.js', array(), '1.0', true );
}
require_once ( get_template_directory() . '/customize.php' );
add_action ('wp_enqueue_scripts' , 'loadfiles');
function register_my_menus() {
    register_nav_menus(
      array(
        'top-menu' => __( 'منوی بالا' ),
        'product-menu' => __( 'منوی محصولات' ),
        'footer-menu' => __( 'منوی فوتر' ),
      )
    );
  }
  add_action( 'init', 'register_my_menus' );
  add_theme_support( 'post-thumbnails');
  add_image_size( 'maghalethumb',200,200,true ); //300 pixels wide (and unlimited height)
  function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
// add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'customizer' );
function add_contact_fields() {
  add_settings_section("contact_section", "اطلاعات تماس (جهت نمایش در فوتر)", null, "general");
  add_settings_field("phone_number", "شماره تماس", "display_phone_number", "general", "contact_section");
  add_settings_field("address", "آدرس", "display_address", "general", "contact_section");
  add_settings_field("email", "ایمیل", "display_email", "general", "contact_section");
  add_settings_field("telegram", "لینک تلگرام", "display_telegram", "general", "contact_section");
  add_settings_field("instagram", "لینک اینستاگرام", "display_instagram", "general", "contact_section");
  add_settings_field("whatsapp", "لینک واتساپ", "display_whatsapp", "general", "contact_section");
  add_settings_field("aparat", "لینک آپارات", "display_aparat", "general", "contact_section");
  register_setting("general", "phone_number");
  register_setting("general", "address");
  register_setting("general", "email");
  register_setting("general", "telegram");
  register_setting("general", "instagram");
  register_setting("general", "whatsapp");
  register_setting("general", "aparat");
}
add_action("admin_init", "add_contact_fields");

/**
 * Ensure required pages (login, account, logout) exist and assign templates.
 * Runs once for administrators and sets an option to avoid repeating.
 */
function force_ensure_account_pages() {
  // Run only once: skip if already created
  if ( get_option( 'force_account_pages_created' ) === '1' ) return;

  $pages = array(
  array( 'slug' => 'login', 'title' => 'ورود', 'template' => 'page-login.php' ),
  array( 'slug' => 'account', 'title' => 'ناحیه کاربری', 'template' => 'page-account.php' ),
  array( 'slug' => 'logout', 'title' => 'خروج', 'template' => 'page-logout.php' ),
  array( 'slug' => 'orders', 'title' => 'سفارش‌ها', 'template' => 'page-orders.php' ),
  );

  foreach ( $pages as $p ) {
    $existing = get_page_by_path( $p['slug'] );
    if ( ! $existing ) {
      $post_id = wp_insert_post( array(
        'post_title' => $p['title'],
        'post_name' => $p['slug'],
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'page',
      ) );
      if ( $post_id && ! is_wp_error( $post_id ) ) {
        // assign template if file exists in theme
        $template_file = get_template_directory() . '/' . $p['template'];
        if ( file_exists( $template_file ) ) {
          update_post_meta( $post_id, '_wp_page_template', $p['template'] );
        }
      }
    }
  }

  // flush rewrite rules once
  flush_rewrite_rules( false );
  update_option( 'force_account_pages_created', '1' );
}
// Run on init so pages exist even if admin hasn't visited admin area yet.
add_action( 'init', 'force_ensure_account_pages' );

// Temporary endpoint to force page creation from the front-end (admins only)
add_action( 'init', function() {
  if ( isset( $_GET['force_create_pages'] ) && $_GET['force_create_pages'] == '1' ) {
    if ( current_user_can( 'manage_options' ) ) {
      force_ensure_account_pages();
      wp_die( 'Pages creation attempted. Check pages list in admin.' );
    } else {
      wp_die( 'Not allowed' );
    }
  }
} );

function display_phone_number() {
  $phone_number = get_option('phone_number');
  echo "<input type='text' name='phone_number' value='$phone_number' />";
}
function display_address() {
  $address = get_option('address');
  echo "<input type='text' name='address' value='$address' />";
}
function display_email() {
  $email = get_option('email');
  echo "<input type='email' name='email' value='$email' />";
}
function display_telegram() {
  $telegram = get_option('telegram');
  echo "<input type='text' name='telegram' value='$telegram' />";
}
function display_instagram() {
  $instagram = get_option('instagram');
  echo "<input type='text' name='instagram' value='$instagram' />";
}
function display_whatsapp() {
  $whatsapp = get_option('whatsapp');
  echo "<input type='text' name='whatsapp' value='$whatsapp' />";
}
function display_aparat() {
  $aparat = get_option('aparat');
  echo "<input type='text' name='aparat' value='$aparat' />";
}

// نمایش بخش محصولات پیشنهادی (Cross-sells) در انتهای صفحه سبد خرید
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );


add_filter( 'woocommerce_checkout_fields', 'force_customize_checkout_fields' );
function force_customize_checkout_fields( $fields ) {
  // حذف فیلد کشور
  unset($fields['billing']['billing_country']);
  unset($fields['shipping']['shipping_country']);

  // تغییر برچسب خیابان به آدرس و غیر الزامی کردن آن
  $fields['billing']['billing_address_1']['label'] = 'آدرس';
  $fields['billing']['billing_address_1']['placeholder'] = 'آدرس کامل خود را وارد کنید';
  $fields['billing']['billing_address_1']['required'] = false;

  // استان و شهر الزامی و انتقال به بالای آدرس
  $fields['billing']['billing_state']['required'] = true;
  $fields['billing']['billing_city']['required'] = true;


  // کد پستی اجباری
  $fields['billing']['billing_postcode']['required'] = true;

  // تلفن اجباری، ایمیل اختیاری
  $fields['billing']['billing_phone']['required'] = true;
  $fields['billing']['billing_email']['required'] = false;

  return $fields;
}
