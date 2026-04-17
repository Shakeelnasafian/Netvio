<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-slate-800 antialiased'); ?>>
    <?php wp_body_open(); ?>
    <a class="skip-link screen-reader-text sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:px-4 focus:py-2 focus:bg-white focus:text-blue-700 focus:rounded-lg focus:shadow" href="#primary">
        <?php esc_html_e('Skip to content', 'netvio'); ?>
    </a>

    <!-- Announcement bar — quick trust cue visible in the first viewport -->
    <div class="hidden sm:block bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 text-white text-xs">
        <div class="max-w-7xl mx-auto px-6 py-2 flex justify-center items-center gap-6">
            <span class="inline-flex items-center gap-2">
                <?php echo netvio_icon('lock', 'w-3.5 h-3.5'); ?>
                <?php esc_html_e('100% private — nothing leaves your browser', 'netvio'); ?>
            </span>
            <span class="inline-flex items-center gap-2">
                <?php echo netvio_icon('zap', 'w-3.5 h-3.5'); ?>
                <?php esc_html_e('Instant results. No signup.', 'netvio'); ?>
            </span>
            <span class="inline-flex items-center gap-2">
                <?php echo netvio_icon('shield-check', 'w-3.5 h-3.5'); ?>
                <?php esc_html_e('Formulas reviewed by pros', 'netvio'); ?>
            </span>
        </div>
    </div>

    <!-- Sticky navbar keeps navigation visible while users scroll long pages -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur supports-[backdrop-filter]:bg-white/75 border-b border-slate-200">
        <nav class="flex justify-between items-center px-4 sm:px-6 py-3 relative max-w-7xl mx-auto" aria-label="<?php esc_attr_e('Primary', 'netvio'); ?>">
            <div class="flex items-center space-x-2">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center" aria-label="<?php esc_attr_e('Netvio home', 'netvio'); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-netvio.svg'); ?>"
                        class="h-8 w-auto" width="120" height="32" alt="<?php esc_attr_e('Netvio', 'netvio'); ?>" fetchpriority="high" />
                </a>
            </div>

            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'hidden md:flex items-center space-x-8 text-slate-700',
                'link_before' => '<span class="hover:text-blue-600 font-medium transition-colors">',
                'link_after' => '</span>',
                'fallback_cb' => false,
            ]);
            ?>

            <div class="hidden md:flex items-center gap-3">
                <a href="<?php echo esc_url(home_url('/#calculators')); ?>"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-sm">
                    <?php esc_html_e('Try a Calculator', 'netvio'); ?>
                    <?php echo netvio_icon('arrow-right', 'w-4 h-4'); ?>
                </a>
            </div>

            <div class="md:hidden">
                <button id="menu-toggle" type="button" aria-controls="mobile-menu" aria-expanded="false"
                    aria-label="<?php esc_attr_e('Toggle menu', 'netvio'); ?>"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg text-slate-700 hover:bg-slate-100">
                    <span id="menu-icon-open" class="block"><?php echo netvio_icon('menu', 'w-6 h-6'); ?></span>
                    <span id="menu-icon-close" class="hidden"><?php echo netvio_icon('x', 'w-6 h-6'); ?></span>
                </button>
            </div>

            <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white shadow-lg border-t border-slate-200">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex flex-col space-y-1 p-4 text-slate-700',
                    'link_before' => '<span class="block px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-blue-600 font-medium transition-colors">',
                    'link_after' => '</span>',
                    'fallback_cb' => false,
                ]);
                ?>
                <div class="p-4 border-t border-slate-100">
                    <a href="<?php echo esc_url(home_url('/#calculators')); ?>"
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                        <?php esc_html_e('Try a Calculator', 'netvio'); ?>
                        <?php echo netvio_icon('arrow-right', 'w-4 h-4'); ?>
                    </a>
                </div>
            </div>
        </nav>
    </header>
