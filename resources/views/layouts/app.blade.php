<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ getAppName() }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset(getAppFavicon()) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!-- General CSS Files -->
    @yield('css_before')
    <link href="{{ asset('backend/css/vendor.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/fonts.css') }}" rel="stylesheet" type="text/css"/>
    @yield('page_css')
    <link href="{{ asset('backend/css/3rd-party.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/3rd-party-custom.css') }}" rel="stylesheet" type="text/css"/>
    @if(Auth::user()->dark_mode)
        <link href="{{ asset('backend/css/style.dark.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ mix('assets/css/custom-dark-mode.css') }}" rel="stylesheet" type="text/css"/>
    @else
        <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    @endif
    <link href="{{ mix('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
</head>
@php $styleCss = 'style'; @endphp
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed {{ (Auth::user()->dark_mode) ? 'dark-mode' : ''}}"
{{ $styleCss }}="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px"
data-new-gr-c-s-check-loaded="14.1025.0" data-gr-ext-installed="">
<div class="main-content">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            @include('layouts.sidebar')
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('layouts.header')
                <div class="d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('header_toolbar')
                    <div class="content d-flex flex-column flex-column-fluid header-top-padding" id="kt_post">
                        <div class="container" id="kt_content_container">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <span class="svg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <rect fill="#000000" opacity="0.5" x="11" y="10" width="2" height="10" rx="1"/>
                            <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                                  fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg>
                </span>
    </div>
    @include('profile.changePassword')
    @include('profile.email_notification')
</div>
<script src="{{ asset('assets/js/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('backend/js/vendor.js') }}"></script>
<script src="{{ asset('backend/js/datatables.js') }}"></script>
<script src="{{ asset('backend/js/3rd-party-custom.js') }}"></script>
<script>
    let currencyIcon = '{{ getCurrencyIcon() }}';
    let isSetFirstFocus = true;
    let womanAvatar = '{{ url(asset('web/media/avatars/female.png')) }}';
    let manAvatar = '{{ url(asset('web/media/avatars/male.png')) }}';
</script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
<script src="{{ mix('assets/js/custom/sidebar_menu.js') }}"></script>
<script src="{{ asset('assets/js/users/user-profile.js') }}"></script>
@routes
@yield('page_js')
@yield('scripts')
<script>
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300);
    });
    let changePasswordUrl = "{{ route('user.changePassword') }}";
    let updateLanguageURL = "{{ route('change-language')}}";
</script>
</body>
</html>
