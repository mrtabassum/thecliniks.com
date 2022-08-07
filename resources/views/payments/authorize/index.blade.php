<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../../">
    <title>{{ getAppName() }}</title>
    <link rel="icon" href="{{ asset(getAppFavicon()) }}" type="image/png">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme"/>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    @yield('css_before')
    <link href="{{ asset('backend/css/vendor.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/fonts.css') }}" rel="stylesheet" type="text/css"/>
    @yield('page_css')
    <link href="{{ asset('backend/css/3rd-party.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/3rd-party-custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body id="kt_body" class="bg-body">
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column"
         id="kt_create_account_stepper">
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-700px p-10 p-lg-15 mx-auto">
                    <form id="frmContact" method="post"
                          action="{{ route('authorize.onboard',[ 'appointmentId' => $appointment->id]) }}"
                          novalidate="novalidate" class="my-auto pb-5">
                        @csrf
                        <div class="" data-kt-stepper-element="content">
                            <div class="w-100">
                                <div class="pb-10 pb-lg-15">
                                    <h2 class="fw-bolder text-dark">Billing Details</h2>
                                    <div class="text-muted fw-bold fs-6">
                                        Payment for booking appointment with doctor :
                                        {{$doctorName->user->full_name}} at
                                        {{\Carbon\Carbon::parse($appointment->date)->format('d/m/Y')}} {{$appointment->from_time}}
                                        {{$appointment->from_time_type}} to {{$appointment->to_time}}
                                        {{$appointment->to_time_type}}
                                    </div>
                                </div>
                                @if(session('success_msg'))
                                    <div class="alert alert-success fade in alert-dismissible show">
                                        {{ session('success_msg') }}
                                    </div>
                                @endif
                                @if(session('error_msg'))
                                    <div class="alert alert-danger fade in alert-dismissible show">
                                        {{ session('error_msg') }}
                                    </div>
                                @endif
                                <div class="alert alert-danger fade in alert-dismissible" id="errorCard">
                                    <ul id="errorMessage" class="mb-0">
                                        <li class="error"></li>
                                    </ul>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Name On Card</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" id="cardHolderName"
                                           name="owner"
                                           value="{{ old('owner') }}" placeholder="Enter card holder name" required>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="required fs-6 fw-bold form-label mb-2">Card Number</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control form-control-solid demoInputBox"
                                               id="cardNumber"
                                               name="cardNumber" value="{{ old('cardNumber') }}"
                                               placeholder="Enter card number" required="required">
                                        <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                            <img src="{{ asset('assets/front/images/payment_images/visa.svg') }}" alt=""
                                                 class="h-25px"/>
                                            <img src="{{ asset('assets/front/images/payment_images/mastercard.svg') }}"
                                                 alt="" class="h-25px"/>
                                            <img src="{{ asset('web/media/svg/payment-methods/americanexpress.svg') }}"
                                                 alt="" class="h-25px"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-md-8 fv-row">
                                        <label class="required fs-6 fw-bold form-label mb-2">Expiration Date</label>
                                        <div class="row fv-row">
                                            <div class="col-6">
                                                <select name="expiration-month"
                                                        class="form-select form-select-solid demoSelectBox"
                                                        data-control="select2" data-hide-search="true"
                                                        data-placeholder="Select month" id="expiryMonth" required>
                                                    <option></option>
                                                    @foreach($months as $k=>$v)
                                                        <option value="{{ $k }}" {{ old('expiration-month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <select name="expiration-year" class="form-select form-select-solid"
                                                        data-control="select2" data-hide-search="true"
                                                        data-placeholder="Select year" id="expiryYear" required>
                                                    <option></option>
                                                    @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span class="required">CVV</span>
                                        </label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control form-control-solid demoInputBox"
                                                   minlength="3"
                                                   maxlength="4" placeholder="CVV" name="cvv" value="{{ old('cvv') }}"
                                                   id="cvv"/>
                                            <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                                <span class="svg-icon svg-icon-2hx">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<path d="M22 7H2V11H22V7Z" fill="black"/>
																<path opacity="0.3"
                                                                      d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z"
                                                                      fill="black"/>
															</svg>
														</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6">Payment
                                        : {{$appointment->payable_amount}} {{getCurrencyCode()}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-stack pt-7">
                            <div class="mr-2">
                                <a href="{{route('authorize.failed')}}">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3"
                                            data-kt-stepper-action="previous">
                                    <span class="svg-icon svg-icon-4 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1"
                                                      fill="black"></rect>
												<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                                      fill="black"></path>
											</svg>
										</span>
                                        Cancel
                                    </button>
                                </a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary" id="submitBtn"
                                        data-kt-stepper-action="submit">
											<span class="indicator-label">Submit
											<span class="svg-icon svg-icon-4 ms-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                                          transform="rotate(-180 18 13)" fill="black"/>
													<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                          fill="black"/>
												</svg>
											</span>
                                        </span>
                                    <span class="indicator-progress">Please wait...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('web/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ mix('assets/js/custom/create-account.js') }}"></script>
</body>
</html>
