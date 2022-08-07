@extends('layouts.app')
@section('title')
    {{ __('messages.user.profile_details') }}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/intl/css/intlTelInput.css') }}">
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('messages.user.edit_profile') }}</h1>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container mt-9">
                @include('flash::message')
                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <div class="card mb-5 mb-xl-10">
                    <div id="kt_account_profile_details" class="collapse show">
                        <form id="profileForm" method="POST"
                              action="{{ route('update.profile.setting') }}"
                              class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                                        <span>{{__('messages.user.avatar')}}: </span>
                                        <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                           title="Best resolution for this avatar will be 150X150"
                                           data-bs-original-title="Phone number must be active"
                                           aria-label="Phone number must be active"></i>
                                    </label>
                                    @php $styleCss = 'style'; @endphp
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                        {{ $styleCss }}="background-image: url({{ asset('web/media/avatars/150-26.jpg') }})">
                                        <div class="image-input-wrapper w-125px h-125px" id="bgImage"
                                        {{ $styleCss }}="background-image: url('{{ (getLogInUser()->hasRole('patient')) ? getLogInUser()->patient->profile : $user->profile_image }}')">
                                    </div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                           data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                           data-bs-original-title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7">
                                            {{ Form::file('image', ['accept' => '.png, .jpg, .jpeg', 'value' => asset('web/media/avatars/150-2.jpg')]) }}
                                        </i>
                                        {{ Form::file('avatar', ['accept' => '.png, .jpg, .jpeg']) }}
                                        {{ Form::hidden('avatar_remove') }}
                                    </label>
                                        </div>
                                        <div class="form-text">{{__('messages.doctor.allowed_img')}}</div>
                                    </div>
                                </div>
                                <div class="row mb-6 align-items-baseline">
                                    <label class="col-lg-4 form-label fs-6 fw-bolder text-gray-700 mb-3 required">{{ __('messages.user.full_name').':' }}</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                                {{ Form::text('first_name', $user->first_name, ['class'=> 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'placeholder' => 'First name', 'required']) }}
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                                {{ Form::text('last_name', $user->last_name, ['class'=> 'form-control form-control-lg form-control-solid', 'placeholder' => 'Last name', 'required']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <div class="row mb-6 align-items-baseline">
                        <label class="col-lg-4 form-label required fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.user.email').':' }}</label>
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            {{ Form::email('email', $user->email, ['class'=> 'form-control form-control-lg form-control-solid', 'placeholder' => 'Email', 'required']) }}
                        </div>
                    </div>
                    <div class="row mb-6 align-items-baseline">
                        <label class="col-lg-4 form-label required fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.user.time_zone').':' }}
                        </label>
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            {{ Form::select('time_zone', App\Models\User::TIME_ZONE_ARRAY, $user->time_zone,['class'=> 'form-control form-control-lg form-control-solid', 'placeholder' => 'Select a Time Zone', 'required', 'data-control'=>'select2',]) }}
                        </div>
                    </div>
                    <div class="row mb-6 align-items-baseline">
                        <label class="col-lg-4 form-label required fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.user.contact_number').':' }}</label>
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            {{ Form::tel('contact', $user->contact, ['id'=>'phoneNumber', 'class'=> 'form-control form-control-lg form-control-solid', 'placeholder' => 'Phone number','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                            {{ Form::hidden('region_code',!empty($user->user) ? $user->region_code : null,['id'=>'prefix_code']) }}
                            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                                        <span id="error-msg" class="hide"></span>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="d-flex py-6">
                                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{ asset('assets/js/intl/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/intl/js/utils.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let isEdit = false;
        let utilsScript = "{{asset('assets/js/intl/js/utils.min.js')}}";
        let phoneNo = "{{ !empty($user) ? (($user->region_code).($user->contact)) : null }}";
        let backgroundImg = "{{ asset('web/media/avatars/male.png') }}";
    </script>
    <script src="{{ asset('assets/js/custom/phone-number-country-code.js') }}"></script>
    <script src="{{mix('assets/js/profile/create-edit.js')}}"></script>
@endsection
