<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/force-favicon.png"> 
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div class="container">
            <div class="top-header">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo 1.png" alt="<?php bloginfo('name'); ?>" class="logo" loading="lazy" />
                </a>

                <nav class="top-menu">
                    <?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) ); ?>
                </nav>
                
                <div class="header-right-side">
                    <div class="bio-language">
                        <?php do_action('wpml_add_language_selector'); ?>
                    </div>

                    <button class="mobile-menu-open" aria-label="باز کردن منو" aria-expanded="false" aria-controls="mobile-menu-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                            <path d="M1 25.348H25M1 13.4273H25M1 1.50659H25" stroke="black" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div id="mobile-menu-container" class="mobile-menu-container">
        <div class="mobile-menu-overlay"></div>

        <nav class="top-menu-mobile">
            <div class="mobile-menu-header">
                <span>منو</span>
                <button class="mobile-menu-close" aria-label="بستن منو">×</button>
            </div>
            
            <div class="mobile-menu-body">
                <?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'container' => false ) ); ?>
            </div>

            <div class="mobile-menu-footer">
                <div class="bio-language">
                     <?php do_action('wpml_add_language_selector'); ?>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">