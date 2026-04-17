<?php

/**
 * Front Page: Blog + Tools (Tech & Medical)
 * Place in your theme root: /wp-content/themes/Netvio/front-page.php
 */

use WP_Query;

if (!defined('ABSPATH')) exit;

if (!class_exists('WP_Query')) {
  class WP_Query {
    public $found_posts = 0;
    public function have_posts() { return false; }
    public function the_post() {}
  }
}
get_header();

$calculator_category_slug = 'calculators';
$calculator_args = array(
  'post_type'      => 'page',
  'tax_query'      => array(
    array(
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => $calculator_category_slug,
    ),
  ),
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
  'posts_per_page' => 9,
);
$calculator_query = new \WP_Query($calculator_args);
$calculator_count = (int) $calculator_query->found_posts;

$post_counts = wp_count_posts();
$published_articles = isset($post_counts->publish) ? (int) $post_counts->publish : 0;

$latest_posts = new \WP_Query(array(
  'post_type'      => 'post',
  'posts_per_page' => 3,
  'ignore_sticky_posts' => true,
));

$faq_items = array(
  array(
    'question' => __('How accurate are the calculators?', 'netvio'),
    'answer'   => __('Each tool uses peer-reviewed medical or fitness formulas. We also add guardrails and friendly explanations so results are easy to interpret.', 'netvio'),
  ),
  array(
    'question' => __('Do you store my inputs?', 'netvio'),
    'answer'   => __('No data leaves your browser. Calculations run client-side, which keeps your private information safe.', 'netvio'),
  ),
  array(
    'question' => __('Can I request a new calculator?', 'netvio'),
    'answer'   => __('Absolutely. Scroll to the request form below or email us — community suggestions shape our roadmap.', 'netvio'),
  ),
  array(
    'question' => __('Do I need to sign up?', 'netvio'),
    'answer'   => __('No account, no email, no paywall. Open the tool, enter a number, get an answer.', 'netvio'),
  ),
);

$testimonial_cards = array(
  array(
    'name'  => 'John Carter',
    'role'  => __('Wellness Coach', 'netvio'),
    'quote' => __('“Netvio is my go-to resource when clients need fast clarity. The calculators are simple enough for beginners yet accurate enough for pros.”', 'netvio'),
    'avatar' => '/assets/images/john-carter.svg',
  ),
  array(
    'name'  => 'Peeter Pawl',
    'role'  => __('Running Club Lead', 'netvio'),
    'quote' => __('“Our athletes use the pace, BMI and macro tools daily. The on-page explanations make it easy to act on the data.”', 'netvio'),
    'avatar' => '/assets/images/peeter-pawl.svg',
  ),
);

// FAQ JSON-LD for rich results — boosts SERP CTR and cuts bounce from SEO traffic
$faq_schema = array(
  '@context'   => 'https://schema.org',
  '@type'      => 'FAQPage',
  'mainEntity' => array(),
);
foreach ($faq_items as $faq) {
  $faq_schema['mainEntity'][] = array(
    '@type'          => 'Question',
    'name'           => $faq['question'],
    'acceptedAnswer' => array(
      '@type' => 'Answer',
      'text'  => $faq['answer'],
    ),
  );
}
?>

<script type="application/ld+json"><?php echo wp_json_encode($faq_schema); ?></script>

<main id="primary">

  <!-- HERO — load-bearing first impression. Keep it scannable. -->
  <section class="relative overflow-hidden">
    <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-blue-50 via-white to-white"></div>
    <div aria-hidden="true" class="absolute -top-40 -right-40 w-96 h-96 bg-cyan-100 rounded-full blur-3xl opacity-60"></div>
    <div aria-hidden="true" class="absolute -top-20 -left-40 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-60"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-12 md:pt-20 md:pb-16 text-center">
      <div class="max-w-3xl mx-auto">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/80 border border-blue-100 text-blue-700 rounded-full text-sm font-semibold mb-6 shadow-sm">
          <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
          <span><?php echo esc_html($calculator_count); ?> <?php esc_html_e('free calculators, updated weekly', 'netvio'); ?></span>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.05] tracking-tight mb-5">
          <?php esc_html_e('Your health questions,', 'netvio'); ?>
          <span class="block bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent">
            <?php esc_html_e('answered in seconds.', 'netvio'); ?>
          </span>
        </h1>

        <p class="text-lg md:text-xl text-slate-600 mb-7 max-w-2xl mx-auto">
          <?php esc_html_e('Pregnancy, fitness, nutrition, everyday health — pick a calculator, type a number, get a clear answer. No signup. No ads. No data collection.', 'netvio'); ?>
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
          <a href="#calculators" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 hover:-translate-y-0.5">
            <?php esc_html_e('Try a Calculator', 'netvio'); ?>
            <?php echo netvio_icon('arrow-right', 'w-4 h-4'); ?>
          </a>
          <a href="#guides" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white text-slate-800 rounded-xl font-semibold border-2 border-slate-200 hover:border-blue-600 hover:text-blue-600 transition-all">
            <?php esc_html_e('Read a Guide', 'netvio'); ?>
          </a>
        </div>

        <!-- Trust row — reinforces value in the first second, no unverifiable numbers -->
        <ul class="mt-8 flex flex-wrap justify-center gap-x-6 gap-y-2 text-sm text-slate-600">
          <li class="inline-flex items-center gap-2"><?php echo netvio_icon('lock', 'w-4 h-4 text-blue-600'); ?><?php esc_html_e('Fully private', 'netvio'); ?></li>
          <li class="inline-flex items-center gap-2"><?php echo netvio_icon('zap', 'w-4 h-4 text-blue-600'); ?><?php esc_html_e('Instant results', 'netvio'); ?></li>
          <li class="inline-flex items-center gap-2"><?php echo netvio_icon('shield-check', 'w-4 h-4 text-blue-600'); ?><?php esc_html_e('Reviewed formulas', 'netvio'); ?></li>
          <li class="inline-flex items-center gap-2"><?php echo netvio_icon('sparkles', 'w-4 h-4 text-blue-600'); ?><?php esc_html_e('Free forever', 'netvio'); ?></li>
        </ul>
      </div>

      <div class="mt-12 grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-6 text-left max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6">
          <p class="text-3xl font-extrabold text-blue-600 mb-1"><?php echo esc_html($calculator_count); ?>+</p>
          <p class="text-slate-600 text-sm sm:text-base"><?php esc_html_e('calculators ready to help you understand your health better.', 'netvio'); ?></p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6">
          <p class="text-3xl font-extrabold text-blue-600 mb-1"><?php echo esc_html($published_articles); ?>+</p>
          <p class="text-slate-600 text-sm sm:text-base"><?php esc_html_e('guides written in plain English, not medical jargon.', 'netvio'); ?></p>
        </div>
        <div class="col-span-2 sm:col-span-1 bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6">
          <p class="text-3xl font-extrabold text-blue-600 mb-1">0</p>
          <p class="text-slate-600 text-sm sm:text-base"><?php esc_html_e('accounts, emails or cookies required. Ever.', 'netvio'); ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Calculators -->
  <section id="calculators" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="text-center mb-10">
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-500 mb-2"><?php esc_html_e('Calculators', 'netvio'); ?></p>
      <h2 class="text-3xl md:text-4xl font-bold mb-3"><?php esc_html_e('Pick your tool', 'netvio'); ?></h2>
      <p class="text-slate-600 max-w-2xl mx-auto"><?php esc_html_e('Everything is ready to use right now. Click a card and start calculating — no setup.', 'netvio'); ?></p>
    </div>

    <?php if ($calculator_query->have_posts()): ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        <?php while ($calculator_query->have_posts()): $calculator_query->the_post(); ?>
          <a href="<?php the_permalink(); ?>" class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 relative hover:-translate-y-1" aria-label="<?php echo esc_attr(get_the_title()); ?>">
            <div class="absolute top-4 right-4">
              <span class="inline-flex items-center gap-2 px-2 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full">
                <span class="w-1.5 h-1.5 bg-green-600 rounded-full"></span>
                <?php esc_html_e('Live', 'netvio'); ?>
              </span>
            </div>

            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform text-white">
              <?php echo netvio_icon('calculator', 'w-7 h-7'); ?>
            </div>

            <?php
            $tags = get_the_terms(get_the_ID(), 'post_tag');
            if ($tags && !is_wp_error($tags)) :
              $first_tag = $tags[0];
            ?>
              <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1 block">
                <?php echo esc_html($first_tag->name); ?>
              </span>
            <?php endif; ?>

            <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 transition-colors"><?php the_title(); ?></h3>
            <p class="text-slate-600 text-sm leading-relaxed"><?php echo esc_html(wp_trim_words(get_the_content(), 20, '…')); ?></p>

            <div class="mt-4 inline-flex items-center text-blue-600 font-semibold">
              <span><?php esc_html_e('Get started', 'netvio'); ?></span>
              <span class="ml-2 transition-transform group-hover:translate-x-1"><?php echo netvio_icon('arrow-right', 'w-4 h-4'); ?></span>
            </div>
          </a>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="text-slate-600 text-center mb-12"><?php esc_html_e('We are working on adding more calculators — check back soon.', 'netvio'); ?></p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <!-- Coming soon panel -->
    <div class="bg-gradient-to-br from-slate-50 to-blue-50 rounded-2xl p-8 border border-slate-200">
      <div class="text-center max-w-2xl mx-auto">
        <h3 class="text-2xl font-bold text-slate-900 mb-3"><?php esc_html_e('What’s coming next?', 'netvio'); ?></h3>
        <p class="text-slate-600 mb-6"><?php esc_html_e('We’re building more tools you’ll love — macro, TDEE, BMR, and body-fat variants. Got a request? We’ll bump it up the list.', 'netvio'); ?></p>
        <div class="flex flex-wrap gap-2 justify-center text-sm">
          <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200"><?php esc_html_e('Macro Calculator', 'netvio'); ?></span>
          <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200"><?php esc_html_e('TDEE Calculator', 'netvio'); ?></span>
          <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200"><?php esc_html_e('Body Fat Calculator', 'netvio'); ?></span>
          <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200"><?php esc_html_e('Calorie Deficit', 'netvio'); ?></span>
          <span class="px-3 py-1 bg-white text-slate-600 rounded-full border border-slate-200"><?php esc_html_e('BMR Calculator', 'netvio'); ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- Highlights -->
  <section class="bg-gradient-to-br from-blue-50 to-cyan-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center p-6">
          <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white">
            <?php echo netvio_icon('shield-check', 'w-8 h-8'); ?>
          </div>
          <h4 class="text-xl font-bold mb-2"><?php esc_html_e('We get it right', 'netvio'); ?></h4>
          <p class="text-slate-600"><?php esc_html_e('Every calculator uses trusted formulas and medical standards — you can count on accurate results.', 'netvio'); ?></p>
        </div>

        <div class="text-center p-6">
          <div class="w-16 h-16 bg-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white">
            <?php echo netvio_icon('lock', 'w-8 h-8'); ?>
          </div>
          <h4 class="text-xl font-bold mb-2"><?php esc_html_e('Your privacy matters', 'netvio'); ?></h4>
          <p class="text-slate-600"><?php esc_html_e('Nothing you enter leaves your device. Calculations run in your browser — we never see your data.', 'netvio'); ?></p>
        </div>

        <div class="text-center p-6">
          <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white">
            <?php echo netvio_icon('target', 'w-8 h-8'); ?>
          </div>
          <h4 class="text-xl font-bold mb-2"><?php esc_html_e('Always free', 'netvio'); ?></h4>
          <p class="text-slate-600"><?php esc_html_e('No credit card, no signup, no catch — just free tools whenever you need them.', 'netvio'); ?></p>
        </div>
      </div>
    </div>
  </section>

  <?php if (!empty($testimonial_cards)): ?>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-500"><?php esc_html_e('What people say', 'netvio'); ?></p>
          <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-2"><?php esc_html_e('Real people using our tools every day.', 'netvio'); ?></h2>
        </div>
        <a href="#contact" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
          <span><?php esc_html_e('Tell us your story', 'netvio'); ?></span>
          <?php echo netvio_icon('arrow-up-right', 'w-5 h-5'); ?>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($testimonial_cards as $testimonial): ?>
          <article class="bg-white border border-slate-100 rounded-2xl shadow-sm p-8 flex flex-col gap-6">
            <div>
              <p class="text-lg text-slate-700 leading-relaxed"><?php echo esc_html($testimonial['quote']); ?></p>
            </div>
            <div class="flex items-center gap-4">
              <img src="<?php echo esc_url(get_template_directory_uri() . $testimonial['avatar']); ?>"
                alt="<?php echo esc_attr($testimonial['name']); ?>"
                width="48" height="48" loading="lazy" decoding="async"
                class="w-12 h-12 rounded-full object-cover bg-slate-100">
              <div>
                <p class="font-semibold text-slate-900"><?php echo esc_html($testimonial['name']); ?></p>
                <p class="text-sm text-slate-500"><?php echo esc_html($testimonial['role']); ?></p>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($latest_posts->have_posts()): ?>
    <section id="guides" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-500"><?php esc_html_e('Latest guides', 'netvio'); ?></p>
          <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-2"><?php esc_html_e('Actionable advice to pair with every calculation.', 'netvio'); ?></h2>
          <p class="text-slate-600 mt-3 max-w-2xl"><?php esc_html_e('Fresh articles, meal plans, and training tips help you understand the “why” behind the numbers.', 'netvio'); ?></p>
        </div>
        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog')); ?>" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
          <span><?php esc_html_e('View all articles', 'netvio'); ?></span>
          <?php echo netvio_icon('arrow-right', 'w-5 h-5'); ?>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php while ($latest_posts->have_posts()): $latest_posts->the_post(); ?>
          <?php $reading_time = max(1, ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 200)); ?>
          <article class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full hover:shadow-lg transition-shadow">
            <?php if (has_post_thumbnail()): ?>
              <a href="<?php the_permalink(); ?>" class="block">
                <?php the_post_thumbnail('medium_large', array(
                  'class'    => 'w-full h-48 object-cover',
                  'loading'  => 'lazy',
                  'decoding' => 'async',
                )); ?>
              </a>
            <?php endif; ?>
            <div class="p-6 flex flex-col flex-grow">
              <div class="flex items-center gap-3 text-xs font-semibold uppercase tracking-wide text-slate-500 mb-3">
                <span><?php echo esc_html(get_the_date()); ?></span>
                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                <span><?php echo esc_html($reading_time . ' ' . __('min read', 'netvio')); ?></span>
              </div>
              <h3 class="text-xl font-bold text-slate-900 mb-3">
                <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors"><?php the_title(); ?></a>
              </h3>
              <p class="text-slate-600 flex-grow"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22, '…')); ?></p>
              <div class="mt-5">
                <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-blue-600 font-semibold">
                  <span><?php esc_html_e('Keep reading', 'netvio'); ?></span>
                  <?php echo netvio_icon('arrow-up-right', 'w-4 h-4'); ?>
                </a>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>

  <?php if (!empty($faq_items)): ?>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-500 mb-3"><?php esc_html_e('FAQ', 'netvio'); ?></p>
          <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4"><?php esc_html_e('Answers before you even ask.', 'netvio'); ?></h2>
          <p class="text-slate-600 mb-6"><?php esc_html_e('We obsess over clarity. Still have a question? Hit the contact button and we’ll reply quickly.', 'netvio'); ?></p>
          <a href="#contact" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
            <span><?php esc_html_e('Contact the team', 'netvio'); ?></span>
            <?php echo netvio_icon('arrow-right', 'w-5 h-5'); ?>
          </a>
        </div>
        <div class="space-y-4">
          <?php foreach ($faq_items as $index => $faq): ?>
            <details class="group border border-slate-200 rounded-2xl px-5 py-4 bg-white" <?php echo 0 === $index ? 'open' : ''; ?>>
              <summary class="flex items-center justify-between cursor-pointer text-lg font-semibold text-slate-900 list-none">
                <?php echo esc_html($faq['question']); ?>
                <span class="ml-4 w-6 h-6 rounded-full border border-slate-300 flex items-center justify-center text-slate-500 group-open:rotate-45 transition-transform">+</span>
              </summary>
              <p class="text-slate-600 mt-3 leading-relaxed"><?php echo esc_html($faq['answer']); ?></p>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- CTA -->
  <section id="contact" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl p-8 md:p-12 text-center text-white shadow-xl">
      <div aria-hidden="true" class="absolute -top-16 -right-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
      <div aria-hidden="true" class="absolute -bottom-16 -left-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
      <div class="relative">
        <h3 class="text-3xl md:text-4xl font-bold mb-4"><?php esc_html_e('Need a specific calculator?', 'netvio'); ?></h3>
        <p class="text-lg md:text-xl text-blue-50 mb-8 max-w-2xl mx-auto"><?php esc_html_e('Have an idea that would help you or your users? Request it and we’ll prioritize building it.', 'netvio'); ?></p>
        <a href="mailto:hello@netvio.tech?subject=Calculator%20request" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-blue-600 rounded-xl font-semibold hover:bg-blue-50 transition-all shadow-lg">
          <?php echo netvio_icon('mail', 'w-4 h-4'); ?>
          <?php esc_html_e('Request a Calculator', 'netvio'); ?>
        </a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
