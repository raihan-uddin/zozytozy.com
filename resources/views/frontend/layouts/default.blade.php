@php use App\Helpers\SettingsHelper; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fav icon -->
    <link rel="icon" href="{{ asset('images/logos/logo.png') }}" type="image/x-icon"/>

    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="bingbot" content="index, follow">
    <meta name="yandex" content="index, follow">
    <meta name="referrer" content="no-referrer-when-downgrade">

    <!-- Dynamic Meta Tags for SEO -->
    @section('meta')
        <!-- Primary Meta Tags -->
        <meta name="title" content="@yield('title')">
        <!-- Dynamic Meta Tags for SEO -->
        <meta name="description"
              content="{{ $metaDescription ?? SettingsHelper::get('home_page_meta_description', 'Developed By Raihan uddin. Phone: +8801680527922') }}">
        <meta name="keywords" content="{{ $metaKeywords ?? SettingsHelper::get('home_page_meta_keywords') }}">
        <meta name="author" content="{{ $metaAuthor ?? SettingsHelper::get('home_page_meta_author') }}">

        <!-- Open Graph Meta Tags for Facebook -->
        <meta property="og:title" content="@yield('title')"/>
        <meta property="og:description"
              content="{{ $metaDescription ?? SettingsHelper::get('home_page_meta_description', 'Developed By Raihan uddin. Phone: +8801680527922') }}"/>
        <meta property="og:image" content="{{ $metaImage ?? asset('images/logos/logo.png') }}"/>
        <meta property="og:url" content="{{ request()->url() }}"/>
        <meta property="og:type" content="website"/>

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ SettingsHelper::get('meta_twitter_handle') }}">
        <meta name="twitter:title" content="@yield('title')">
        <meta name="twitter:description"
              content="{{ $metaDescription ?? SettingsHelper::get('home_page_meta_keywords') }}">
        <meta name="twitter:image" content="{{ $metaImage ?? asset('images/logos/logo.png') }}">

        <!-- Additional Meta Tags -->
        <meta property="article:published_time" content="{{ $metaPublishedTime ?? now()->toISOString() }}">
        <meta property="article:modified_time" content="{{ $metaModifiedTime ?? now()->toISOString() }}">
        <meta property="og:site_name" content="{{ config('app.name') }}">
    @show



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Css All Plugins Files -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/aos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/jquery-range-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/color-9.css')}}" id="add_class">

    {{-- <!-- tailwindcss --> --}}
    {{-- <script src="{{asset('assets/js/vendor/tailwindcss3.4.5.js') }}"></script> --}}

    <!-- Main Style -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <!-- Scripts -->
    @vite(['resources/js/frontend.js', 'resources/css/frontend.css'])

    @stack('styles')

    {{-- if environment is production --}}
    @if(config('app.env') == 'production')
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-RWSC97KGPP"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'G-RWSC97KGPP');
        </script>

        <!-- Microsoft Clarity -->
        <script type="text/javascript">
            (function (c, l, a, r, i, t, y) {
                c[a] = c[a] || function () {
                    (c[a].q = c[a].q || []).push(arguments)
                };
                t = l.createElement(r);
                t.async = 1;
                t.src = "https://www.clarity.ms/tag/" + i;
                y = l.getElementsByTagName(r)[0];
                y.parentNode.insertBefore(t, y);
            })(window, document, "clarity", "script", "oftpsfs2bg");
        </script>
    @endif
    {{-- end if environment is production --}}
</head>
<body>
{{-- TODO:: need to active after all done --}}
<!-- Loader -->
{{-- <div
    class="bb-loader min-w-full w-full h-screen fixed top-[0] left-[0] flex items-center justify-center bg-[#fff] z-[45]">
    <img src="{{asset('assets/img/logo/loader.png')}}" alt="loader" class="absolute">
    <span class="loader w-[60px] h-[60px] relative"></span>
</div> --}}
<x-frontend.header></x-frontend.header>

@yield('content')

<x-frontend.footer></x-frontend.footer>

<!-- Plugins -->
<script src="{{asset('assets/js/vendor/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery.zoom.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/aos.js')}}"></script>
<script src="{{asset('assets/js/vendor/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/smoothscroll.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/slick.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/vendor/jquery-range-ui.min.js')}}"></script> --}}

<!-- main-js -->
<script src="{{asset('assets/js/main.js')}}"></script>

<!-- lozad -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
<script>
    const observer = lozad();
    observer.observe();
</script>
@stack('scripts')
</body>
</html>
