@extends('layouts.app')
@section('title')
    {{ __('messages.subscribers') }}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                <div class="card-header d-flex border-0 pt-6">
                    @include('layouts.search-component')
                </div>
                <div class="card-body pt-0">
                    @include('fronts.subscribers.table')
                    @include('fronts.subscribers.templates.templates')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/fronts/subscribers/subscriber.js')}}"></script>
@endsection
