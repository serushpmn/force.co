<?php 
function loadfiles(){
    wp_enqueue_style( 'style', get_template_directory_uri().'/style.css',false);
    wp_enqueue_style( 'swiper','https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css',false);
    wp_enqueue_style( 'Font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',false);
    wp_enqueue_script( 'swiper','https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', false );
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
?>
