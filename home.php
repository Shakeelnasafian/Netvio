<?php get_header(); ?>

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
                                        <?php esc_html_e( 'No Image', 'netvio' ); ?>
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
            echo '<p>' . esc_html__( 'No blog posts found.', 'netvio' ) . '</p>';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>

<?php get_footer(); ?>