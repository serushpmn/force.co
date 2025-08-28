<!DOCTYPE html>
<html lang="fa-IR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo get_bloginfo('template_url');?>/img/force-favicon.png"> 
    <title><?php bloginfo('name'); ?> </title>
        <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- header  -->
    
      <header >
      <div class="container">
        <div class="top-header">
        <a href="https://force.co.ir/">
          <img src="<?php echo get_template_directory_uri();?>/img/logo 1.png" alt="" class="logo" loading="lazy" />
        </a>
        <nav class="top-menu">
        <?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) ); ?>
        </nav>
        
        <div class="bio-language">
        <a href="#">فارسی</a>
          /
          <a href="#">English</a>
          <a href="#" class="mobile-menu-icon"
          ><svg
            xmlns="http://www.w3.org/2000/svg"
            width="26"
            height="27"
            viewBox="0 0 26 27"
            fill="none"
          >
            <path
              d="M1 25.348H25M1 13.4273H25M1 1.50659H25"
              stroke="white"
              stroke-width="1.875"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </a>
        </div>
         <?php do_action('wpml_add_language_selector');?>
        </div>
        
        </div>
      </header>
      <nav class="top-menu-mobile">
        <a href="#" class="mobile-menu-icon"
          >X
        </a>
        <div class="bio-language">
          <a href="#">فارسی</a>
          /
          <a href="#">English</a>
        </div>
        <?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) ); ?>
      </nav>
      <div class="container">
