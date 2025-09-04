<?php

/**
 * Front Page: Blog + Tools (Tech & Medical)
 * Place in your theme root: /wp-content/themes/Netvio/front-page.php
 */
if (!defined('ABSPATH')) exit;
get_header();
?>

<main id="primary" class="max-w-6xl mx-auto px-4 py-10">

  <!-- Hero -->
  <section class="text-center py-10">
    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
      Free Online Health & Fitness Calculators – <span class="text-indigo-600">BMI, BMR, TDEE & More</span>
    </h1>

    <p class="mt-3 text-gray-600 max-w-2xl mx-auto">
      Track your health, fitness, and daily calorie needs with our free, accurate, and mobile-friendly tools.
    </p>

    <!-- Secondary heading for SEO -->
    <h2 class="mt-6 text-xl sm:text-2xl font-semibold text-gray-800">
      <ul class="mt-4 space-y-1 text-left inline-block text-gray-600">
        <li>✔️ 100% Free & Accurate Calculators</li>
        <li>✔️ Easy-to-Use, Mobile-Friendly Tools</li>
        <li>✔️ Backed by Science (BMI, BMR, TDEE, Body Fat)</li>
        <li>✔️ Practical Fitness & Health Guides</li>
      </ul>
    </h2>
  </section>

  <!-- Tools Tabs -->
  <section id="tools" class="bg-white shadow rounded-2xl p-6 mt-8">

    <!-- Health Tools Grid -->
    <div id="panel-health" role="tabpanel" class="pt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
      <?php
      // Edit these links/titles to your actual tool URLs
      $health_tools = [
        [
          'title' => 'BMI Calculator',
          'desc'  => 'Check your Body Mass Index and healthy weight range.',
          'url'   => site_url('/health-calculators/#bmi'),
        ],
        [
          'title' => 'BMR Calculator',
          'desc'  => 'Find your basal metabolic rate (Mifflin–St Jeor).',
          'url'   => site_url('/health-calculators/#bmr'),
        ],
        [
          'title' => 'TDEE (Calorie Needs)',
          'desc'  => 'Daily energy needs by activity level.',
          'url'   => site_url('/health-calculators/#calories'),
        ],
        [
          'title' => 'Body Fat % (US Navy)',
          'desc'  => 'Estimate your body fat and category.',
          'url'   => site_url('/health-calculators/#bodyfat'),
        ],
      ];
      foreach ($health_tools as $t): ?>
        <a href="<?php echo esc_url($t['url']); ?>" class="block rounded-xl bg-gray-100 p-5 hover:shadow">
          <h3 class="text-lg font-semibold"><?php echo esc_html($t['title']); ?></h3>
          <p class="text-sm text-gray-600 mt-1"><?php echo esc_html($t['desc']); ?></p>
          <div class="mt-3 text-indigo-600 text-sm font-medium">Open →</div>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Featured CTA -->
  <section class="mt-8 rounded-2xl bg-gradient-to-r from-indigo-600 to-emerald-600 text-white p-8">
    <div class="grid md:grid-cols-2 gap-6 items-center">
      <div>
        <h2 class="text-2xl font-bold">Health Calculators Hub</h2>
        <p class="mt-2 text-white/90">BMI, BMR, TDEE & Body Fat — free, fast, and privacy-friendly.</p>
      </div>
      <div class="md:text-right">
        <a href="<?php echo esc_url(site_url('/health-calculators/')); ?>"
          class="inline-block bg-white text-black rounded-xl px-5 py-3 font-semibold">Open Hub</a>
      </div>
    </div>
  </section>

  <!-- Latest Blog Posts -->
  <section class="mt-10">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-2xl font-semibold">Latest Articles</h2>
      <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: site_url('/blog/')); ?>"
        class="text-sm text-indigo-600">View all →</a>
    </div>

    <?php
    $q = new WP_Query([
      'post_type'      => 'post',
      'posts_per_page' => 6,
      'ignore_sticky_posts' => true,
    ]);
    if ($q->have_posts()): ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while ($q->have_posts()): $q->the_post(); ?>
          <article class="rounded-xl bg-gray-100 hover:shadow transition">
            <a href="<?php the_permalink(); ?>" class="block p-5">
              <h3 class="text-lg font-semibold line-clamp-2"><?php the_title(); ?></h3>
              <p class="text-sm text-gray-600 mt-2 line-clamp-3"><?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 24)); ?></p>
              <div class="mt-3 text-xs text-gray-500"><?php echo get_the_date(); ?> · <?php echo get_the_author(); ?></div>
            </a>
          </article>
        <?php endwhile;
        wp_reset_postdata(); ?>
      </div>
    <?php else: ?>
      <p class="text-gray-600">No posts yet. Publish your first article to see it here.</p>
    <?php endif; ?>
  </section>

  <!-- Category quick links (optional) -->
  <!-- <section class="mt-10">
    <h2 class="text-xl font-semibold mb-3">Browse by Topic</h2>
    <div class="flex flex-wrap gap-2">
      <?php
      $cats = get_categories(['number' => 10, 'orderby' => 'count', 'order' => 'DESC']);
      foreach ($cats as $c): ?>
        <a href="<?php echo esc_url(get_category_link($c)); ?>"
           class="inline-block px-3 py-1 rounded-full border text-sm hover:bg-gray-50">
          <?php echo esc_html($c->name); ?>
        </a>
      <?php endforeach; ?>
    </div>
  </section> -->

</main>

<!-- Simple tabs JS (no dependency) -->
<script>
  (function() {
    const container = document.getElementById('tools');
    if (!container) return;
    const tabs = container.querySelectorAll('.tab-btn');
    const panels = [document.getElementById('panel-health'), document.getElementById('panel-tech')];

    function activate(idx) {
      tabs.forEach((t, i) => {
        const sel = i === idx;
        t.setAttribute('aria-selected', sel ? 'true' : 'false');
        t.classList.toggle('border-black', sel);
        t.classList.toggle('text-gray-600', !sel);
        t.classList.toggle('font-semibold', sel);
        panels[i].hidden = !sel;
      });
    }

    tabs[0]?.addEventListener('click', () => activate(0));
    tabs[1]?.addEventListener('click', () => activate(1));
  })();
</script>

<?php
// Minimal JSON-LD to help Google understand the site purpose
$items = array_map(function ($t) {
  return ['@type' => 'SiteNavigationElement', 'name' => $t['title'], 'url' => $t['url']];
}, array_merge($health_tools));
$schema = [
  '@context' => 'https://schema.org',
  '@type'    => 'WebSite',
  'name'     => get_bloginfo('name'),
  'url'      => home_url('/'),
  'potentialAction' => [
    '@type' => 'SearchAction',
    'target' => home_url('/?s={search_term_string}'),
    'query-input' => 'required name=search_term_string'
  ],
  'hasPart'  => [
    [
      '@type' => 'ItemList',
      'name'  => 'Tools',
      'itemListElement' => array_map(function ($i, $k) {
        return [
          '@type' => 'ListItem',
          'position' => $k + 1,
          'item' => $i
        ];
      }, $items, array_keys($items))
    ]
  ]
];
?>
<script type="application/ld+json">
  <?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<?php get_footer(); ?>