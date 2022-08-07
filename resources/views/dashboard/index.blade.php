@extends('layouts.app')
@section('title')
    {{__('messages.dashboard')}}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row g-5 gx-xxl-8 justify-content-center">
                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('doctors.index') }}" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-user-md display-4 card-icon text-white"></i></span>
                            <div class="text-inverse-primary fw-bolder card-count fs-2 mb-2 mt-5">{{$data['totalDoctorCount']}}</div>
                            <div class="fw-bold text-inverse-primary fs-7">{{__('messages.admin_dashboard.total_doctor')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('patients.index') }}" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-hospital-user display-4 card-icon text-white hospital-user-dark-mode"></i></span>
                            <div class="text-inverse-dark fw-bolder fs-2 card-count mb-2 mt-5">{{$data['totalPatientCount']}}</div>
                            <div
                                    class="fw-bold text-inverse-dark fs-7">{{__('messages.admin_dashboard.total_patients')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('appointments.index') }}"
                       class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-calendar-alt display-4 card-icon text-white"></i></span>
                            <div class="text-inverse-warning fw-bolder fs-2 card-count mb-2 mt-5">{{$data['todayAppointmentCount']}}</div>
                            <div
                                    class="fw-bold text-inverse-warning fs-7">{{__('messages.admin_dashboard.today_appointments')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('patients.index') }}" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-user-injured display-4 card-icon text-white"></i></span>
                            <div class="text-inverse-info fw-bolder fs-2 mb-2 card-count mt-5">{{$data['totalRegisteredPatientCount']}}</div>
                            <div
                                    class="fw-bold text-inverse-info fs-7">{{__('messages.admin_dashboard.today_registered_patients')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-12">
                    <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.admin_dashboard.recent_patients_registration')}}</span>
                            </h3>
                            <div class="card-toolbar  ms-auto">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 active"
                                           data-bs-toggle="tab" href=""
                                           id="dayData">{{__('messages.admin_dashboard.day')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1"
                                           data-bs-toggle="tab" href=""
                                           id="weekData">{{__('messages.admin_dashboard.week')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1 "
                                           data-bs-toggle="tab" href=""
                                           id="monthData">{{__('messages.admin_dashboard.month')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="month">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                            <thead>
                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="w-25px text-muted mt-1 fw-bold fs-7">{{__('messages.admin_dashboard.name')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7"></th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7">{{__('messages.admin_dashboard.patient_id')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.doctor_dashboard.total_appointments')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.patient.registered_on')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="monthlyReport" class="text-gray-600 fw-bold">
                                            @forelse($data['patients'] as $patient)
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-45px me-2">
                                                            <img src="{{ $patient->profile}}"
                                                                 class="symbol symbol-circle object-cover align-self-center"
                                                                 alt=""/>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('patients.show',$patient->id) }}"
                                                           class="text-primary-800 mb-1 fs-6">{{$patient->user->fullname}}</a>
                                                        <span
                                                                class="text-muted fw-bold d-block">{{$patient->user->email}}</span>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="badge badge-light-success">{{$patient->patient_unique_id}}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge badge-light-danger">{{$patient->appointments_count}}</span>
                                                    </td>
                                                    <td class="text-center text-muted fw-bold">
                                                        <span class="badge badge-light-info">
                                                        {{ \Carbon\Carbon::parse($patient->user->created_at)->format('jS M Y H:i A')}}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="5"
                                                        class="text-center text-muted fw-bold">{{ __('messages.common.no_data_available') }}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="week">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                            <thead>
                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="w-25px text-muted mt-1 fw-bold fs-7">{{__('messages.admin_dashboard.name')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7"></th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7">{{__('messages.admin_dashboard.patient_id')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.doctor_dashboard.total_appointments')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.patient.registered_on')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="weeklyReport" class="text-gray-600 fw-bold">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="day">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                            <thead>
                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="w-25px text-muted mt-1 fw-bold fs-7">{{__('messages.admin_dashboard.name')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7"></th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7">{{__('messages.admin_dashboard.patient_id')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.doctor_dashboard.total_appointments')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.patient.registered_on')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="dailyReport" class="text-gray-600 fw-bold">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <!--begin::Charts Widget 8-->
                    <div class="card card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">{{ __('messages.admin_dashboard.earnings_from_appointments') }} 
                                    ({{ getCurrencyIcon() }} <span class="card-label fw-bolder fs-3 mb-1 me-0 totalEarning"></span>)
                                </span>
                            </h3>
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                
                                <a href="javascript:void(0)" class="btn btn-light fw-bolder me-5 ps-3 pe-2" title="Switch Chart">
                                    <span class="svg-icon svg-icon-1 m-0 text-center" id="changeChart">
                                        <i class="fas fa-chart-area fs-1 fw-boldest chart"></i>
                                    </span>
                                </a>
                                
                                <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks-2.svg-->
                                <a href="javascript:void(0)" class="btn btn-flex btn-light fw-bolder" id="filterBtn"
                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                   data-kt-menu-flip="top-end">
                                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z"
                                                          fill="#000000"/>
												</g>
											</svg>
										</span>{{__('messages.common.filter')}}</a>
                                <!--end::Svg Icon-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                     id="kt_menu_610d484a582a6">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">{{ __('messages.admin_dashboard.filter_options') }}</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-5">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">{{ __('messages.services') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                {{ Form::select('service',$data['servicesArr'],null,['class' => 'form-select form-select-solid','placeholder' => 'Select Service', 'id' => 'serviceId', 'data-control' => 'select2']) }}
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="mb-5">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">{{ __('messages.service_categories') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                {{ Form::select('service',$data['serviceCategoriesArr'],null,['class' => 'form-select form-select-solid','placeholder' => 'Select Category', 'id' => 'serviceCategoryId', 'data-control' => 'select2']) }}
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <!--begin::Input group-->
                                        <div class="mb-5">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">{{ __('messages.doctors') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                {{ Form::select('doctor_id',$data['doctorArr'],null,['class' => 'form-select form-select-solid','placeholder' => 'Select Doctor', 'id' => 'doctorId', 'data-control' => 'select2']) }}
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                    class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true" id="resetBtn">Reset
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true">Apply
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body appointmentChart">
                            <!--begin::Chart-->
                            <div id="appointmentChartId" style="height: 350px" class="card-rounded-bottom"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Charts Widget 8-->
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.templates.templates')
@endsection
@section('page_js')
    <script>
        let appointmentData = JSON.parse('@json($appointmentChartData)');
    </script>
    <script src="{{mix('assets/js/dashboard/dashboard.js')}}"></script>
@endsection
