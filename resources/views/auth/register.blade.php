@extends('layouts.auth')
@section('title')
    {{__('messages.register')}}
@endsection
@section('content')
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

        <a href="{{ route('medical') }}" class="mb-5">
            <img alt="Logo" src="{{ asset(getAppLogo()) }}" class="h-70px logo">
        </a>

        <div class="w-lg-600px">
            @include('layouts.errors')
            <div class=" bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">

                <form class="form w-100" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-10 text-center">
                        <h1 class="text-dark mb-3">{{__('messages.web.patient_registration')}}</h1>

                        <div class="text-gray-400 fw-bold fs-4 d-sm-block d-grid">{{__('messages.web.already_have_an_account')}}?
                            <a href="{{ route('login') }}"
                               class="link-primary fw-bolder">{{__('messages.web.sign_in_here')}}</a></div>

                    </div>

                    <div class="row fv-row mb-7">

                        <!-- Name -->
                        <div class="col-xl-6 mb-7 mb-xl-0">
                            <label class="form-label fw-bolder text-dark fs-6 required"
                                   for="name">{{ __('messages.patient.first_name') }}:</label>
                            <input class="form-control form-control-lg form-control-solid" id="name"
                                   placeholder="First Name"
                                   value="{{ old('first_name') }}" type="text" name="first_name" autocomplete="off"
                                   required
                                   autofocus/>
                            <div class="invalid-feedback">
                                {{ $errors->first('first_name') }}
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6 required"
                                   for="last_name">{{ __('messages.patient.last_name') }}:</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                   placeholder="Last Name"
                                   value="{{ old('last_name') }}" name="last_name" autocomplete="off" required
                            />
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        </div>

                    </div>

                    <!-- Email Address -->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6 required"
                               for="email">{{ __('messages.patient.email') }}:</label>
                        <input class="form-control form-control-lg form-control-solid" id="email"
                               value="{{ old('email') }}" placeholder="Email"
                               type="email" name="email" required autocomplete="off"/>
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-10 fv-row" data-kt-password-meter="true">

                        <div class="mb-1">

                            <label class="form-label fw-bolder text-dark fs-6 required"
                                   for="password">{{ __('messages.patient.password') }}:</label>

                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid" id="password"
                                       type="password" required
                                       placeholder="Password" name="password" autocomplete="new-password"/>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
                                <div class="d-flex align-items-center mb-3"
                                     data-kt-password-meter-control="highlight"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <div class="mb-1">
                            <label class="form-label fw-bolder text-dark fs-6 required" for="password">
                                {{ __('messages.patient.confirm_password') }}:</label>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid" type="password" required
                                       placeholder="Confirm Password"
                                       id="password_confirmation" name="password_confirmation" autocomplete="off"/>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
                                <div class="d-flex align-items-center mb-3"
                                     data-kt-password-meter-control="highlight"></div>
                            </div>
                        </div>
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-check form-check-custom form-check-solid form-check-inline">
                            <input class="form-check-input" type="checkbox" name="toc" value="1" required/>
                            <span class="form-check-label fw-bold text-gray-700 fs-6">{{__('messages.web.i_agree')}}
									<a href="{{ route('terms.conditions') }}"
                                       class="ms-1 link-primary">{{__('messages.web.terms_and_conditions')}}</a>.</span>
                        </label>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary">
                            <span class="indicator-label"> {{ __('messages.register') }}</span>
                            <span class="indicator-progress">{{__('messages.common.please_wait')}}
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!--end::Main-->
@endsection
