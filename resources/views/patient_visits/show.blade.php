@extends('layouts.app')
@section('title')
    {{ __('messages.visit.visit_details') }}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <div class="d-flex align-items-center py-1 me-2">
                    <a href="{{ route('patients.patient.visits.index') }}"
                       class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                </div>
            </div>
        </div>
        @include('visits.templates.templates')
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container visit-detail-width">
            @include('flash::message')
            @include('layouts.errors')
            <div class="card-title m-0">
                <div class="d-flex flex-column flex-xl-row">
                    @include('patient_visits.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let noRecordsFound = "{{ __('messages.common.no_records_found') }}";
    </script>
    <script src="{{ mix('assets/js/visits/show-page.js') }}"></script>
@endsection

