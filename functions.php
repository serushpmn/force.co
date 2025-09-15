<?php
function loadfiles()
{
  wp_enqueue_style("style", get_template_directory_uri() . "/style.css", false);
  wp_enqueue_style(
    "swiper",
    "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css",
    false,
  );
  wp_enqueue_style(
    "Font-awesome",
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",
    false,
  );
  wp_enqueue_style(
    "force-account",
    get_template_directory_uri() . "/css/account.css",
    ["style"],
    "1.0",
  );
  wp_enqueue_style(
    "force-orders",
    get_template_directory_uri() . "/css/orders.css",
    ["style"],
    "1.0",
  );
  wp_enqueue_style(
    "force-cart",
    get_template_directory_uri() . "/css/cart-custom.css",
    ["style"],
    "1.0",
  );
  wp_enqueue_style(
    "force-account-edit",
    get_template_directory_uri() . "/css/account-edit.css",
    ["style"],
    "1.0",
  );
  wp_enqueue_style(
    "force-products",
    get_template_directory_uri() . "/css/products.css",
    ["style"],
    "1.0",
  );
  wp_enqueue_script(
    "swiper",
    "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js",
    false,
  );
  // Theme toggle script
  wp_enqueue_script(
    "force-theme-toggle",
    get_template_directory_uri() . "/js/theme-toggle.js",
    [],
    "1.0",
    true,
  );
}
require_once get_template_directory() . "/customize.php";
add_action("wp_enqueue_scripts", "loadfiles");
function register_my_menus()
{
  register_nav_menus([
        'mini-top-menu' => __( 'منوی کوچک بالا' ),
        'top-menu' => __( 'منوی بالا' ),
        'mobile-menu' => __( 'منوی موبایل' ),
        'product-menu' => __( 'منوی محصولات' ),
        'footer-menu' => __( 'منوی فوتر' ),
  ]);
}
add_action("init", "register_my_menus");
add_theme_support("post-thumbnails");
add_image_size("maghalethumb", 200, 200, true); //300 pixels wide (and unlimited height)
function mytheme_add_woocommerce_support()
{
  add_theme_support("woocommerce");
}
add_action("after_setup_theme", "mytheme_add_woocommerce_support");
// add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support("wc-product-gallery-lightbox");
add_theme_support("customizer");
function add_contact_fields()
{
  add_settings_section(
    "contact_section",
    "اطلاعات تماس (جهت نمایش در فوتر)",
    null,
    "general",
  );
  add_settings_field(
    "phone_number",
    "شماره تماس",
    "display_phone_number",
    "general",
    "contact_section",
  );
  add_settings_field(
    "address",
    "آدرس",
    "display_address",
    "general",
    "contact_section",
  );
  add_settings_field(
    "email",
    "ایمیل",
    "display_email",
    "general",
    "contact_section",
  );
  add_settings_field(
    "telegram",
    "لینک تلگرام",
    "display_telegram",
    "general",
    "contact_section",
  );
  add_settings_field(
    "instagram",
    "لینک اینستاگرام",
    "display_instagram",
    "general",
    "contact_section",
  );
  add_settings_field(
    "whatsapp",
    "لینک واتساپ",
    "display_whatsapp",
    "general",
    "contact_section",
  );
  add_settings_field(
    "aparat",
    "لینک آپارات",
    "display_aparat",
    "general",
    "contact_section",
  );
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
function force_ensure_account_pages()
{
  $pages = [
    ["slug" => "login", "title" => "ورود", "template" => "page-login.php"],
    [
      "slug" => "account",
      "title" => "ناحیه کاربری",
      "template" => "page-account.php",
    ],
    [
      "slug" => "edit-account",
      "title" => "ویرایش ناحیه کاربری",
      "template" => "page-edit-account.php",
    ],
    ["slug" => "logout", "title" => "خروج", "template" => "page-logout.php"],
    [
      "slug" => "orders",
      "title" => "سفارش‌ها",
      "template" => "page-orders.php",
    ],
  ];
  $created_any = false;

  foreach ($pages as $p) {
    $existing = get_page_by_path($p["slug"]);
    if (!$existing) {
      $post_id = wp_insert_post([
        "post_title" => $p["title"],
        "post_name" => $p["slug"],
        "post_content" => "",
        "post_status" => "publish",
        "post_type" => "page",
      ]);
      if ($post_id && !is_wp_error($post_id)) {
        // assign template if file exists in theme
        $template_file = get_template_directory() . "/" . $p["template"];
        if (file_exists($template_file)) {
          update_post_meta($post_id, "_wp_page_template", $p["template"]);
        }
        $created_any = true;
      }
    }
  }

  // flush rewrite rules and set created flag only if we actually created pages
  if ($created_any) {
    flush_rewrite_rules(false);
    update_option("force_account_pages_created", "1");
  }
}
// Run on init so pages exist even if admin hasn't visited admin area yet.
add_action("init", "force_ensure_account_pages");

// Temporary endpoint to force page creation from the front-end (admins only)
add_action("init", function () {
  if (
    isset($_GET["force_create_pages"]) &&
    $_GET["force_create_pages"] == "1"
  ) {
    if (current_user_can("manage_options")) {
      force_ensure_account_pages();
      wp_die("Pages creation attempted. Check pages list in admin.");
    } else {
      wp_die("Not allowed");
    }
  }
});

function display_phone_number()
{
  $phone_number = get_option("phone_number");
  echo "<input type='text' name='phone_number' value='$phone_number' />";
}
function display_address()
{
  $address = get_option("address");
  echo "<input type='text' name='address' value='$address' />";
}
function display_email()
{
  $email = get_option("email");
  echo "<input type='email' name='email' value='$email' />";
}
function display_telegram()
{
  $telegram = get_option("telegram");
  echo "<input type='text' name='telegram' value='$telegram' />";
}
function display_instagram()
{
  $instagram = get_option("instagram");
  echo "<input type='text' name='instagram' value='$instagram' />";
}
function display_whatsapp()
{
  $whatsapp = get_option("whatsapp");
  echo "<input type='text' name='whatsapp' value='$whatsapp' />";
}
function display_aparat()
{
  $aparat = get_option("aparat");
  echo "<input type='text' name='aparat' value='$aparat' />";
}

// نمایش بخش محصولات پیشنهادی (Cross-sells) در انتهای صفحه سبد خرید
remove_action("woocommerce_cart_collaterals", "woocommerce_cross_sell_display");
add_action("woocommerce_after_cart", "woocommerce_cross_sell_display");

add_filter("woocommerce_checkout_fields", "force_customize_checkout_fields");
function force_customize_checkout_fields($fields)
{
  // حذف فیلد کشور
  unset($fields["billing"]["billing_country"]);
  unset($fields["shipping"]["shipping_country"]);

  // تغییر برچسب خیابان به آدرس و غیر الزامی کردن آن
  $fields["billing"]["billing_address_1"]["label"] = "آدرس";
  $fields["billing"]["billing_address_1"]["placeholder"] =
    "آدرس کامل خود را وارد کنید";
  $fields["billing"]["billing_address_1"]["required"] = false;

  // استان و شهر الزامی و انتقال به بالای آدرس
  $fields["billing"]["billing_state"]["required"] = true;
  $fields["billing"]["billing_city"]["required"] = true;

  // کد پستی اجباری
  $fields["billing"]["billing_postcode"]["required"] = true;

  // تلفن اجباری، ایمیل اختیاری
  $fields["billing"]["billing_phone"]["required"] = true;
  $fields["billing"]["billing_email"]["required"] = false;

  return $fields;
}

// Enqueue CSS/JS for single product comments + rating
add_action("wp_enqueue_scripts", function () {
  // فقط در صفحات تک محصول (WooCommerce) یا صفحات تک پست نمایش بده
  if (is_singular("product") || is_singular()) {
    wp_enqueue_style(
      "force-single-product",
      get_stylesheet_directory_uri() . "/css/single-product.css",
      [],
      null,
    );
    wp_enqueue_script(
      "force-comment-rating",
      get_stylesheet_directory_uri() . "/js/comment-rating.js",
      ["jquery"],
      null,
      true,
    );
  }
});

// چاپ فیلد ستاره‌ها در فرم نظرات (برای کاربر لاگین و غیر لاگین)
function force_comment_rating_field()
{
  // فقط در صفحات تک محصول یا تک نوشته نمایش ده
  if (!(is_singular("product") || is_singular())) {
    return;
  }

  // مقدار پیش‌فرض صفر
  echo '
	<div class="force-comment-rating">
		<label for="rating">امتیاز شما:</label>
		<div class="rating-stars" data-selected="0" aria-hidden="true">
			<span class="star" data-value="1">☆</span>
			<span class="star" data-value="2">☆</span>
			<span class="star" data-value="3">☆</span>
			<span class="star" data-value="4">☆</span>
			<span class="star" data-value="5">☆</span>
		</div>
		<input type="hidden" name="rating" id="rating" value="0" />
	</div>
	';
}
add_action("comment_form_logged_in_after", "force_comment_rating_field");
add_action("comment_form_after_fields", "force_comment_rating_field");

// ذخیره‌ی rating در متای کامنت بعد از ارسال
function force_save_comment_rating($comment_id)
{
  if (isset($_POST["rating"])) {
    $rating = intval($_POST["rating"]);
    if ($rating < 0) {
      $rating = 0;
    }
    if ($rating > 5) {
      $rating = 5;
    }
    add_comment_meta($comment_id, "rating", $rating, true);
  }
}
add_action("comment_post", "force_save_comment_rating", 10, 2);

// Helper: خروجی HTML ستاره‌ها برای نمایش در نظرها
function force_get_rating_stars($rating)
{
  $rating = intval($rating);
  $rating = max(0, min(5, $rating));
  $html = '<span class="comment-rating" aria-hidden="true">';
  for ($i = 1; $i <= 5; $i++) {
    $html .=
      $i <= $rating
        ? '<span class="star filled">★</span>'
        : '<span class="star">☆</span>';
  }
  $html .= "</span>";
  return $html;
}

// افزودن ستاره‌ها به ابتدای متن نظر (فقط در صفحات تک محصول/تک نوشته)
function force_append_rating_to_comment_text($comment_text, $comment)
{
  if (is_admin()) {
    return $comment_text;
  }
  if (!(is_singular("product") || is_singular())) {
    return $comment_text;
  }

  $rating = get_comment_meta($comment->comment_ID, "rating", true);
  if ($rating !== "" && $rating !== false) {
    $stars = force_get_rating_stars($rating);
    return $stars . " " . $comment_text;
  }
  return $comment_text;
}
add_filter("comment_text", "force_append_rating_to_comment_text", 10, 2);

// enable comments support for WooCommerce products and ensure reviews enabled
add_action(
  "init",
  function () {
    // ensure product post type supports comments (reviews)
    if (post_type_exists("product")) {
      add_post_type_support("product", "comments");
    }

    // enable WooCommerce reviews if not already enabled
    if (function_exists("is_woocommerce")) {
      if (get_option("woocommerce_enable_reviews") !== "yes") {
        update_option("woocommerce_enable_reviews", "yes");
      }
    }
  },
  20,
);

// Ensure comments are considered open for product post type
add_filter(
  "comments_open",
  function ($open, $post_id) {
    $post = get_post($post_id);
    if ($post && $post->post_type === "product") {
      return true;
    }
    return $open;
  },
  10,
  2,
);

// Load comments template on single product pages (without editing template files)
add_action(
  "woocommerce_after_single_product",
  function () {
    if (is_singular("product")) {
      // show reviews area only if comments enabled or there are existing comments
      if (comments_open() || get_comments_number()) {
        comments_template();
      }
    }
  },
  20,
);

// Banner in Header
function create_banner_post_type()
{
  $labels = [
    "name" => "بنرها",
    "singular_name" => "بنر",
    "add_new" => "افزودن بنر جدید",
    "add_new_item" => "افزودن بنر جدید",
    "edit_item" => "ویرایش بنر",
    "new_item" => "بنر جدید",
    "view_item" => "مشاهده بنر",
    "search_items" => "جستجوی بنرها",
    "not_found" => "بندی یافت نشد",
    "not_found_in_trash" => "بندی در زباله‌دان یافت نشد",
  ];

  $args = [
    "labels" => $labels,
    "public" => true,
    "has_archive" => false,
    "publicly_queryable" => false,
    "show_in_menu" => true,
    "menu_icon" => "dashicons-megaphone", // آیکون منو
    "supports" => ["title"], // فقط از عنوان پشتیبانی می‌کند
  ];

  register_post_type("top_banner", $args);
}
add_action("init", "create_banner_post_type");

//slider
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title' 	=> 'تنظیمات اسلایدر اصلی', // تیتری که در بالای صفحه نمایش داده میشه
        'menu_title'	=> 'اسلایدر Hero', // نامی که در منوی پیشخوان میبینید
        'menu_slug' 	=> 'hero-slider-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
    
}