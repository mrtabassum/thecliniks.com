@extends('layouts.app')
@section('title')
    {{__('messages.services')}}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                <div class="card-header d-flex border-0 pt-6">
                    @include('layouts.search-component')
                    <div class="card-toolbar ms-auto">
                        <div class="me-4 dropdown">
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
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                 id="filter">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bolder">{{__('messages.common.filter_option')}}</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <div class="px-7 py-5">
                                    <div class="mb-10">
                                        <label class="form-label fw-bold">{{__('messages.service.status')}}</label>
                                        <div>
                                            {{ Form::select('status', $status, \App\Models\Service::STATUS, ['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'servicesStatus']) }}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" id="resetFilter"
                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true">{{__('messages.common.reset')}}</button>
                                        <button type="submit" class="btn btn-sm btn-primary"
                                                data-kt-menu-dismiss="true">{{__('messages.common.apply')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a type="button" class="btn btn-primary" href="{{ route('services.create')}}">
                                <span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1">
														<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
														<rect fill="#000000" opacity="0.5"
                                                              transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)"
                                                              x="4" y="11" width="16" height="2" rx="1"/>
													</svg>
												</span>
                                {{__('messages.service.add_service')}}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('services.table')
                    @include('layouts.templates.actions')
                    @include('services.templates.templates')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        let all = '{{ \App\Models\Service::ALL }}';
        let active = '{{ \App\Models\Service::ACTIVE }}';
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/services/services.js')}}"></script>
@endsection
