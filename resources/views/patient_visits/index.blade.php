@extends('layouts.app')
@section('title')
    {{ __('messages.visits') }}
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
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('patient_visits.table')
                    @include('patient_visits.templates.templates')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{asset('assets/js/custom/custom-datatable.js')}}"></script>
@endsection
@section('scripts')
    <script src="{{mix('assets/js/patient_visits/patient-visit.js')}}"></script>
@endsection
