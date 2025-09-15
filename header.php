<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo("charset"); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/force-favicon.png"> 
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php wp_head(); ?>
    
       
</head>

<body <?php body_class(); ?>>
    <script src="<?php echo get_template_directory_uri(); ?>/js/tooltip.js"></script>
    <script>
    // اسکریپت باز و بسته شدن زیرمنوها فقط در موبایل
    document.addEventListener('DOMContentLoaded', function() {
        function isMobile() {
            return window.innerWidth <= 1023;
        }
        function setupMobileSubmenus() {
            // حذف دکمه‌های قبلی
            document.querySelectorAll('.top-menu-mobile .submenu-toggle').forEach(btn => btn.remove());
            // افزودن دکمه به آیتم‌هایی که زیرمنو دارند
            document.querySelectorAll('.top-menu-mobile .menu-item-has-children').forEach(function(item) {
                var link = item.querySelector('a');
                if (!item.querySelector('.submenu-toggle')) {
                    var btn = document.createElement('button');
                    btn.setAttribute('type', 'button');
                    btn.className = 'submenu-toggle';
                    btn.setAttribute('aria-label', 'باز/بستن زیرمنو');
                    btn.innerHTML = '<span aria-hidden="true">&#x2C5;</span>';
                    link.parentNode.insertBefore(btn, link.nextSibling);
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        item.classList.toggle('open');
                    });
                }
                // حذف جلوگیری از باز شدن لینک والد
                // فقط فلش زیرمنو را باز/بسته می‌کند
            });
        }
        // اجرا در بارگذاری و تغییر سایز
        if (document.querySelector('.top-menu-mobile')) {
            setupMobileSubmenus();
            window.addEventListener('resize', function() {
                setupMobileSubmenus();
            });
        }
    });
    </script>
<?php
// کوئری برای گرفتن آخرین بنر منتشر شده
$args = [
  "post_type" => "top_banner",
  "posts_per_page" => 1,
  "post_status" => "publish",
];
$banner_query = new WP_Query($args);

// اگر بنری وجود داشت
if ($banner_query->have_posts()):
  while ($banner_query->have_posts()):
    $banner_query->the_post();

    // گرفتن عکس‌ها از فیلدهای ACF
    $desktop_img = get_field("banner_desktop");
    $tablet_img = get_field("banner_tablet");
    $mobile_img = get_field("banner_mobile");

    // helper to get URL and alt for different ACF return types (array, ID, or URL)
    function _force_get_img_data($img) {
      if (!$img) return ['url' => '', 'alt' => ''];
      // array (default ACF image return)
      if (is_array($img) && !empty($img['url'])) {
        return ['url' => $img['url'], 'alt' => (!empty($img['alt']) ? $img['alt'] : '')];
      }
      // numeric ID
      if (is_numeric($img)) {
        $url = wp_get_attachment_url($img);
        $alt = get_post_meta($img, '_wp_attachment_image_alt', true);
        return ['url' => $url ? $url : '', 'alt' => $alt ? $alt : ''];
      }
      // string URL
      if (is_string($img)) {
        return ['url' => $img, 'alt' => ''];
      }
      return ['url' => '', 'alt' => ''];
    }

    $desktop = _force_get_img_data($desktop_img);
    $tablet = _force_get_img_data($tablet_img);
    $mobile = _force_get_img_data($mobile_img);

    // فقط اگر حداقل تصویر موبایل وجود داشت، بنر را نمایش بده
    if (!empty($mobile['url'])): ?>
            <div id="top-site-banner" class="top-site-banner">
                <a href="<?php echo esc_url(get_field('banner_link') ?: '#'); ?>">
                    <picture>
                        <?php if (!empty($desktop['url'])): ?>
                            <source media="(min-width: 1024px)" srcset="<?php echo esc_url($desktop['url']); ?>">
                        <?php endif; ?>

                        <?php if (!empty($tablet['url'])): ?>
                            <source media="(min-width: 768px)" srcset="<?php echo esc_url($tablet['url']); ?>">
                        <?php endif; ?>

                        <img src="<?php echo esc_url($mobile['url']); ?>" alt="<?php echo esc_attr($mobile['alt']); ?>" />
                    </picture>
                </a>
                <button class="close-banner-btn" id="closeBannerBtn" aria-label="بستن بنر">&times;</button>
            </div>
<?php endif;
  endwhile;
  wp_reset_postdata();
endif;
?>
    <header>
      <nav class="mini-top-menu">
        <?php wp_nav_menu(["theme_location" => "mini-top-menu"]); ?>
</nav>
        <div class="container">
            <div class="top-header">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo 1.png" alt="<?php bloginfo(
  "name",
); ?>" class="logo" loading="lazy" />
                </a>

                <nav class="top-menu">
                    <?php wp_nav_menu(["theme_location" => "top-menu"]); ?>
                </nav>
                
                <div class="header-right-side">
                                        <!-- Theme toggle button -->
                                        <button
                                                id="themeToggle"
                                                class="theme-toggle"
                                                aria-label="تغییر تم"
                                                aria-pressed="false"
                                                title="تغییر حالت روشن/تاریک">
                                                <svg
                                                    width="28"
                                                    height="28"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <!-- Sun -->
                                                    <g
                                                        class="sun"
                                                        stroke="#FE590F"
                                                        stroke-width="1.6"
                                                        stroke-linecap="round">
                                                        <circle cx="12" cy="12" r="3.5" fill="none" />
                                                        <path
                                                            d="M12 2.5v2.2M12 19.3v2.2M4.7 4.7l1.6 1.6M17.7 17.7l1.6 1.6M2.5 12h2.2M19.3 12h2.2M4.7 19.3l1.6-1.6M17.7 6.3l1.6-1.6" />
                                                    </g>
                                                    <!-- Moon -->
                                                    <path
                                                        class="moon"
                                                        d="M15.5 3.5c.2.7.3 1.3.3 2 0 4.7-3.8 8.5-8.5 8.5-1 0-2-.2-2.9-.5A8.5 8.5 0 0012 21.5c4.7 0 8.5-3.8 8.5-8.5 0-4-2.8-7.3-6.5-8.5z"
                                                        fill="#FE590F" />
                                                </svg>
                                        </button>
                                <!-- Cart button -->
                    <a href="<?php echo esc_url(
                      function_exists("wc_get_cart_url")
                        ? wc_get_cart_url()
                        : site_url("/cart"),
                    ); ?>" class="cart-header-btn" aria-label="سبد خرید" >
                        <i class="fa fa-shopping-cart" aria-hidden="true" ></i>
                        <?php $cart_count =
                          function_exists("WC") && WC()->cart
                            ? WC()->cart->get_cart_contents_count()
                            : 0; ?>
                        <?php if ($cart_count > 0): ?>
                            <span class="cart-count-badge">
                                <?php echo esc_html($cart_count); ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <!-- Account / Login -->
                    <div class="header-account" style="display:inline-block; margin-left:10px;">
                        <?php if (is_user_logged_in()):

                          $current_user = wp_get_current_user();
                          // Use the theme pages created: /account and /logout
                          $account_page = home_url("/account");
                          $logout_page = home_url("/logout");
                          ?>
                            <a href="<?php echo esc_url(
                              $account_page,
                            ); ?>" class="account-link"><?php echo esc_html(
  $current_user->display_name
    ? $current_user->display_name
    : $current_user->user_login,
); ?></a>
                            <a href="<?php echo esc_url(
                              $logout_page,
                            ); ?>" class="logout-link">خروج</a>
                        <?php
                          // Link to the theme's custom login page


                        else:
                          $login_page = home_url("/login"); ?>
                            <a href="<?php echo esc_url(
                              $login_page,
                            ); ?>" class="account-link">ورود / ثبت‌نام</a>
                        <?php
                        endif; ?>
                    </div>

                    <button class="mobile-menu-open" aria-label="باز کردن منو" aria-expanded="false" aria-controls="mobile-menu-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                            <path d="M1 25.348H25M1 13.4273H25M1 1.50659H25" stroke="var(--black-900)" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div id="mobile-menu-container" class="mobile-menu-container">
        <div class="mobile-menu-overlay"></div>

        <nav class="top-menu-mobile">
            <div class="mobile-menu-body">
                <?php wp_nav_menu([
                  "theme_location" => "mobile-menu",
                  "container" => false,
                ]); ?>
                <div class="mobile-menu-actions" style="display:flex;flex-direction:column; background:var(--orange-50)">
                    <a href="<?php echo esc_url(
                      function_exists("wc_get_cart_url")
                        ? wc_get_cart_url()
                        : site_url("/cart"),
                    ); ?>" class="mobile-cart-link">
                        <i class="fa fa-shopping-cart" aria-hidden="true" style="margin-left:8px;"></i>
                        سبد خرید
                    </a>
                    <?php if (is_user_logged_in()): ?>
                        <a href="<?php echo esc_url(
                          home_url("/account"),
                        ); ?>">
                            <i class="fa fa-user" aria-hidden="true" style="margin-left:8px;"></i>
                            حساب من
                        </a>
                        <a href="<?php echo esc_url(
                          home_url("/logout"),
                        ); ?>">
                            <i class="fa fa-sign-out" aria-hidden="true" style="margin-left:8px;"></i>
                            خروج
                        </a>
                    <?php else: ?>
                        <a href="<?php echo esc_url(
                          home_url("/login"),
                        ); ?>">
                            <i class="fa fa-sign-in" aria-hidden="true" style="margin-left:8px;"></i>
                            ورود / ثبت‌نام
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">