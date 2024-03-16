
<!--========================================================= 
    Item Name: Ekka - Ecommerce HTML Template.
    Author: ashishmaraviya
    Version: 3.3
    Copyright 2022-2023
	Author URI: https://themeforest.net/user/ashishmaraviya
 ============================================================-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    
    <title>Ekka - Ecommerce HTML Template.</title>
    <meta name="keywords" content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">

    <!-- site Favicon -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{asset('ekka')}}/images/favicon/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{asset('ekka')}}/images/favicon/favicon.png" />
    <meta name="msapplication-TileImage" content="{{asset('ekka')}}/images/favicon/favicon.png" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{asset('ekka')}}/css/vendor/ecicons.min.css" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{asset('ekka')}}/css/plugins/animate.css" />
    <link rel="stylesheet" href="{{asset('ekka')}}/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{asset('ekka')}}/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="{{asset('ekka')}}/css/plugins/countdownTimer.css" />
    <link rel="stylesheet" href="{{asset('ekka')}}/css/plugins/slick.min.css" />
    <link rel="stylesheet" href="{{asset('ekka')}}/css/plugins/nouislider.css" />
    <link rel="stylesheet" href="{{asset('ekka')}}/css/plugins/bootstrap.css" />

    <!-- Main Style -->
    <link rel="stylesheet" href="{{asset('ekka')}}/css/style.css" />
    <link rel="stylesheet" href="{{asset('ekka')}}/css/demo1.css" />
    <link rel="stylesheet" href="{{asset('ekka')}}/css/responsive.css" />

    <!-- Background css -->
    <link rel="stylesheet" id="bg-switcher-css" href="{{asset('ekka')}}/css/backgrounds/bg-4.css">
    <link rel="icon" href="assets/images/favicon/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon.png" />
    <meta name="msapplication-TileImage" content="assets/images/favicon/favicon.png" />
</head>
<body>
    <div id="ec-overlay"><span class="loader_img"></span></div>
    
    @yield('register')
    <!-- Header start  -->
    @include('layouts.headers.ekkaNav')
    <!-- Header End  -->
    @yield('content')
    
    {{-- @include('layouts.footers.ekkaFoot') --}}

    <!-- Vendor JS -->
    <script src="{{asset('ekka')}}/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{asset('ekka')}}/js/vendor/popper.min.js"></script>
    <script src="{{asset('ekka')}}/js/vendor/bootstrap.min.js"></script>
    <script src="{{asset('ekka')}}/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{asset('ekka')}}/js/vendor/modernizr-3.11.2.min.js"></script>

    <!--Plugins JS-->
    <script src="{{asset('ekka')}}/js/plugins/swiper-bundle.min.js"></script>
    <script src="{{asset('ekka')}}/js/plugins/countdownTimer.min.js"></script>
    <script src="{{asset('ekka')}}/js/plugins/scrollup.js"></script>
    <script src="{{asset('ekka')}}/js/plugins/jquery.zoom.min.js"></script>
    <script src="{{asset('ekka')}}/js/plugins/slick.min.js"></script>
    <script src="{{asset('ekka')}}/js/plugins/infiniteslidev2.js"></script>
    <script src="{{asset('ekka')}}/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('ekka')}}/js/plugins/jquery.sticky-sidebar.js"></script>
    <!-- Google translate Js -->
    <script src="{{asset('ekka')}}/js/vendor/google-translate.js"></script>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }
    </script>
    <!-- Main Js -->
    <script src="{{asset('ekka')}}/js/vendor/index.js"></script>
    <script src="{{asset('ekka')}}/js/main.js"></script>
    <script src="//code.tidio.co/rd4o3btdnxnsnfhqizwgxzygl8q85tyc.js" async></script>
</body>
</html>