@extends('layouts.app')
@section('title')
    {{__('messages.staffs')}}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div id="kt_content_container" class="container">
        <div class="card">
            <div class="card-header d-flex border-0 pt-6">
                @include('layouts.search-component')
                <div class="card-toolbar ms-auto">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a type="button" class="btn btn-primary" href="{{ route('staff.create')}}">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                         height="24px" viewBox="0 0 24 24" version="1.1">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.5"
                                              transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)"
                                              x="4" y="11" width="16" height="2" rx="1"/>
                                    </svg>
                                </span>
                                {{__('messages.staff.add_staff')}}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('staffs.table')
                </div>
        </div>
    </div>
    @include('layouts.templates.actions')
@endsection
@section('scripts')
    <script>
        let recordsURL = "{{ route('staff.index') }}";
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/staff/staff.js') }}"></script>
@endsection
