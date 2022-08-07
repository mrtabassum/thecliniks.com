@extends('layouts.app')
@section('title')
    {{__('messages.visit.edit_visit')}}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/flatpickr.css')}}">
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                @role('doctor')
                <a href="{{ route('doctors.visits.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                @else
                    <a href="{{ route('visits.index') }}"
                       class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                    @endrole
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                    @include('layouts.errors')
                    <div class="card">
                        <div class="card-body p-12">
                            @if(getLogInUser()->hasRole('doctor'))
                                {{ Form::model($visit,['route' => ['doctors.visits.update', $visit->id], 'method' => 'patch','id' => 'saveForm']) }}
                            @else
                                {{ Form::model($visit,['route' => ['visits.update', $visit->id], 'method' => 'patch','id' => 'saveForm']) }}
                            @endif
                            <div class="card-body p-9">
                                @include('visits.fields')
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{asset('assets/js/plugins/flatpickr.js')}}"></script>
    <script src="{{mix('assets/js/visits/create-edit.js')}}"></script>
@endsection
