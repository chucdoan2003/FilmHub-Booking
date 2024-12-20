<!DOCTYPE html>
<html lang="zxx">



<head>
    <meta charset="utf-8" />
    <title>FilmHub</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Movie Pro" />
    <meta name="keywords" content="Movie Pro" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <!--Template style -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('website/images/header/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/fonts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/flaticon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/owl.carousel.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/owl.theme.default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/dl-menu.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/nice-select.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/magnific-popup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/venobox.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/js/plugin/rs_slider/layers.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/js/plugin/rs_slider/navigation.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/js/plugin/rs_slider/settings.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/responsive.css') }}" />
    <link rel="stylesheet" id="theme-color" type="text/css" href="#" />
    <!-- favicon links -->

</head>

<body>

    @include('frontend.layouts.header')
    @include('frontend.layouts.slider.slider')


    @yield('content')
    {{-- @include('frontend.layouts.product.product1') --}}



    {{-- @include('frontend.layouts.product.product2') --}}


    {{-- @include('frontend.layouts.content.blog')
    @include('frontend.layouts.content.feature')
    @include('frontend.layouts.content.vidpho')
    @include('frontend.layouts.content.patner')

    @include('frontend.layouts.login.login')  --}}
    @include('frontend.layouts.footer')



    <!-- st login wrapper End -->
    <!--main js file start-->
    <script src="{{ asset('website/js/font-fontawesome-ae333ffef2.js') }}"></script>
    <script src="{{ asset('website/js/jquery_min.js') }}"></script>
    <script src="{{ asset('website/js/modernizr.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap.js') }}"></script>
    <script src="{{ asset('website/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('website/js/jquery.dlmenu.js') }}"></script>
    <script src="{{ asset('website/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('website/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('website/js/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('website/js/venobox.min.js') }}"></script>
    <script src="{{ asset('website/js/smothscroll_part1.js') }}"></script>
    <script src="{{ asset('website/js/smothscroll_part2.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.addon.snow.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('website/js/plugin/rs_slider/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('website/js/custom.js') }}"></script>
    <!--main js file end-->
</body>


<!-- Mirrored from www.webstrot.com/html/moviepro/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Nov 2024 10:18:46 GMT -->

</html>
