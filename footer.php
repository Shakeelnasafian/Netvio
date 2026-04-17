<footer class="bg-slate-900 text-slate-200 mt-12">
    <div class="max-w-7xl mx-auto px-6 py-14 grid grid-cols-1 md:grid-cols-12 gap-10">
        <div class="md:col-span-4">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center" aria-label="<?php esc_attr_e('Netvio home', 'netvio'); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/white-logo.svg'); ?>" class="h-8 w-auto" alt="<?php esc_attr_e('Netvio', 'netvio'); ?>" width="120" height="32" />
            </a>
            <p class="mt-4 text-slate-400 text-sm leading-relaxed max-w-sm">
                <?php esc_html_e('Free, private health and fitness calculators plus plain-English guides. Built so you can get a clear answer in seconds — no signup, no tracking.', 'netvio'); ?>
            </p>
            <p class="mt-4 text-sm text-slate-400 inline-flex items-center gap-2">
                <?php echo netvio_icon('mail', 'w-4 h-4 text-blue-400'); ?>
                <a href="mailto:hello@netvio.tech" class="hover:text-white transition-colors">hello@netvio.tech</a>
            </p>
        </div>

        <div class="md:col-span-2">
            <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4"><?php esc_html_e('Explore', 'netvio'); ?></h4>
            <?php
            if (has_nav_menu('footer')) {
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'space-y-2 text-sm text-slate-400',
                    'link_before'    => '<span class="hover:text-white transition-colors">',
                    'link_after'     => '</span>',
                    'fallback_cb'    => false,
                ]);
            } else { ?>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="<?php echo esc_url(home_url('/#calculators')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Calculators', 'netvio'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#guides')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Guides', 'netvio'); ?></a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Blog', 'netvio'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#contact')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Contact', 'netvio'); ?></a></li>
                </ul>
            <?php } ?>
        </div>

        <div class="md:col-span-3">
            <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4"><?php esc_html_e('Popular tools', 'netvio'); ?></h4>
            <ul class="space-y-2 text-sm text-slate-400">
                <li><a href="<?php echo esc_url(home_url('/bmi-calculator')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('BMI Calculator', 'netvio'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/pregnancy-calculator')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Pregnancy Calculator', 'netvio'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/tdee-calculator')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('TDEE Calculator', 'netvio'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/bmr-calculator')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('BMR Calculator', 'netvio'); ?></a></li>
            </ul>
        </div>

        <div class="md:col-span-3">
            <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4"><?php esc_html_e('Stay in the loop', 'netvio'); ?></h4>
            <p class="text-sm text-slate-400 mb-4"><?php esc_html_e('One short email a month when we ship a new calculator or guide. No spam.', 'netvio'); ?></p>
            <form action="mailto:hello@netvio.tech" method="post" enctype="text/plain" class="flex flex-col sm:flex-row gap-2">
                <label for="footer-email" class="sr-only"><?php esc_html_e('Email address', 'netvio'); ?></label>
                <input id="footer-email" type="email" name="email" required
                    placeholder="<?php esc_attr_e('you@example.com', 'netvio'); ?>"
                    class="flex-1 px-3 py-2 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 outline-none text-sm" />
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white text-sm font-semibold transition-colors">
                    <?php esc_html_e('Subscribe', 'netvio'); ?>
                </button>
            </form>
        </div>
    </div>

    <div class="border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
            <div><?php printf(esc_html__('© %s Netvio.Tech — Free tools for clearer health decisions.', 'netvio'), esc_html(date('Y'))); ?></div>
            <div class="flex items-center gap-4">
                <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Privacy', 'netvio'); ?></a>
                <a href="<?php echo esc_url(home_url('/terms')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Terms', 'netvio'); ?></a>
                <a href="<?php echo esc_url(home_url('/disclaimer')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Medical disclaimer', 'netvio'); ?></a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>
