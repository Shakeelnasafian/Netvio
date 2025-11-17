<?php
// Load theme textdomain for translations
function netvio_load_textdomain()
{
    load_theme_textdomain('netvio', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'netvio_load_textdomain');


function netvio_enqueue_assets()
{
    wp_enqueue_style('netvio-tailwind', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_style('netvio-css', get_template_directory_uri() . '/style.css', array(), '1.0.0');

    if (is_home()) {
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

// Add custom fields (meta boxes) for Shortcode and Header Content on pages
function netvio_add_page_meta_boxes()
{
    add_meta_box(
        'netvio_shortcode',
        __('Shortcode', 'netvio'),
        'netvio_shortcode_meta_box_callback',
        'page',
        'normal',
        'high'
    );
    add_meta_box(
        'netvio_header_content',
        __('Header Content', 'netvio'),
        'netvio_header_content_meta_box_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'netvio_add_page_meta_boxes');

function netvio_shortcode_meta_box_callback($post)
{
    $value = get_post_meta($post->ID, '_netvio_shortcode', true);
    echo '<textarea style="width:100%;min-height:40px;" name="netvio_shortcode">' . esc_textarea($value) . '</textarea>';
    echo '<p class="description">' . __('Paste your shortcode here.', 'netvio') . '</p>';
}

function netvio_header_content_meta_box_callback($post)
{
    $value = get_post_meta($post->ID, '_netvio_header_content', true);
    echo '<textarea style="width:100%;min-height:60px;" name="netvio_header_content">' . esc_textarea($value) . '</textarea>';
    echo '<p class="description">' . __('Add custom header content (HTML allowed).', 'netvio') . '</p>';
}

// Save custom fields
function netvio_save_page_meta_boxes($post_id)
{
    if (array_key_exists('netvio_shortcode', $_POST)) {
        update_post_meta($post_id, '_netvio_shortcode', sanitize_text_field($_POST['netvio_shortcode']));
    }
    if (array_key_exists('netvio_header_content', $_POST)) {
        update_post_meta($post_id, '_netvio_header_content', wp_kses_post($_POST['netvio_header_content']));
    }
}
add_action('save_post_page', 'netvio_save_page_meta_boxes');

// Add built-in categories to pages
function add_categories_to_pages() {
    register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'add_categories_to_pages');

// Add built-in post tags to pages
function add_tags_to_pages() {
    register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_tags_to_pages');

