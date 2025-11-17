<?php

/**
 * Front Page: Blog + Tools (Tech & Medical)
 * Place in your theme root: /wp-content/themes/Netvio/front-page.php
 */
if (!defined('ABSPATH')) exit;
get_header();
?>

<main id="primary" class="max-w-6xl mx-auto px-4 py-10">

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 text-center">
    <div class="max-w-3xl mx-auto">
      <div class="inline-flex items-center gap-3 px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-semibold mb-6">
        <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
        <span>14 Calculators Available</span>
      </div>

      <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
        Free Health & Fitness
        <span class="block bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent">Calculators</span>
      </h1>

      <p class="text-lg md:text-xl text-slate-600 mb-8">
        Instant, accurate tools for pregnancy, fitness and wellness — due dates, BMI, pace, body fat and more. No signup required.
      </p>

      <div class="flex flex-wrap gap-4 justify-center">
        <a href="#calculators" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all shadow-sm">Explore Calculators</a>
        <a href="/blog" class="px-8 py-3 bg-white text-slate-700 rounded-lg font-semibold border-2 border-slate-200 hover:border-blue-600 hover:text-blue-600 transition-all">Read Health Guides</a>
      </div>
    </div>
  </section>

  <!-- Calculators -->
  <section id="calculators" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-10">
      <h2 class="text-3xl md:text-4xl font-bold mb-3">Featured Calculators</h2>
      <p class="text-slate-600 max-w-2xl mx-auto">All calculators are live and ready — click any card to go to the tool.</p>
      <!-- 
      <div class="flex flex-wrap gap-3 justify-center mt-6">
        <button class="px-4 py-2 bg-white text-slate-700 rounded-lg font-medium border border-slate-200 hover:border-blue-600 hover:text-blue-600 transition-all">All</button>
        <button class="px-4 py-2 bg-white text-slate-700 rounded-lg font-medium border border-slate-200 hover:border-blue-600 hover:text-blue-600 transition-all">Pregnancy</button>
        <button class="px-4 py-2 bg-white text-slate-700 rounded-lg font-medium border border-slate-200 hover:border-blue-600 hover:text-blue-600 transition-all">Fitness</button>
      </div> -->
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">

      <?php
      $category_slug = 'calculators'; // Replace with your category slug

      $args = array(
        'post_type' => 'page',
        'tax_query' => array(
          array(
            'taxonomy' => 'category', // Or 'page_category' if using custom taxonomy
            'field'    => 'slug',
            'terms'    => $category_slug,
          ),
        ),
        'orderby' => 'menu_order',
        'order' => 'ASC'
      );
      $q = new WP_Query($args);

      if ($q->have_posts()): ?>
        <?php while ($q->have_posts()): $q->the_post(); ?>
          <!-- Card: Pregnancy Calculator -->
          <a href="<?php the_permalink(); ?>" class="group bg-white rounded-xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 relative hover:-translate-y-1" aria-label="Pregnancy Calculator">
            <div class="absolute top-4 right-4">
              <span class="inline-flex items-center gap-2 px-2 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full">
                <span class="w-1.5 h-1.5 bg-green-600 rounded-full"></span>
                Live
              </span>
            </div>

            <div class="w-14 h-14 rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <i data-lucide="baby" class="w-7 h-7 text-white"></i>
            </div>

            <?php
            $tags = get_the_terms(get_the_ID(), 'post_tag'); // Or 'page_tag' if using custom taxonomy
            if ($tags && !is_wp_error($tags)) :
              $first_tag = $tags[0]; // Get the first tag
            ?>
              <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1 block">
                <?php echo esc_html($first_tag->name); ?>
              </span>
            <?php endif; ?>

            <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 transition-colors"> <?php the_title(); ?></h3>
            <p class="text-slate-600"><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>

            <div class="mt-4 flex items-center text-blue-600 font-semibold">
              <span>Calculate Now</span>
              <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
            </div>
          </a>

        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>
  <?php else: ?>
    <p class="text-gray-600">No posts yet. Publish your first article to see it here.</p>
  <?php endif; ?>

  </div>

  <!-- Coming soon panel -->
  <div class="bg-gradient-to-br from-slate-50 to-blue-50 rounded-2xl p-8 border border-slate-200">
    <div class="text-center max-w-2xl mx-auto">
      <h3 class="text-2xl font-bold text-slate-900 mb-3">More Calculators Coming Soon</h3>
      <p class="text-slate-600 mb-6">We're working on macro calculators, TDEE, BMR, body fat variants and more — request a tool if you want it prioritized.</p>
      <div class="flex flex-wrap gap-2 justify-center text-sm">
        <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200">Macro Calculator</span>
        <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200">TDEE Calculator</span>
        <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200">Body Fat Calculator</span>
        <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200">Calorie Deficit</span>
        <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200">BMR Calculator</span>
      </div>
    </div>
  </div>
  </section>

  <!-- Highlights -->
  <section class="bg-gradient-to-br from-blue-50 to-cyan-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center p-6">
          <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="calculator" class="w-8 h-8 text-white"></i>
          </div>
          <h4 class="text-xl font-bold mb-2">Accurate Results</h4>
          <p class="text-slate-600">All calculators use verified formulas and medical standards to ensure precision.</p>
        </div>

        <div class="text-center p-6">
          <div class="w-16 h-16 bg-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="heart" class="w-8 h-8 text-white"></i>
          </div>
          <h4 class="text-xl font-bold mb-2">Privacy First</h4>
          <p class="text-slate-600">Your data stays private. Calculations happen in your browser.</p>
        </div>

        <div class="text-center p-6">
          <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="target" class="w-8 h-8 text-white"></i>
          </div>
          <h4 class="text-xl font-bold mb-2">100% Free</h4>
          <p class="text-slate-600">Access all calculators at no cost — no registration required.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl p-8 md:p-12 text-center text-white">
      <h3 class="text-3xl md:text-4xl font-bold mb-4">Need a Specific Calculator?</h3>
      <p class="text-lg md:text-xl text-blue-50 mb-8 max-w-2xl mx-auto">Have an idea that would help you or your users? Request it and we'll prioritize building it.</p>
      <a href="#contact" class="inline-block px-8 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-all">Request a Calculator</a>
    </div>
  </section>
</main>

</main>

<?php get_footer(); ?>