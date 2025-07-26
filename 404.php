<?php
get_header();
?>

<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
  <div class="max-w-md w-full text-center">
    <!-- Icon -->
    <div class="w-24 h-24 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
      <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728" />
      </svg>
    </div>

    <!-- Text -->
    <h1 class="text-6xl font-bold text-gray-900 mb-2">404</h1>
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Page Not Found</h2>
    <p class="text-gray-600 mb-8">
      Sorry, the page you’re looking for doesn’t exist or has been moved.
    </p>

    <!-- Buttons -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="/"
        class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
        Go to Homepage
      </a>
      <a href="/blog"
        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
        Browse Blog
      </a>
    </div>
  </div>
</div>


<?php
get_footer();
