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
            <header class="mb-6">
                <div class="flex items-center gap-2 mb-3">
                    <?php
                    $cats = get_the_category();
                    if ($cats) :
                        foreach (array_slice($cats, 0, 2) as $c):
                    ?>
                            <a href="<?php echo esc_url(get_category_link($c)); ?>" class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium">
                                <?php echo esc_html($c->name); ?>
                            </a>
                    <?php endforeach;
                    endif; ?>
                </div>

                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight"><?php the_title(); ?></h1>

                <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <?php echo get_avatar(get_the_author_meta('ID'), 28, '', '', ['class' => 'rounded-full']); ?>
                        <span><?php echo esc_html(get_the_author()); ?></span>
                    </div>
                    <span>•</span>
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo get_the_date(); ?></time>
                    <span>•</span>
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
                <article class="entry-content nv-prose">
                    <?php the_content(); ?>

                    <!-- Tags -->
                    <?php the_tags(
                        '<div class="mt-8 flex flex-wrap gap-2 text-sm"><span class="text-gray-500 mr-1">Tags:</span>',
                        '',
                        '</div>'
                    ); ?>
                </article>

                <aside class="hidden lg:block">
                    <div class="sticky top-20">
                        <div class="rounded-2xl border p-4">
                            <h2 class="text-sm font-semibold uppercase tracking-wide text-gray-700">On this page</h2>
                            <nav id="nv-toc" class="mt-3 text-sm space-y-2 text-gray-700">
                                <!-- JS injects TOC links here -->
                            </nav>
                        </div>

                        <!-- Share -->
                        <div class="rounded-2xl border p-4 mt-6">
                            <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-700">Share</h3>
                            <div class="mt-3 flex gap-2">
                                <?php
                                $url = urlencode(get_permalink());
                                $title = urlencode(get_the_title());
                                ?>
                                <a class="px-3 py-2 rounded-lg border hover:bg-gray-50" target="_blank" rel="noreferrer"
                                    href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>">X</a>
                                <a class="px-3 py-2 rounded-lg border hover:bg-gray-50" target="_blank" rel="noreferrer"
                                    href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>">Facebook</a>
                                <a class="px-3 py-2 rounded-lg border hover:bg-gray-50" target="_blank" rel="noreferrer"
                                    href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>">LinkedIn</a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <!-- Author box -->
            <section class="mt-10 rounded-2xl border p-6 flex items-center gap-4">
                <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['class' => 'rounded-full']); ?>
                <div>
                    <div class="font-semibold"><?php echo esc_html(get_the_author()); ?></div>
                    <?php if ($bio = get_the_author_meta('description')): ?>
                        <p class="text-sm text-gray-600 mt-1"><?php echo esc_html($bio); ?></p>
                    <?php else: ?>
                        <p class="text-sm text-gray-600 mt-1">Writing about practical tools for health and tech.</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Prev / Next -->
            <nav class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="rounded-2xl border p-4">
                    <?php previous_post_link('%link', '← Previous: %title'); ?>
                </div>
                <div class="rounded-2xl border p-4 md:text-right">
                    <?php next_post_link('%link', 'Next: %title →'); ?>
                </div>
            </nav>

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
                            <article class="rounded-2xl border hover:shadow transition">
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

            <!-- Comments -->
            <section class="mt-10 rounded-2xl border p-6">
                <?php comments_template(); ?>
            </section>

    <?php endwhile;
    endif; ?>

</main>

<!-- TOC + code copy JS -->
<script>
    (function() {
        // Build TOC from h2/h3
        const article = document.querySelector('.entry-content');
        const toc = document.getElementById('nv-toc');
        if (article && toc) {
            const headers = article.querySelectorAll('h2, h3');
            let idx = 0;
            headers.forEach(h => {
                if (!h.id) {
                    h.id = 'h-' + (++idx);
                }
                const a = document.createElement('a');
                a.href = '#' + h.id;
                a.textContent = h.textContent;
                a.className = (h.tagName === 'H2') ? 'block hover:underline' : 'block pl-4 text-gray-600 hover:underline';
                toc.appendChild(a);
            });
            if (!toc.children.length) {
                toc.innerHTML = '<span class="text-gray-500">No sections</span>';
            }
        }

        // Add copy buttons to code blocks
        document.querySelectorAll('pre code').forEach(code => {
            const pre = code.closest('pre');
            pre.classList.add('relative');
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = 'Copy';
            btn.className = 'absolute top-2 right-2 text-xs bg-black text-white px-2 py-1 rounded';
            btn.addEventListener('click', async () => {
                try {
                    await navigator.clipboard.writeText(code.innerText);
                    btn.textContent = 'Copied';
                    setTimeout(() => btn.textContent = 'Copy', 1500);
                } catch (e) {}
            });
            pre.appendChild(btn);
        });
    })();
</script>

<?php get_footer(); ?>