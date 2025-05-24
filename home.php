<?php get_header(); ?>

<style>
    .blog-container {
        max-width: 1200px;
        margin: auto;
        padding: 40px 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .blog-title {
        font-size: 3rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 40px;
        color: #1a202c;
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    .blog-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .blog-thumb {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .blog-content {
        padding: 20px;
    }

    .blog-post-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin: 0 0 12px;
        color: #2d3748;
    }

    .blog-excerpt {
        color: #4a5568;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 12px;
    }

    .blog-date {
        font-size: 0.85rem;
        color: #a0aec0;
    }

    .nv-pagination {
        text-align: center;
        margin-top: 40px;
    }

    .nv-pagination .page-numbers {
        display: inline-block;
        padding: 10px 15px;
        margin: 0 5px;
        background: #edf2f7;
        color: #2d3748;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }

    .nv-pagination .current,
    .nv-pagination .page-numbers:hover {
        background: #2d3748;
        color: white;
    }
</style>

<div class="blog-container">
    <h1 class="blog-title"><?php single_post_title(); ?></h1>
    <div class="blog-grid">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = [
            'post_type' => 'post',
            'posts_per_page' => 6,
            'paged' => $paged,
        ];
        $blog_query = new WP_Query($args);
        if ($blog_query->have_posts()):
            while ($blog_query->have_posts()): $blog_query->the_post();
                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: null;
        ?>
                <article class="blog-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ($thumbnail): ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" class="blog-thumb" loading="lazy" />
                        <?php else: ?>
                            <div class="blog-thumb blog-thumb-svg">
                                <!-- Example placeholder SVG -->
                                <svg width="100%" height="100%" viewBox="0 0 200 150" xmlns="http://www.w3.org/2000/svg" fill="none">
                                    <rect width="200" height="150" fill="#f3f4f6" />
                                    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle"
                                        fill="#a0aec0" font-size="16" font-family="Arial, sans-serif">
                                        No Image
                                    </text>
                                </svg>
                            </div>
                        <?php endif; ?>

                        <div class="blog-content">
                            <h2 class="blog-post-title"><?php the_title(); ?></h2>
                            <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
                            <span class="blog-date"><?php echo get_the_date(); ?></span>
                        </div>
                    </a>
                </article>
        <?php
            endwhile;

            echo '<div class="nv-pagination">';
            echo paginate_links([
                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'format' => '?paged=%#%',
                'current' => max(1, $paged),
                'total' => $blog_query->max_num_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
            ]);
            echo '</div>';
        else:
            echo '<p>No blog posts found.</p>';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>

<?php get_footer(); ?>