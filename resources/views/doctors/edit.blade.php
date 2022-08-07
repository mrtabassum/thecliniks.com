@extends('layouts.app')
@section('title')
    {{__('messages.doctor.edit')}}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/flatpickr.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/intl/css/intlTelInput.css') }}">
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{ route('doctors.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
            </div>
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
                            @include('layouts.errors')
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-12">
                            {{ Form::open(['route' => ['doctors.update',$user->doctor->id],'id'=>'editDoctorForm', 'method'=>'put', 'files' => true]) }}
                            <div class="card-body p-9">
                                @include('doctors.edit-fields')
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('doctors.templates.templates')
@endsection
@section('page_js')
    <script src="{{ asset('assets/js/intl/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/intl/js/utils.min.js') }}"></script>
    <script>
        let uId = '{{$doctor->id}}';
        let qualification = [];
        let isEdit = true;
        let utilsScript = "{{asset('assets/js/intl/js/utils.min.js')}}";
        let phoneNo = "{{ !empty($user) ? (($user->region_code).($user->contact)) : null }}";
        let UpdateData = '<?php echo json_encode($qualifications); ?>';
        UpdateData = JSON.parse(UpdateData);
        let countryId = '{{isset($user->address->country_id) ? $user->address->country_id:null}}';
        let stateId = '{{isset($user->address->state_id) ? $user->address->state_id:null}}';
        let cityId = '{{isset($user->address->city_id) ? $user->address->city_id:null}}';
        let backgroundImg = "{{ asset('web/media/avatars/male.png') }}";

        $.each(UpdateData, function (i, v) {
            let prepareData = {
                'id': v.id,
                'degree': v.degree,
                'year': v.year,
                'university': v.university,
            };
            qualification.push(prepareData);
        });
    </script>
    <script src="{{asset('assets/js/plugins/flatpickr.js')}}"></script>
    <script src="{{ asset('assets/js/custom/phone-number-country-code.js') }}"></script>
    <script src="{{mix('assets/js/doctors/create-edit.js')}}"></script>
@endsection

