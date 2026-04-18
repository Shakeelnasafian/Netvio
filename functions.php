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

// Add defer attribute to our own scripts so they never block first paint.
function netvio_defer_scripts($tag, $handle)
{
    $defer = array('netvio-menu', 'tw-calculators');
    if (in_array($handle, $defer, true) && strpos($tag, ' defer') === false) {
        $tag = str_replace(' src=', ' defer src=', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'netvio_defer_scripts', 10, 2);

// Remove WordPress frontend bloat that hurts Core Web Vitals and first paint.
function netvio_trim_head()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'netvio_trim_head');

// Core SEO + social + performance meta tags injected into <head>.
function netvio_head_meta()
{
    $site_name   = get_bloginfo('name');
    $description = 'Free, accurate health and fitness calculators plus plain-English guides. No signup, private, instant — BMI, pregnancy, TDEE and more.';

    if (is_singular()) {
        $excerpt = wp_strip_all_tags(get_the_excerpt());
        if ($excerpt) {
            $description = wp_trim_words($excerpt, 32, '…');
        }
    }

    $title_tag = wp_get_document_title();
    $canonical = is_singular() ? get_permalink() : home_url(add_query_arg(array(), $GLOBALS['wp']->request));
    $og_image  = get_theme_file_uri('/screenshot.png');
    $logo_url  = get_theme_file_uri('/assets/images/logo-netvio.svg');

    echo "\n";
    echo '<meta name="description" content="' . esc_attr($description) . '" />' . "\n";
    echo '<meta name="theme-color" content="#593FFB" />' . "\n";
    echo '<meta name="robots" content="index, follow, max-image-preview:large" />' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical) . '" />' . "\n";

    // Perf hints
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />' . "\n";
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com" />' . "\n";
    echo '<link rel="preload" as="image" href="' . esc_url($logo_url) . '" fetchpriority="high" />' . "\n";

    // Icons / PWA
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url($logo_url) . '" />' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($logo_url) . '" />' . "\n";

    // Open Graph
    echo '<meta property="og:type" content="website" />' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title_tag) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url($canonical) . '" />' . "\n";
    echo '<meta property="og:image" content="' . esc_url($og_image) . '" />' . "\n";

    // Twitter
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title_tag) . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($og_image) . '" />' . "\n";

    // JSON-LD: Organization + WebSite with SearchAction
    $org = array(
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => $site_name,
        'url'      => home_url('/'),
        'logo'     => $logo_url,
    );
    $website = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        'name'            => $site_name,
        'url'             => home_url('/'),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => home_url('/?s={search_term_string}'),
            'query-input' => 'required name=search_term_string',
        ),
    );
    echo '<script type="application/ld+json">' . wp_json_encode($org) . '</script>' . "\n";
    echo '<script type="application/ld+json">' . wp_json_encode($website) . '</script>' . "\n";
}
add_action('wp_head', 'netvio_head_meta', 2);

// Inline SVG icon helper — replaces the never-loaded lucide <i> tags so icons
// render instantly with zero JavaScript or network cost.
function netvio_icon($name, $class = 'w-5 h-5')
{
    $paths = array(
        'arrow-right'    => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'arrow-up-right' => '<path d="M7 7h10v10"/><path d="M7 17 17 7"/>',
        'calculator'     => '<rect width="16" height="20" x="4" y="2" rx="2"/><line x1="8" x2="16" y1="6" y2="6"/><line x1="16" x2="16" y1="14" y2="18"/><path d="M16 10h.01"/><path d="M12 10h.01"/><path d="M8 10h.01"/><path d="M12 14h.01"/><path d="M8 14h.01"/><path d="M12 18h.01"/><path d="M8 18h.01"/>',
        'heart'          => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>',
        'target'         => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
        'baby'           => '<path d="M9 12h.01"/><path d="M15 12h.01"/><path d="M10 16c.5.3 1.2.5 2 .5s1.5-.2 2-.5"/><path d="M17.5 7.5 19 9"/><path d="M3 12a9 9 0 1 0 18 0 9 9 0 0 0-18 0Z"/>',
        'shield-check'   => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67 0C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1Z"/><path d="m9 12 2 2 4-4"/>',
        'zap'            => '<path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/>',
        'sparkles'       => '<path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/>',
        'users'          => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'lock'           => '<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
        'menu'           => '<line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/>',
        'x'              => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
        'mail'           => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
    );

    if (!isset($paths[$name])) {
        return '';
    }

    return sprintf(
        '<svg xmlns="http://www.w3.org/2000/svg" class="%s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%s</svg>',
        esc_attr($class),
        $paths[$name]
    );
}

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

