@extends('layouts.app')
@section('title')
    {{__('messages.settings')}}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/intl/css/intlTelInput.css') }}">
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            @include('setting.setting_menu')
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0" data-bs-toggle="collapse"
                     aria-expanded="true"
                     aria-controls="kt_account_profile_details">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.setting.general_details') }}</h3>
                    </div>
                </div>
                <div id="kt_account_profile_details" class="collapse show">
                    {{ Form::open(['route' => 'setting.update', 'files' => true,'class'=>'form','id' => 'generalSettingForm']) }}
                    {{ Form::hidden('sectionName', $sectionName) }}
                    <div class="card-body border-top p-9 pb-0">
                        <div class="row mb-6">
                            {{ Form::label('clinic_name',__('messages.setting.clinic_name').':',
                                     ['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) }}
                            <div class="col-lg-8 fv-row">
                                {{ Form::text('clinic_name', $setting['clinic_name'], ['class' => 'form-control form-control-lg                                                          form-control-solid','placeholder'=>'Clinic name','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6 align-items-center">
                            {{ Form::label('contactNo',__('messages.patient.contact_no').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3 contact-label']) }}
                            <div class="col-lg-8 fv-row ms-auto">
                                {{ Form::tel('contact_no',$setting['contact_no'] ?? null,['class' => 'form-control form-control-solid','placeholder' => 'Contact number','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber', 'required']) }}
                                {{ Form::hidden('region_code',$setting['region_code'] ?? null,['id'=>'prefix_code']) }}
                                <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                                <span id="error-msg" class="hide"></span>
                            </div>
                        </div>
                        <div class="row mb-6">
                            {{ Form::label('email',__('messages.user.email').':',['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) }}
                            <div class="col-lg-8 fv-row">
                                {{ Form::email('email', $setting['email'], ['class' => 'form-control form-control-lg                                                                     form-control-solid','placeholder'=>'email','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            {{ Form::label('specialities',__('messages.setting.specialities').':',
                                            ['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) }}
                            <div class="col-lg-8 fv-row">
                                {{ Form::select('specialities[]', $specialities, json_decode($setting['specialities']), ['multiple',
                                        'class' => 'form-select form-select-solid form-select-lg fw-bold', 'aria-label'=>"Select a Country",
                                        'data-control'=>'select2','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span>{{__('messages.setting.logo')}}: </span>
                                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Best resolution for this logo will be 90x60"
                                   data-bs-original-title="Phone number must be active"
                                   aria-label="Phone number must be active"></i>
                            </label>
                            @php $styleCss = 'style'; @endphp
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-125px h-125px"
                                    {{ $styleCss }}="
                                    background-image: url({{($setting['logo'])?asset($setting['logo']):asset('assets/image/infyCare-favicon.ico')}}
                                    )">
                                </div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                       data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                       data-bs-original-title="Change Logo">
                                    <i class="bi bi-pencil-fill fs-7">
                                        <input type="file" name="logo">
                                    </i>
                                </label>
                            </div>
                            <div class="form-text">{{__('messages.doctor.allowed_img')}}</div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                            <span>{{__('messages.setting.favicon')}}: </span>
                            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                               title="Best resolution for this favicon will be 32X32"
                               data-bs-original-title="Phone number must be active"
                               aria-label="Phone number must be active"></i>
                        </label>
                            @php $styleCss = 'style'; @endphp
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-60px h-60px"
                                    {{ $styleCss }}="
                                    background-image: url({{($setting['favicon'])?asset($setting['favicon']):asset('assets/image/infyom-logo.png')}}
                                    )">
                                </div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                       data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                       data-bs-original-title="Change Favicon">
                                    <i class="bi bi-pencil-fill fs-7">
                                        <input type="file" name="favicon">
                                    </i>
                                </label>
                            </div>
                        <div class="form-text">{{__('messages.doctor.allowed_img')}}</div>
                    </div>
                </div>
                <div class="row mb-6">
                    <div class="form-check form-check-custom form-check-solid">
                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                            <span>{{__('messages.setting.do_not_allow_to_login_without_email_verification')}}:</span>
                            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                               title="When checkbox is disable email verification is not working for new users."
                               data-bs-original-title="Phone number must be active"
                               aria-label="Phone number must be active"></i>
                        </label>
                        <div class="col-lg-8 fv-row d-flex align-items-center">
                            {{ Form::checkbox('email_verified', 1, $setting['email_verified'], ['class' => 'form-check-input  m-0']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header border-0" data-bs-toggle="collapse"
             aria-expanded="true"
             aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.setting.currency_settings') }}</h3>
                    </div>
                </div>
                <div id="kt_account_profile_details" class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                {{ Form::label('currency',__('messages.setting.currency').':',['class'=>'col-lg-4 col-form-label fw-bold                                       fs-6']) }}
                            </label>
                            <div class="col-lg-8 fv-row">
                                {{ Form::select('currency', $currencies, $setting['currency'], [
                                        'class' => 'form-select form-select-solid form-select-lg fw-bold', 'aria-label'=>"Select a Currency",
                                        'data-control'=>'select2','placeholder' => 'Select Currency']) }}
                            </div>
                        </div>
                    </div>

                    <div class="card-header border-0" data-bs-toggle="collapse" aria-expanded="true"
                         aria-controls="kt_account_profile_details">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0 required">{{__('messages.appointment.payment_method')}}
                            </h3>
                        </div>
                    </div>

                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <tbody class="text-gray-600 fw-bold d-flex flex-wrap">
                                    @foreach($paymentGateways as $key => $paymentGateway)
                                        <tr class="w-md-50 w-100 d-flex justify-content-between border-0">
                                            <td>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="{{$key}}"
                                                           name="payment_gateway[]"
                                                           id="{{$key}}" {{in_array($paymentGateway, $selectedPaymentGateways) ?'checked':''}} />
                                                    <label class="form-check-label" for="{{$key}}">
                                                        {{$paymentGateway}}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer d-flex py-6 px-9">
                        {{ Form::submit(__('messages.user.save_changes'),['class' => 'btn btn-primary']) }}
                    </div>
                    {{ Form::close() }}
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
        let countryId = false;
        let isEdit = false;
        let utilsScript = "{{asset('assets/js/intl/js/utils.min.js')}}";
        let phoneNo = "{{ ($setting['region_code']).($setting['contact_no']) }}";
    </script>
    <script src="{{ asset('assets/js/custom/phone-number-country-code.js') }}"></script>
    <script src="{{mix('assets/js/settings/settings.js')}}"></script>
@endsection
