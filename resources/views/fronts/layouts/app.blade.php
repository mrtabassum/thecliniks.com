<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="{{getAppName()}}"/>
    <link rel="icon" href="{{ asset(getAppFavicon()) }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <!-- META ============== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- OG -->
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/front/vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/vendor/swiper/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('assets/front/css/front-custom.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="//fonts.googleapis.com">
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
    <link href="//fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Document Title ===================== -->
    <title>@yield('front-title') | {{ getAppName() }}</title>
    @yield('front-css')
</head>
<body>
<!-- Document Wrapper
============================================= -->
<div class="page-wraper">
    {{--    <div id="loading-icon-bx">--}}
    {{--        <div class="loading-inner">--}}
    {{--            <div class="load-one"></div>--}}
    {{--            <div class="load-two"></div>--}}
    {{--            <div class="load-three"></div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    @include('fronts.layouts.header')

    @yield('front-content')

    @include('fronts.layouts.footer')

</div><!-- #wrapper end -->

<button class="back-to-top fa fa-chevron-up"></button>
<script>
    let currencyIcon = '{{ getCurrencyIcon() }}';
    let isSetFirstFocus = false;
</script>
<script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/front/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/front/vendor/swiper/swiper.min.js') }}"></script>
<script src="{{ asset('assets/front/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('assets/front/js/functions.js') }}"></script>
<script src="{{ asset('assets/front/js/contact.js') }}"></script>
<script src="{{ mix('assets/front/js/front-language.js') }}"></script>
@routes
@yield('front-js')
<script>
    let csrfToken = "{{ csrf_token() }}";
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300);
    });
</script>
</body>
</html>
