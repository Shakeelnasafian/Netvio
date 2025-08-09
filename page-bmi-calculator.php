<?php
/**
 * Template Name: Health Calculators (Tabs)
 */
if (!defined('ABSPATH')) exit; get_header();
?>
<main class="max-w-4xl mx-auto px-4 py-16">
  <article <?php post_class('mx-auto'); ?>>

    <header class="my-8">
      <h1 class="entry-title text-3xl font-bold"><?php the_title(); ?></h1>
      <p class="text-sm text-gray-500">Free, private, no data stored.</p>
    </header>

    <div class="my-4"><?php /* AdSense top */ ?></div>

    <div class="entry-content mb-8">
      <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
    </div>

    <!-- Tabs -->
    <div
      id="calc-tabs"
      class="bg-white shadow rounded-2xl"
      x-data
    >
      <!-- Tablist -->
      <div role="tablist" aria-label="Calculator Tabs" class="border-b flex overflow-x-auto">
        <?php
          $tabs = [
            ['id'=>'tab-bmi',      'label'=>'BMI',             'panel'=>'panel-bmi'],
            ['id'=>'tab-bmr',      'label'=>'BMR',             'panel'=>'panel-bmr'],
            ['id'=>'tab-calories', 'label'=>'Calorie Needs',   'panel'=>'panel-calories'],
            ['id'=>'tab-bodyfat',  'label'=>'Body Fat %',      'panel'=>'panel-bodyfat'],
          ];
          $first = true;
          foreach ($tabs as $t):
        ?>
          <button
            id="<?php echo esc_attr($t['id']); ?>"
            role="tab"
            aria-selected="<?php echo $first ? 'true':'false'; ?>"
            aria-controls="<?php echo esc_attr($t['panel']); ?>"
            tabindex="<?php echo $first ? '0':'-1'; ?>"
            class="px-4 py-3 text-sm font-medium border-b-2 <?php echo $first ? 'border-black' : 'border-transparent text-gray-600'; ?> hover:text-black focus:outline-none focus-visible:ring"
          >
            <?php echo esc_html($t['label']); ?>
          </button>
        <?php $first=false; endforeach; ?>
      </div>

      <!-- Panels -->
      <div class="p-6">
        <!-- BMI -->
        <section id="panel-bmi" role="tabpanel" aria-labelledby="tab-bmi">
          <section data-calculator-root class="my-2">
            <form class="space-y-4" data-calc-type="bmi" novalidate>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="block">
                  <span class="block text-sm font-medium mb-1">Height (cm)</span>
                  <input name="height" type="number" min="0" step="0.1" class="w-full rounded-xl border px-3 py-2" placeholder="e.g., 175">
                </label>
                <label class="block">
                  <span class="block text-sm font-medium mb-1">Weight (kg)</span>
                  <input name="weight" type="number" min="0" step="0.1" class="w-full rounded-xl border px-3 py-2" placeholder="e.g., 72">
                </label>
              </div>
              <div class="flex items-center justify-between">
                <button type="button" class="calc-submit rounded-xl px-4 py-2 bg-black text-white">Calculate</button>
                <button type="reset" class="rounded-xl px-3 py-2 border">Reset</button>
              </div>
            </form>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4" aria-live="polite">
              <div class="p-4 bg-gray-50 rounded-xl">
                <div class="text-sm text-gray-500">BMI</div>
                <div class="calc-out text-xl font-semibold">—</div>
              </div>
              <div class="p-4 bg-gray-50 rounded-xl">
                <div class="text-sm text-gray-500">Category</div>
                <div class="calc-out text-xl font-semibold">—</div>
              </div>
              <div class="p-4 bg-gray-50 rounded-xl">
                <div class="text-sm text-gray-500">Healthy Range</div>
                <div class="calc-out text-xl font-semibold">—</div>
              </div>
            </div>

            <details class="mt-4">
              <summary class="cursor-pointer text-sm text-gray-600">How it works</summary>
              <p class="text-sm text-gray-600 mt-2">BMI = weight (kg) / (height (m))². &lt;18.5 underweight, 18.5–24.9 normal, 25–29.9 overweight, ≥30 obese.</p>
            </details>
          </section>
        </section>

        <!-- BMR -->
        <section id="panel-bmr" role="tabpanel" aria-labelledby="tab-bmr" hidden>
          <?php get_template_part('template-parts/calculators/bmr'); ?>
        </section>

        <!-- Calories -->
        <section id="panel-calories" role="tabpanel" aria-labelledby="tab-calories" hidden>
          <?php get_template_part('template-parts/calculators/calories'); ?>
        </section>

        <!-- Body Fat -->
        <section id="panel-bodyfat" role="tabpanel" aria-labelledby="tab-bodyfat" hidden>
          <?php get_template_part('template-parts/calculators/bodyfat'); ?>
        </section>
      </div>
    </div>

    <div class="my-6"><?php /* AdSense in-content */ ?></div>

    <?php if ($faq = get_post_meta(get_the_ID(), '_calc_faq_html', true)) : ?>
      <section class="mt-10">
        <h2 class="text-2xl font-semibold">FAQs</h2>
        <div class="mt-4"><?php echo wp_kses_post($faq); ?></div>
      </section>
    <?php endif; ?>

  </article>
</main>
<?php get_footer(); ?>
