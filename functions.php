<?php
// Load theme textdomain for translations
function netvio_load_textdomain()
{
    load_theme_textdomain('netvio', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'netvio_load_textdomain');


function netvio_asset_version($relative_path)
{
    $file_path = get_theme_file_path($relative_path);
    return file_exists($file_path) ? filemtime($file_path) : wp_get_theme()->get('Version');
}

function netvio_enqueue_assets()
{
    wp_enqueue_style(
        'netvio-tailwind',
        get_theme_file_uri('/assets/css/style.css'),
        array(),
        netvio_asset_version('/assets/css/style.css')
    );

    wp_enqueue_style(
        'netvio-css',
        get_theme_file_uri('/style.css'),
        array('netvio-tailwind'),
        netvio_asset_version('/style.css')
    );

    if (is_front_page()) {
        wp_enqueue_style(
            'netvio-home',
            get_theme_file_uri('/assets/css/home.css'),
            array('netvio-tailwind'),
            netvio_asset_version('/assets/css/home.css')
        );
    }

    wp_enqueue_script(
        'netvio-menu',
        get_theme_file_uri('/assets/js/menu.js'),
        array(),
        netvio_asset_version('/assets/js/menu.js'),
        true
    );

    wp_enqueue_script(
        'tw-calculators',
        get_theme_file_uri('/assets/js/calculators.js'),
        array(),
        netvio_asset_version('/assets/js/calculators.js'),
        true
    );
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

function netvio_render_meta_box_nonce()
{
    static $done = false;
    if ($done) {
        return;
    }
    wp_nonce_field('netvio_meta_box', 'netvio_meta_box_nonce');
    $done = true;
}

function netvio_shortcode_meta_box_callback($post)
{
    netvio_render_meta_box_nonce();
    $value = get_post_meta($post->ID, '_netvio_shortcode', true);
    echo '<textarea style="width:100%;min-height:40px;" name="netvio_shortcode">' . esc_textarea($value) . '</textarea>';
    echo '<p class="description">' . __('Paste your shortcode here.', 'netvio') . '</p>';
}

function netvio_header_content_meta_box_callback($post)
{
    netvio_render_meta_box_nonce();
    $value = get_post_meta($post->ID, '_netvio_header_content', true);
    echo '<textarea style="width:100%;min-height:60px;" name="netvio_header_content">' . esc_textarea($value) . '</textarea>';
    echo '<p class="description">' . __('Add custom header content (HTML allowed).', 'netvio') . '</p>';
}

// Save custom fields
function netvio_save_page_meta_boxes($post_id)
{
    if (defined('DOING_AUTOSAVE') && constant('DOING_AUTOSAVE')) {
        return;
    }

    if (!isset($_POST['netvio_meta_box_nonce']) || !wp_verify_nonce($_POST['netvio_meta_box_nonce'], 'netvio_meta_box')) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (array_key_exists('netvio_shortcode', $_POST)) {
        update_post_meta($post_id, '_netvio_shortcode', sanitize_text_field(wp_unslash($_POST['netvio_shortcode'])));
    }
    if (array_key_exists('netvio_header_content', $_POST)) {
        update_post_meta($post_id, '_netvio_header_content', wp_kses_post(wp_unslash($_POST['netvio_header_content'])));
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

