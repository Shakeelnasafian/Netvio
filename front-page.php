<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Netvio
 */

get_header();
?>

<!-- Hero Section -->
<section class="flex flex-col-reverse lg:flex-row items-center px-10 py-5"
    style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/background-img.png'); ?>');
background-size: cover; background-position: center;">
    <!-- Left Content -->
    <div class="lg:w-1/2 space-y-6">
        <p class="text-purple-500 font-semibold"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/best-in-tech.svg" alt=""></p>
        <h1 class="text-4xl font-bold leading-snug">
            Reach Your <span class="relative inline-block">Business
                <svg class="absolute left-0 bottom-0 w-full h-2" viewBox="0 0 100 10" preserveAspectRatio="none">
                    <path d="M0,8 Q50,-3 100,8" stroke="#f472b6" stroke-width="2" fill="none" />
                </svg>
            </span><br>
            Goals with our Innovations
        </h1>
        <p class="text-gray-600">
            At Netvio Tech, we transform bold ideas into powerful digital experiences.
            Whether you’re launching a startup or scaling your brand, we deliver creative
            solutions that make an impact. Let’s build your future — together.
        </p>
        <div class="flex items-center space-x-6">
            <button class="bg-primary hover:bg-secondary text-white px-6 py-3 rounded-full">Get Started</button>
            <button class="flex items-center space-x-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM14.66 13.73L13.38 14.47L12.1 15.21C10.45 16.16 9.1 15.38 9.1 13.48V12V10.52C9.1 8.61 10.45 7.84 12.1 8.79L13.38 9.53L14.66 10.27C16.31 11.22 16.31 12.78 14.66 13.73Z" fill="#282C4B" />
                </svg>

                <span>Watch Video</span>
            </button>
        </div>
    </div>

    <!-- Right Image -->
    <div class="lg:w-1/2 relative">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-review-img.png" alt="Hero Image" class="w-full max-w-md mx-auto ">
        <!-- Example Review Box -->
        <!-- <div class="absolute bottom-4 left-4 bg-white p-4 rounded shadow-md flex items-center space-x-4">
                <div class="text-lg font-bold">4.9 ⭐⭐⭐⭐⭐</div>
                <div class="flex -space-x-2">
                    <img src="user1.png" class="w-8 h-8 rounded-full border-2 border-white">
                    <img src="user2.png" class="w-8 h-8 rounded-full border-2 border-white">
                    <img src="user3.png" class="w-8 h-8 rounded-full border-2 border-white">
                </div>
                <span class="bg-purple-200 text-purple-800 px-2 py-1 rounded-full text-xs">5k</span>
            </div> -->
    </div>
</section>

<section class="flex flex-col lg:flex-row items-start px-10 py-16 space-y-10 lg:space-y-0 lg:space-x-12">
    <!-- Left Side -->
    <div class="lg:w-1/2 space-y-6">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-work-img.png" alt="Team Working" class="rounded-md shadow-md">
        <div>
            <h3 class="text-2xl font-bold mb-2">We’re Ready To Grow Your Business With Us</h3>
            <p class="text-gray-600">
                With 10+ years of experience and award-winning results, our expert team is here to help your
                business grow, innovate, and stand out with the right strategy and support.
            </p>
        </div>
    </div>

    <!-- Right Side -->
    <div class="lg:w-1/2 space-y-6">
        <p class="text-sm font-semibold flex items-center gap-2">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="12" height="12" fill="#40DDB6" />
            </svg>
            <span>Welcome To NetvioTech</span>
        </p>
        <h2 class="text-3xl font-bold leading-snug">We Care About Your Business Plan.</h2>
        <p class="text-gray-600">
            We partner with ambitious businesses to craft tailored digital solutions that deliver results.
            From concept to launch, our collaborative process ensures your website reflects your mission,
            engages your audience, and drives measurable growth.
            Let’s build something great — together.
        </p>
        <ul class="space-y-3">
            <li class="flex items-center space-x-3">
                <span class="rounded-full p-1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/pink-tick.svg" alt=""></span>
                <span>Helping Teams Build</span>
            </li>
            <li class="flex items-center space-x-3">
                <span class="rounded-full p-1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/pink-tick.svg" alt=""></span>
                <span>Bold Brands</span>
            </li>
        </ul>

        <!-- Info Boxes -->
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 mt-6">
            <div class="border p-4 rounded w-full sm:w-1/2">
                <div class="flex items-center space-x-2 mb-2">
                    <span class="text-green-500 text-2xl"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/experience-icon.svg"
                            alt=""></span>
                    <h4 class="font-bold">Experience</h4>
                </div>
                <p class="text-gray-600 text-sm">Bringing 10+ years of expert experience to the table.</p>
            </div>
            <div class="border p-4 rounded w-full sm:w-1/2">
                <div class="flex items-center space-x-2 mb-2">
                    <span class="text-green-500 text-2xl"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/award-icon.svg" alt=""></span>
                    <h4 class="font-bold">Awards Winner</h4>
                </div>
                <p class="text-gray-600 text-sm">Over the past 10 years, we've earned multiple awards.</p>
            </div>
        </div>

        <!-- CTA Button -->
        <button class="bg-secondary hover:bg-primary text-white px-6 py-3 rounded-full mt-6">
            Get Started Today
        </button>
    </div>
</section>

<section class="bg-gray-50 px-10 py-16 text-center">
    <!-- Section Header -->
    <p class="text-sm font-semibold mb-2 flex items-center justify-center gap-2 text-center">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="12" height="12" fill="#40DDB6" />
        </svg>
        <span>We Are Expertise In</span>
    </p>
    <h2 class="text-3xl font-bold mb-10">We Provide Professional <br> Business Solutions.</h2>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-design-img.svg" alt="Branding Design" class="rounded-md mb-4">
            <h3 class="font-bold text-lg mb-2">Branding Design</h3>
            <p class="text-gray-600 mb-4 text-sm">
                Create a lasting first impression with a powerful brand identity. From logo design to brand
                strategy, we make your business unforgettable.
            </p>
            <a href="#"
                class="bg-primary hover:bg-secondary text-white px-6 py-3 rounded-full flex items-center space-x-2">
                <span>Get Started Today</span>
                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-4 h-4">
                        <path d="M7 17L17 7M9 7h8v8" stroke="currentColor" stroke-width="2" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg></span>
            </a>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/graphic-dimg.svg" alt="Graphic Design" class="rounded-md mb-4">
            <h3 class="font-bold text-lg mb-2">Graphic Design</h3>
            <p class="text-gray-600 mb-4 text-sm">
                Deliver your message through bold, creative visuals. We design stunning assets for web, social
                media, ads, and beyond.
            </p>
            <a href="#"
                class="bg-primary hover:bg-secondary text-white px-6 py-3 rounded-full flex items-center space-x-2">
                <span>Get Started Today</span>
                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-4 h-4">
                        <path d="M7 17L17 7M9 7h8v8" stroke="currentColor" stroke-width="2" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg></span>
            </a>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/web-dev-img.svg" alt="Web Development" class="rounded-md mb-4">
            <h3 class="font-bold text-lg mb-2">Web Development</h3>
            <p class="text-gray-600 mb-4 text-sm">
                We build fast, secure, and responsive websites using modern technologies — optimized for SEO,
                performance, and usability across devices.
            </p>
            <a href="#"
                class="bg-primary hover:bg-secondary text-white px-6 py-3 rounded-full flex items-center space-x-2">
                <span>Get Started Today</span>
                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-4 h-4">
                        <path d="M7 17L17 7M9 7h8v8" stroke="currentColor" stroke-width="2" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg></span>
            </a>
        </div>
    </div>
</section>

<section class="px-10 py-16 text-center">
    <!-- Section Header -->
    <div class="text-center mb-8">
        <div class="flex items-center justify-center space-x-2 text-sm font-semibold mb-2">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="12" height="12" fill="#40DDB6" />
            </svg>
            <span>What we're offering</span>
        </div>
        <h2 class="text-3xl font-bold mb-10">Services we’re providing <br> to our customers</h2>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-7xl mx-auto">
        <!-- Card 1 - Active -->
        <div class="bg-primary hover:bg-secondary text-white p-8 rounded-2xl flex flex-col items-center">
            <div class="text-4xl mb-4">
                <svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.75 45L49.25 45C51.3211 45 53 43.3211 53 41.25L53 15C53 12.9289 51.3211 11.25 49.25 11.25L11.75 11.25C9.67893 11.25 8 12.9289 8 15L8 41.25C8 43.3211 9.67893 45 11.75 45Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M38 52.5H23" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 35.625H53" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M30.5 45V52.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </div>
            <h3 class="font-bold text-lg mb-2">Product development</h3>
            <p class="text-sm">Website or <br> App development</p>
        </div>

        <!-- Card 2 -->
        <div class="border border-[#ccc] p-8 rounded-2xl flex flex-col items-center hover:bg-secondary group" onmouseenter="changeSvgColor(this)"
            onmouseleave="resetSvgColor(this)">
            <div class="text-4xl text-primary mb-4 group-hover:text-white">
                <svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M38.5414 6.9471L7.45083 38.0377C6.71859 38.7699 6.71859 39.9571 7.45083 40.6894L19.7992 53.0378C20.5315 53.77 21.7186 53.77 22.4509 53.0378L53.5415 21.9472C54.2737 21.2149 54.2737 20.0277 53.5415 19.2955L41.1931 6.9471C40.4608 6.21486 39.2737 6.21486 38.5414 6.9471Z" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M31.4375 14.0625L38.9375 21.5625" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M23 22.5L30.5 30" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M14.5625 30.9375L22.0625 38.4375" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </div>
            <h3 class="font-bold text-lg mb-2 group-hover:text-white">UI/UX designing</h3>
            <p class="text-sm text-gray-600 group-hover:text-white">Wireframing and <br> Prototyping</p>
        </div>

        <!-- Card 3 -->
        <div class="border border-[#ccc] p-8 rounded-2xl flex flex-col items-center hover:bg-secondary group" onmouseenter="changeSvgColor(this)"
            onmouseleave="resetSvgColor(this)">
            <div class="text-4xl text-primary mb-4">
                <svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.75 43.125V16.875" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M49.25 16.875V43.125" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M23 30V33.75" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M30.5 28.125V33.75" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M38 26.25V33.75" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M51.125 9.375H9.875C8.83947 9.375 8 10.2145 8 11.25V15C8 16.0355 8.83947 16.875 9.875 16.875H51.125C52.1605 16.875 53 16.0355 53 15V11.25C53 10.2145 52.1605 9.375 51.125 9.375Z" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 43.125H53" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </div>
            <h3 class="font-bold text-lg mb-2 group-hover:text-white">Data analysis</h3>
            <p class="text-sm text-gray-600 group-hover:text-white">Turning data <br> into insights</p>
        </div>

        <!-- Card 4 -->
        <div class="border border-[#ccc] p-8 rounded-2xl flex flex-col items-center hover:bg-secondary group" onmouseenter="changeSvgColor(this)"
            onmouseleave="resetSvgColor(this)">
            <div class="text-4xl text-primary mb-4">
                <svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.5 37.5H23V30L45.5 7.5L53 15L30.5 37.5Z" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M39.875 13.125L47.375 20.625" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M51.125 28.125V48.75C51.125 49.2473 50.9275 49.7242 50.5758 50.0758C50.2242 50.4275 49.7473 50.625 49.25 50.625H11.75C11.2527 50.625 10.7758 50.4275 10.4242 50.0758C10.0725 49.7242 9.875 49.2473 9.875 48.75V11.25C9.875 10.7527 10.0725 10.2758 10.4242 9.92418C10.7758 9.57254 11.2527 9.375 11.75 9.375H32.375" stroke="#593FFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </div>
            <h3 class="font-bold text-lg mb-2 group-hover:text-white">Content management</h3>
            <p class="text-sm text-gray-600 group-hover:text-white">Clear and consistent <br> content for the
                product</p>
        </div>
    </div>
</section>

<section class="bg-[#1E2143] px-10 py-16 text-white flex flex-col lg:flex-row items-center justify-between">
    <!-- Left Image -->
    <div class="lg:w-1/2 relative mb-10 lg:mb-0">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/why-chose-us-img.svg" alt="Why Choose Us" class="w-full max-w-sm mx-auto">
        <!-- Background splashes can be positioned using absolute divs or included in the image -->
    </div>

    <!-- Right Content -->
    <div class="lg:w-1/2 space-y-6 text-center lg:text-left">

        <p class="text-sm font-semibold flex items-center gap-2">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="12" height="12" fill="#40DDB6" />
            </svg>
            <span>Why Choose Us</span>
        </p>
        <h2 class="text-3xl font-bold leading-snug">
            Take on any Challenge <br> of the Tech World
        </h2>
        <ul class="space-y-3">
            <li class="flex items-center justify-center lg:justify-start space-x-3">
                <span class="rounded-full p-1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Checklist-Circle.svg" alt=""></span>
                <span>Passionate</span>
            </li>
            <li class="flex items-center justify-center lg:justify-start space-x-3">
                <span class="rounded-full p-1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Checklist-Circle.svg" alt=""></span>
                <span>Professional</span>
            </li>
            <li class="flex items-center justify-center lg:justify-start space-x-3">
                <span class="rounded-full p-1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Checklist-Circle.svg" alt=""></span>
                <span>Support</span>
            </li>
        </ul>
        <button
            class="bg-secondary hover:bg-primary text-white px-8 py-3 rounded-full font-semibold">
            Get Started
        </button>
    </div>
</section>

<section class="px-10 py-16 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
        <div>
            <p class="text-sm font-semibold mb-2 flex items-center gap-2">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="12" height="12" fill="#40DDB6" />
                </svg>
                <span>Our Projects</span>
            </p>
            <h2 class="text-3xl font-bold leading-snug">You can check our projects <br> as inspirations.</h2>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="#" class="bg-primary hover:bg-secondary text-white px-6 py-3 rounded-full inline-block">
                More Work
            </a>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/project-1.svg" alt="Project 1" class="rounded-md shadow">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/project-2.svg" alt="Project 2" class="rounded-md shadow">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/project-3.svg" alt="Project 3" class="rounded-md shadow">
    </div>
</section>

<section class="bg-gray-50 px-10 py-16 text-center">
    <!-- Header -->
    <p class="text-sm font-semibold mb-2 flex items-center justify-center gap-2">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="12" height="12" fill="#40DDB6" />
        </svg>
        <span>Testimonial</span>
    </p>
    <h2 class="text-3xl font-bold mb-10">What Our Client Say’s</h2>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
        <!-- Testimonial 1 -->
        <div class="bg-gradient-to-br from-green-200 to-purple-300 p-6 rounded-lg">
            <div class="flex items-center space-x-4 mb-4">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/john-carter.svg" alt="John Carter" class="w-12 h-12 rounded-full">
                <div class="text-left">
                    <h4 class="font-bold">John Carter</h4>
                    <p class="text-sm text-gray-700">Marketing Lead at Google</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded shadow text-left">
                <div class="text-yellow-400 text-lg mb-2">★★★★★</div>
                <hr class="mb-2">
                <p class="text-gray-600 text-sm">
                    Lorem Ipsum has been the industry's standard from dummy text ever since the unknown printer
                    to galley of type and make a type specimen book. 😇
                </p>
            </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="bg-gradient-to-br from-green-200 to-purple-300 p-6 rounded-lg">
            <div class="flex items-center space-x-4 mb-4">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/peeter-pawl.svg" alt="Peeter Pawl" class="w-12 h-12 rounded-full">
                <div class="text-left">
                    <h4 class="font-bold">Peeter Pawl</h4>
                    <p class="text-sm text-gray-700">Designer</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded shadow text-left">
                <div class="text-yellow-400 text-lg mb-2">★★★★★</div>
                <hr class="mb-2">
                <p class="text-gray-600 text-sm">
                    Lorem Ipsum has been the industry's standard from dummy text ever since the unknown printer
                    to galley of type and make a type specimen book. 😇
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Button -->
    <button class="bg-primary hover:bg-secondary text-white px-8 py-3 rounded-full mt-10">
        View More
    </button>
</section>

<section class="px-10 py-16 text-center">
    <!-- Header -->
    <p class="text-sm font-semibold mb-2 flex items-center justify-center gap-2">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="12" height="12" fill="#40DDB6" />
        </svg>
        <span>Contact</span>
    </p>
    <h2 class="text-3xl font-bold mb-10">Contact Us For Any Inquiry</h2>

    <!-- Contact Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <!-- Address -->
        <div
            class="bg-primary text-white p-10 rounded-md flex flex-col items-center space-y-4 hover:bg-secondary group">
            <div class="text-4xl"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/location-large.svg" alt=""></div>
            <h4 class="font-bold">ADDRESS</h4>
            <p>Pakistan, Islamabad</p>
        </div>

        <!-- Phone -->
        <div
            class="border border-[#ccc] p-10 rounded-md flex flex-col items-center space-y-4 hover:bg-secondary group" onmouseenter="changeSvgColor(this)"
            onmouseleave="resetSvgColor(this)">
            <div class="text-4xl text-primary group-hover:text-white">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.0675 16.9287C11.1275 22.9425 16.0575 27.8512 22.0713 30.9325L26.7463 26.2575C27.32 25.6838 28.17 25.4925 28.9137 25.7475C31.2938 26.5337 33.865 26.9587 36.5 26.9587C37.6688 26.9587 38.625 27.915 38.625 29.0837V36.5C38.625 37.6688 37.6688 38.625 36.5 38.625C16.5462 38.625 0.375 22.4538 0.375 2.5C0.375 1.33125 1.33125 0.375 2.5 0.375H9.9375C11.1062 0.375 12.0625 1.33125 12.0625 2.5C12.0625 5.15625 12.4875 7.70625 13.2737 10.0863C13.5075 10.83 13.3375 11.6588 12.7425 12.2537L8.0675 16.9287Z" fill="#593FFB" />
                </svg>
            </div>
            <h4 class="font-bold text-primary group-hover:text-white">PHONE</h4>
            <p class="text-primary group-hover:text-white">+923261333660</p>
        </div>

        <!-- Email -->
        <div
            class="border border-[#ccc] p-10 rounded-md flex flex-col items-center space-y-4 hover:bg-secondary group" onmouseenter="changeSvgColor(this)"
            onmouseleave="resetSvgColor(this)">
            <div class="text-4xl text-primary group-hover:text-white">
                <svg width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.5 26.5C2.60625 26.5 1.84142 26.182 1.2055 25.5461C0.569583 24.9102 0.251083 24.1448 0.25 23.25V3.75C0.25 2.85625 0.5685 2.09142 1.2055 1.4555C1.8425 0.819583 2.60733 0.501083 3.5 0.5H29.5C30.3937 0.5 31.1591 0.8185 31.7961 1.4555C32.4331 2.0925 32.7511 2.85733 32.75 3.75V23.25C32.75 24.1437 32.432 24.9091 31.7961 25.5461C31.1602 26.1831 30.3948 26.5011 29.5 26.5H3.5ZM16.5 15.125L29.5 7V3.75L16.5 11.875L3.5 3.75V7L16.5 15.125Z" fill="#593FFB" />
                </svg>

            </div>
            <h4 class="font-bold text-primary group-hover:text-white">EMAIL</h4>
            <p class="text-primary group-hover:text-white">info@netvio.com</p>
        </div>
    </div>
</section>

<section class="bg-[#2C2D4A] px-10 py-16 text-center text-white">
    <!-- Header -->
    <p class="text-sm font-semibold mb-2 flex items-center justify-center gap-2">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="12" height="12" fill="#40DDB6" />
        </svg>
        <span>Send Message</span>
    </p>
    <h2 class="text-3xl font-bold mb-10">Send Us Your Message Any Time</h2>

    <!-- Contact Form Container -->
    <div class="max-w-7xl mx-auto bg-white rounded-md flex flex-col lg:flex-row overflow-hidden text-gray-800">
        <!-- Left Info -->
        <div class="bg-green-400 p-10 flex flex-col justify-between lg:w-1/2 text-[#2C2D4A]">
            <p class="mb-6 text-left">
                We’re here to connect, collaborate, and support your tech journey.
                Whether you have questions about our products, need technical guidance,
                or are interested in partnership opportunities, we’re always ready to help.
                If you’d like to learn more about our platform, services, or how we can
                work together, feel free to reach out.
            </p>
            <button class="bg-[#2C2D4A] hover:bg-primary text-white px-6 py-3 rounded-full w-max">
                Request A Quote
            </button>
        </div>

        <!-- Right Form -->
        <form class="p-10 bg-white lg:w-1/2 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" placeholder="Enter Name"
                    class="bg-[#2C2D4A] text-white px-4 py-3 rounded-full w-full focus:outline-none">
                <input type="text" placeholder="Enter Company Name"
                    class="bg-[#2C2D4A] text-white px-4 py-3 rounded-full w-full focus:outline-none">
                <input type="text" placeholder="Enter Phone Number"
                    class="bg-[#2C2D4A] text-white px-4 py-3 rounded-full w-full focus:outline-none">
                <input type="email" placeholder="Enter Email"
                    class="bg-[#2C2D4A] text-white px-4 py-3 rounded-full w-full focus:outline-none">
            </div>
            <textarea placeholder="Your Message" rows="5"
                class="bg-[#2C2D4A] text-white px-4 py-3 rounded-2xl w-full focus:outline-none"></textarea>
            <button type="submit"
                class="bg-secondary hover:bg-primary hover:text-white text-[#2C2D4A] px-8 py-3 rounded-full font-semibold">
                Send Message Now
            </button>
        </form>
    </div>
</section>

<section class="px-10 py-16 text-center">
    <!-- Header -->
    <p class="text-sm font-semibold mb-2 flex items-center justify-center gap-2">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="12" height="12" fill="#40DDB6" />
        </svg>
        <span>Subscribe</span>
    </p>
    <h2 class="text-3xl font-bold mb-10">Be the First to Know</h2>

    <!-- Subscribe Box -->
    <div class="bg-[#593FFB] text-white max-w-4xl mx-auto p-10 rounded-lg space-y-6">
        <p>Join Our Mailing List & to get our news.</p>
        <form class="flex flex-col sm:flex-row justify-center">
            <input type="email" placeholder="Your email address"
                class="px-4 py-3 text-white border w-full sm:w-2/3 rounded-l-md focus:outline-none">
            <button type="submit"
                class="bg-secondary text-white px-6 py-3 rounded-r-md mt-4 sm:mt-0 transform hover:scale-105 transition duration-300">
                Subscribe
            </button>
        </form>
    </div>
</section>

<?php
get_footer();
