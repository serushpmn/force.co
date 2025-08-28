<?php

function force_customizer( $wp_customize ) {
  // All the Customize Options you create goes here

  $wp_customize->add_section( 'logostyle' , array(
    'title'      => __( 'لوگو و استایل', 'mytheme' ),
    'description' => __('home section customizer'),
    'priority'   => 200,
    'active_callback' => '__return_true', 
) );
    };

add_action( 'customize_register', 'force_customizer' );