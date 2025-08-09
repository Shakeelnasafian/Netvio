<?php
// Load theme textdomain for translations
function netvio_load_textdomain() {
    load_theme_textdomain('netvio', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'netvio_load_textdomain');


function netvio_enqueue_assets()
{
    wp_enqueue_style('netvio-tailwind', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_style('netvio-css', get_template_directory_uri() . '/style.css', array(), '1.0.0');

    if ( is_home() ) {
        wp_enqueue_style('netvio-home', get_template_directory_uri() . '/assets/css/home.css', array(), '1.0.0');
    }

    // Enqueue menu.js
    wp_enqueue_script('netvio-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), time());

    wp_enqueue_script('tw-calculators', get_stylesheet_directory_uri() . '/assets/js/calculators.js', array(), time());
}
add_action('wp_enqueue_scripts', 'netvio_enqueue_assets');

// Theme Supports
function netvio_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    // Register navigation menus
    register_nav_menus([
        'primary' => __('Primary Menu', 'netvio'),
        'footer'  => __('Footer Menu', 'netvio'),
    ]);
}
add_action('after_setup_theme', 'netvio_theme_setup');

