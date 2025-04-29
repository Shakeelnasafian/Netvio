<?php get_header(); ?>

<main class="max-w-4xl mx-auto px-4 py-16">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <!-- Post Title -->
        <h1 class="text-4xl font-bold text-primary mb-4"><?php the_title(); ?></h1>

        <!-- Post Meta -->
        <div class="text-sm text-gray-500 mb-6">
            Published on <?php echo get_the_date(); ?> by <?php the_author(); ?>
        </div>

        <!-- Featured Image -->
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="mb-6">
                <?php the_post_thumbnail( 'large', ['class' => 'rounded-lg shadow'] ); ?>
            </div>
        <?php endif; ?>

        <!-- Post Content -->
        <div class="prose max-w-none">
            <?php the_content(); ?>
        </div>

        <!-- Post Categories -->
        <div class="mt-8 text-sm text-gray-600">
            Categories: <?php the_category( ', ' ); ?>
        </div>

        <!-- Post Tags -->
        <div class="mt-2 text-sm text-gray-600">
            Tags: <?php the_tags( '', ', ' ); ?>
        </div>

        <!-- Comments Section -->
        <div class="mt-12">
            <?php comments_template(); ?>
        </div>

    <?php endwhile; else : ?>
        <p class="text-center text-gray-500">Sorry, no posts found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
