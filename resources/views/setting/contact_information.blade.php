@extends('layouts.app')
@section('title')
    {{$setting['clinic_name']}}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            @include('setting.setting_menu')
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                     aria-expanded="true"
                     aria-controls="kt_account_profile_details">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.setting.contact_information')}}</h3>
                    </div>
                </div>
                <div id="kt_account_profile_details" class="collapse show">
                    {{ Form::open(['route' => 'setting.update', 'files' => true, 'id'=>'kt_account_profile_details_form','class'=>'form']) }}
                    {{ Form::hidden('sectionName', $sectionName) }}
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            {{ Form::label('address_one',__('messages.setting.address').' 1:',['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) }}
                            <div class="col-lg-8 fv-row">
                                {{ Form::text('address_one', $setting['address_one'], ['class' => 'form-control form-control-lg                                                          form-control-solid','placeholder'=>'Address 1','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            {{ Form::label('address_two',__('messages.setting.address').' 2:',['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) }}
                            <div class="col-lg-8 fv-row">
                                {{ Form::text('address_two', $setting['address_two'], ['class' => 'form-control form-control-lg                                                          form-control-solid','placeholder'=>'Address 2','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                {{ Form::label('country_id',__('messages.country.country').':',['class'=>'col-lg-4 col-form-label required fw-bold                                       fs-6']) }}
                            </label>
                            <div class="col-lg-8 fv-row">
                                {{ Form::select('country_id', $countries, $setting['country_id'], ['id' => 'countryId',
                                        'class' => 'form-select form-select-solid form-select-lg fw-bold', 'aria-label'=>"Select a Country",
                                        'data-control'=>'select2','placeholder' => 'Select Country','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                {{ Form::label('state_id',__('messages.common.state').':',['class'=>'col-lg-4 col-form-label required fw-bold                                       fs-6']) }}
                            </label>
                            <div class="col-lg-8 fv-row">
                                {{ Form::select('state_id', (isset($states) && $states!=null ? $states : []),
            isset($setting['state_id']) ? $setting['state_id'] : null,
            ['id' => 'stateId','class' => 'form-select form-select-solid form-select-lg fw-bold','data-control'=>'select2','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                {{ Form::label('city_id',__('messages.city.city').':',['class'=>'col-lg-4 col-form-label required fw-bold                                       fs-6']) }}
                            </label>
                            <div class="col-lg-8 fv-row">
                                {{ Form::select('city_id', (isset($cities) && $cities!=null ? $cities : []),
            isset($setting['city_id']) ? $setting['city_id'] : null,
            ['id' => 'cityId','class' => 'form-select form-select-solid form-select-lg fw-bold','data-control'=>'select2','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            {{ Form::label('postal_code',__('messages.setting.postal_code').':',['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) }}
                            <div class="col-lg-8 fv-row">
                                {{ Form::text('postal_code', $setting['postal_code'], ['class' => 'form-control form-control-lg form-control-solid','placeholder'=>'Postal code','required']) }}
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
    <script>
        let isEdit = true;
        let countryId = "{{$setting['country_id']}}";
        let stateId = "{{$setting['state_id']}}";
        let cityId = "{{$setting['city_id']}}";
    </script>
    <script src="{{mix('assets/js/settings/settings.js')}}"></script>
@endsection
