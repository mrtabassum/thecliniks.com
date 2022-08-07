@extends('layouts.auth')
@section('title')
    Forgot Password
@endsection
@section('content')
    <!--begin::Main-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

        <a class="mb-5">
            <img alt="Logo" src="{{ asset(getAppLogo()) }}" class="h-70px logo">
        </a>
        <div class="w-lg-500px">
            <div class="w-100">
                @include('layouts.errors')
                @if (session('status'))
                    @include('flash::message')
                @endif
            </div>
        </div>
        <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">

            <form class="form w-100" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="text-center mb-10">

                    <h1 class="text-dark mb-3">{{__('messages.web.forgot_password')}} ?</h1>

                    {{--<div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div>--}}
                    <div class="text-gray-400 fw-bold fs-4">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</div>
                </div>

                <!-- Email Address -->
                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-gray-900 fs-6 required"
                           for="email">{{__('messages.web.email')}}: </label>
                    <input id="email" class="form-control form-control-solid" type="email" value="{{ old('email') }}"
                           required autofocus name="email" placeholder="Email" autocomplete="off"/>
                </div>

                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                    <button type="submit" class="btn btn-lg btn-primary fw-bolder me-4">
                        <span class="indicator-label"> {{ __('Email Password Reset Link') }}</span>
                        <span class="indicator-progress">{{__('messages.common.please_wait')}}
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <a href="{{ route('register') }}"
                       class="btn btn-lg btn-light-primary fw-bolder">{{__('messages.common.cancel')}}</a>
                </div>

            </form>

        </div>

    </div>
    <!--end::Main-->
@endsection
@push('scripts')
@endpush
