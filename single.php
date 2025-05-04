<?php get_header(); ?>

<main class="max-w-6xl mx-auto px-6 py-5 bg-white rounded-lg shadow-lg mt-8">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- Post Title -->
        <h1 class="text-4xl font-bold text-primary mb-4">
            <?php the_title(); ?>
        </h1>

        <!-- Meta Info -->
        <div class="text-sm text-gray-500 mb-6 flex flex-wrap items-center gap-2">
            <span class="flex items-center">📅 <?php echo get_the_date(); ?></span>
            <span>•</span>
            <span class="flex items-center">✍️ By <?php the_author(); ?></span>
        </div>

        <!-- Featured Image -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="mb-8">
                <?php the_post_thumbnail('large', ['class' => 'rounded-md shadow w-full h-auto']); ?>
            </div>
        <?php endif; ?>

        <!-- Post Content -->
        <div class="prose prose-lg max-w-none text-gray-700 prose-a:text-primary prose-a:hover:text-indigo-700">
            <?php the_content(); ?>
        </div>

        <!-- Categories -->
        <div class="mt-8">
            <h4 class="font-semibold mb-2 text-gray-600">📂 Categories:</h4>
            <div class="flex flex-wrap gap-2">
                <?php foreach (get_the_category() as $category) : ?>
                    <span class="bg-secondary text-white px-3 py-1 rounded-full text-xs hover:bg-green-500 transition">
                        <?php echo esc_html($category->name); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Tags -->
        <?php if (get_the_tags()) : ?>
            <div class="mt-4">
                <h4 class="font-semibold mb-2 text-gray-600">🏷️ Tags:</h4>
                <div class="flex flex-wrap gap-2">
                    <?php foreach (get_the_tags() as $tag) : ?>
                        <span class="border border-primary text-primary px-3 py-1 rounded-full text-xs hover:bg-primary hover:text-white transition">
                            #<?php echo esc_html($tag->name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Divider -->
        <hr class="my-10">

        <!-- Comments -->
        <div class="mt-10 p-6 bg-gray-50 rounded-lg shadow">
            <?php comments_template(); ?>
        </div>

        <!-- Back to Blog Button -->
        <div class="mt-10 text-center">
            <a href="<?php echo esc_url(home_url('/blog')); ?>" class="inline-block bg-primary text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition">
                ← Back to Blog
            </a>
        </div>

    <?php endwhile;
    else : ?>
        <p class="text-center text-gray-500">No post found.</p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
