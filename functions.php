<?php

function netvio_enqueue_assets()
{
    wp_enqueue_style('netvio-tailwind', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');

    // Enqueue menu.js
    wp_enqueue_script('netvio-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), time());
}
add_action('wp_enqueue_scripts', 'netvio_enqueue_assets');

// Theme Supports
function netvio_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('menus');
}
add_action('after_setup_theme', 'netvio_theme_setup');

