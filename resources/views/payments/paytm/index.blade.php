<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../../">
    <title>paytm</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
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
                    <form action="{{ route('make.payment',['appointmentId' => $appointmentId]) }}" method="POST"
                          enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="" data-kt-stepper-element="content">
                            <div class="w-100">
                                <div class="pb-10 pb-lg-15">
                                    <h2 class="fw-bolder text-dark">Payment detail</h2>
                                    <div class="text-muted fw-bold fs-6">
                                        Payment for booking appointment with doctor :
                                        {{$doctor->user->full_name}} at
                                        {{\Carbon\Carbon::parse($appointment->date)->format('d/m/Y')}} {{$appointment->from_time}}
                                        {{$appointment->from_time_type}} to {{$appointment->to_time}}
                                        {{$appointment->to_time_type}}
                                    </div>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <span>{{$errors->first()}}</span>
                                    </div>
                                @endif
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
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Name</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="name"
                                           value="{{ $patient->user->full_name }}" placeholder="Enter name" required
                                           readonly>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Email</span>
                                    </label>
                                    <input type="email" class="form-control form-control-solid" name="email"
                                           value="{{ $patient->user->email }}" placeholder="Enter email" required
                                           readonly>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Mobile No</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="mobile"
                                           value="{{ ($patient->user->contact) ? $patient->user->contact : '' }}"
                                           placeholder="Mobile No" required>
                                </div>
                                Payment : {{$appointment->payable_amount}} Rs/-
                            </div>
                        </div>
                        <div class="d-flex flex-stack pt-15">
                            <div class="mr-2">
                                <a href="{{route('paytm.failed')}}">
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
                                <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
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
</body>
</html>
