<?php get_header(); ?>

<main class="max-w-3xl mx-auto px-6 py-16 bg-white rounded-lg shadow-lg mt-10">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <!-- Post Title -->
        <h1 class="text-4xl font-bold text-primary mb-4"><?php the_title(); ?></h1>

        <!-- Meta Info -->
        <div class="text-sm text-gray-500 mb-6 flex items-center space-x-2">
            <span>📅 <?php echo get_the_date(); ?></span>
            <span>•</span>
            <span>✍️ By <?php the_author(); ?></span>
        </div>

        <!-- Featured Image -->
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="mb-8">
                <?php the_post_thumbnail( 'large', ['class' => 'rounded-md shadow'] ); ?>
            </div>
        <?php endif; ?>

        <!-- Post Content -->
        <div class="prose prose-lg max-w-none text-gray-700">
            <?php the_content(); ?>
        </div>

        <!-- Categories -->
        <div class="mt-8">
            <h4 class="font-semibold mb-2 text-gray-600">📂 Categories:</h4>
            <div class="flex flex-wrap gap-2">
                <?php foreach( get_the_category() as $category ) : ?>
                    <span class="bg-secondary text-white px-3 py-1 rounded-full text-xs">
                        <?php echo esc_html( $category->name ); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Tags -->
        <?php if ( get_the_tags() ) : ?>
            <div class="mt-4">
                <h4 class="font-semibold mb-2 text-gray-600">🏷️ Tags:</h4>
                <div class="flex flex-wrap gap-2">
                    <?php foreach( get_the_tags() as $tag ) : ?>
                        <span class="border border-primary text-primary px-3 py-1 rounded-full text-xs">
                            #<?php echo esc_html( $tag->name ); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Divider -->
        <hr class="my-10">

        <!-- Comments -->
        <div>
            <?php comments_template(); ?>
        </div>

    <?php endwhile; else : ?>
        <p class="text-center text-gray-500">No post found.</p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
