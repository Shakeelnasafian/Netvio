<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-gray-800'); ?>>
    <a class="skip-link screen-reader-text" href="#primary">
        <?php esc_html_e('Skip to content', 'netvio'); ?>
    </a>

    <!-- Top Bar -->
    <!-- <div class="hidden sm:flex bg-gray-800 text-white text-sm justify-between px-6 py-2">
        <div class="flex space-x-4">
            <span class="flex justify-between items-center">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/location-color.svg" class="w-3">
                <span class="px-2">Pakistan, Islamabad</span>
            </span>
            <span class="flex justify-between items-center">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/email-color-sm.svg" class="w-3">
                <span class="px-2">info@netvio.com</span>
            </span>
        </div>
        <div class="flex space-x-4">
            <span class="flex justify-between items-center">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Time.svg" alt="" class="w-3">
                <span class="px-2">Mon - Fri: 8:00 am - 5:00 pm</span>
            </span>
            <div class="flex justify-between items-center space-x-2">
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Twiter.svg" alt="" class="w-3"></a>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Fb.svg" alt="" class="w-3"></a>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Insta.svg" alt="" class="w-3"></a>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Pintrest.svg" alt="" class="w-3"></a>
            </div>
        </div>
    </div> -->

    <!-- Navbar -->
    <div class="border-b border-gray-300">
        <nav class="flex justify-between items-center px-6 py-4 relative  max-w-7xl mx-auto">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="<?= site_url() ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-netvio.svg'); ?>" class="h-8" alt="Netvio Logo"></a>
            </div>

            <!-- Desktop Menu -->
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'hidden md:flex space-x-8 text-gray-700',
                'link_before' => '<span class="text-primary font-semibold">',
                'link_after' => '</span>',
                'fallback_cb' => false,
            ]);
            ?>

            <!-- Desktop Button -->
            <!-- <button class="hidden md:block border-2 border-primary text-primary px-4 py-2 rounded-full hover:bg-purple-100">
        <?php esc_html_e('Let\'s Talk', 'netvio'); ?>
    </button> -->

            <!-- Hamburger Icon -->
            <div class="md:hidden">
                <button id="menu-toggle">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white shadow-md">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex flex-col space-y-4 p-6 text-gray-700',
                    'link_before' => '<span class="text-primary font-semibold">',
                    'link_after' => '</span>',
                    'fallback_cb' => false,
                ]);
                ?>
                <!-- <div class="p-6">
            <button class="w-full border-2 border-primary text-primary px-4 py-2 rounded-full hover:bg-purple-100">
                <?php esc_html_e('Let’s Talk', 'netvio'); ?>
            </button>
        </div> -->
            </div>
        </nav>

    </div>