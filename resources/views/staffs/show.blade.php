@extends('layouts.app')
@section('title')
    {{__('messages.staff.staff_details')}}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex justify-content-end ms-auto">
                <div class="d-flex align-items-center py-1 me-2">
                    <a href="{{route('staff.edit',$staff->id)}}"
                       class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder">{{ __('messages.common.edit') }}</a>
                </div>
                <div class="d-flex align-items-center py-1">
                    <a href="{{ url()->previous() }}"
                       class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card-title m-0">
                <div class="d-flex flex-column flex-xl-row">
                    @include('staffs.show_fields')
                </div>
            </div>
        </div>
    </div>
    @include('doctors.templates.templates')
    @include('appointments.templates.templates')
@endsection
