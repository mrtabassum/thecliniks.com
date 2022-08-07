@extends('layouts.app')
@section('title')
    {{ __('messages.doctor_session.add') }}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                    {{ (Auth::user()->hasRole('doctor')) ? __('messages.doctor_session.my_schedule') : __('messages.doctor_session.add') }}
                </h1>
            </div>
            @if(getLogInUser()->hasRole('doctor'))
                <div class="d-flex align-items-center py-1 ms-auto">
                    <a href="{{ route('doctors.doctor-sessions.edit',getLogInUser()->doctor->id) }}"
                       class="d-none" id="btnBack">{{ __('messages.common.back') }}</a>
                </div>
            @else
                <div class="d-flex align-items-center py-1 ms-auto">
                    <a href="{{ url()->previous() }}"
                       class="btn btn-sm btn-primary" id="btnBack">{{ __('messages.common.back') }}</a>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                    <div class="row">
                        <div class="col-12">
                            @include('flash::message')
                            @include('layouts.errors')
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-12">
                            @if(Auth::user()->hasRole('doctor'))
                                {{ Form::open(['route' => 'doctors.doctor-sessions.store','id' => 'saveForm']) }}
                            @else
                                {{ Form::open(['route' => 'doctor-sessions.store','id' => 'saveForm']) }}
                            @endif
                            <div class="card-body p-0">
                                @include('doctor_sessions.fields')
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('doctor_sessions.templates.templates')
@section('page_js')
    <script>
        let isEdit = false;
        let getSlotByGapUrl = "{{ getLogInUser()->hasRole('doctor') ? url('doctors/get-slot-by-gap') : route('get.slot.by.gap') }}";
    </script>
    <script src="{{ mix('assets/js/doctor_sessions/create-edit.js') }}"></script>
@endsection

