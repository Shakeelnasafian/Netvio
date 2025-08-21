<?php

/**
 * Single Post Template — Clean Blog Style
 */
if (!defined('ABSPATH')) exit;
get_header();

// helpers
function nv_time_to_read($post_id)
{
    $w = str_word_count(wp_strip_all_tags(get_post_field('post_content', $post_id)));
    $m = max(1, ceil($w / 220)); // ~220 wpm
    return $m . ' min read';
}
?>

<main id="primary" class="max-w-4xl mx-auto px-4 py-10">

    <!-- Breadcrumbs (simple) -->
    <nav aria-label="Breadcrumb" class="text-sm text-gray-500 mb-4">
        <ol class="flex items-center gap-2 flex-wrap">
            <li><a class="hover:underline" href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
            <li>›</li>
            <li><a class="hover:underline" href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: site_url('/blog/')); ?>">Blog</a></li>
            <li>›</li>
            <li class="text-gray-700"><?php the_title(); ?></li>
        </ol>
    </nav>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <!-- Header -->
            <header class="mb-8 border-b border-gray-200 pb-6">
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight text-gray-900">
                    <?php the_title(); ?>
                </h1>

                <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', ['class' => 'rounded-full']); ?>
                        <span class="font-medium"><?php echo esc_html(get_the_author()); ?></span>
                    </div>
                    <span class="hidden sm:inline">•</span>
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="italic">
                        <?php echo get_the_date(); ?>
                    </time>
                    <span class="hidden sm:inline">•</span>
                    <span><?php echo nv_time_to_read(get_the_ID()); ?></span>
                </div>
            </header>


            <!-- Featured image -->
            <?php if (has_post_thumbnail()) : ?>
                <figure class="mb-8 overflow-hidden rounded-2xl border">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-auto']); ?>
                </figure>
            <?php endif; ?>

            <!-- Content + Sticky TOC -->
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_280px] gap-8">
                <article class="prose lg:prose-lg max-w-none">
                    <?php the_content(); ?>
                </article>
            </div>

            <!-- Related posts -->
            <?php
            $rel = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => [get_the_ID()],
                'category__in' => wp_get_post_categories(get_the_ID()),
                'ignore_sticky_posts' => true
            ]);
            if ($rel->have_posts()): ?>
                <section class="mt-10">
                    <h2 class="text-2xl font-semibold mb-4">Related Articles</h2>
                    <div class="grid sm:grid-cols-3 gap-6">
                        <?php while ($rel->have_posts()): $rel->the_post(); ?>
                            <article class="rounded-2xl bg-gray-100 hover:shadow transition">
                                <a href="<?php the_permalink(); ?>" class="block p-4">
                                    <h3 class="font-semibold line-clamp-2"><?php the_title(); ?></h3>
                                    <p class="text-sm text-gray-600 mt-1 line-clamp-3"><?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                                    <div class="text-xs text-gray-500 mt-2"><?php echo get_the_date(); ?></div>
                                </a>
                            </article>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </section>
            <?php endif; ?>

    <?php endwhile;
    endif; ?>

</main>

<?php get_footer(); ?>