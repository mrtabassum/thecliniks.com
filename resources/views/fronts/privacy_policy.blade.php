@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.privacy_policy') }}
@endsection
@section('front-content')
    <section id="content">
        <div class="content-wrap">
            <div class="container">
                <div class="mt-100">{!! $privacyPolicy['privacy_policy'] !!}</div>
            </div>
        </div>
    </section>
@endsection
@section('front-js')
    <script src="{{ asset('assets/js/fronts/medical-contact/enquiry.js') }}"></script>
@endsection
