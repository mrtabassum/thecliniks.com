@php $styleCss = 'style'; @endphp
<div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
    <div class="card mb-5 mb-xl-8">
        <div class="card-body pt-0 pt-lg-1">
            <div class="card">
                <div class="card-body d-flex flex-center flex-column pt-12 p-9 px-0">
                    <div class="symbol symbol-100px symbol-circle mb-7">
                        <img src="{{ $visit->visitPatient->profile }}" class="object-cover" alt="image"/>
                    </div>
                    <a href="{{ getLogInUser()->hasRole('doctor') ?  url('doctors/patients/'.$visit->visitPatient->id) :  route('patients.show', $visit->visitPatient->id) }}"
                       class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $visit->visitPatient->user->full_name }}</a>
                    <span>{{ $visit->visitPatient->user->email }}</span>
                </div>
            </div>
            <div class="separator"></div>
            <div id="kt_user_view_details" class="collapse show">
                <div class="pb-5 fs-6">
                    <div class="fw-bolder mt-5">{{__('messages.visit.visit_date')}}</div>
                    <div class="text-gray-600">{{\Carbon\Carbon::parse($visit->visit_date)->format('jS M Y')}}</div>
                    @if(!getLogInUser()->hasRole('doctor'))
                        <div class="fw-bolder mt-5">{{__('messages.visit.doctor')}}</div>
                        <div class="text-gray-600">{{$visit->visitDoctor->user->full_name }}</div>
                    @endif
                    <div class="fw-bolder mt-5">{{__('messages.visit.description')}}</div>
                    <div class="text-gray-600 mh-150px overflow-auto">{{!empty($visit->description) ? $visit->description : 'N/A'}}</div>
                    <div class="fw-bolder mt-5">{{__('messages.doctor.created_at')}}</div>
                    <span class="text-gray-600" data-bs-toggle="tooltip" data-bs-placement="right"
                          title="{{\Carbon\Carbon::parse($visit->created_at)->format('jS M Y')}}">{{$visit->created_at->diffForHumans()}}</span>
                    <div class="fw-bolder mt-5">{{__('messages.doctor.created_at')}}</div>
                    <span class="text-gray-600" data-bs-toggle="tooltip" data-bs-placement="right"
                          title="{{\Carbon\Carbon::parse($visit->updated_at)->format('jS M Y')}}">{{$visit->updated_at->diffForHumans()}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex-lg-row-fluid ms-xl-14">
    <!--begin:::Tabs-->
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
               href="#problesTab">{{ __('messages.visit.problems') }}</a>
        </li>
        <!--end:::Tab item-->
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab"
               href="#observationsTab">{{ __('messages.visit.observations') }}</a>
        </li>
        <!--end:::Tab item-->
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
               href="#notesTab">{{ __('messages.visit.notes') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
               href="#prescriptionsTab">{{ __('messages.visit.prescriptions') }}</a>
        </li>
    </ul>
    <!--end:::Tabs-->
    <!--begin:::Tab content-->
    <div class="tab-content" id="myTabContent">
        <!--begin:::Tab pane-->
        <div class="tab-pane fade active show" id="problesTab" role="tabpanel">
            <!--begin::Card-->
            <div class="card card-flush mb-6 mb-xl-9">
                <div class="card-header align-items-center">
                    <h3 class="align-left m-0">{{ __('messages.visit.problems') }}</h3>
                </div>
                <div class="card-body pt-4">
                    @php $problemRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.problem' : 'add.problem'  @endphp
                    {{ Form::open(['route' => $problemRoute, 'id' => 'addVisitProblem']) }}
                    <div class="p-0 visit-detail-card">
                        <div class="px-2">
                            <div class="col-md-12">
                                <ul class="list-group list-group-flush problem-list" id="problemLists">
                                    @if(!empty($visit))
                                        @forelse($visit->problems as $val)
                                            <li class="list-group-item text-wrap text-break d-flex justify-content-between align-items-center py-5">{{ $val->problem_name }}
                                                <span class="remove-problem" data-id="{{ $val->id }}" title="Delete">
                                                    <a href="javascript:void(0)"><i
                                                                class="fas fa-trash text-danger"></i></a>
                                                        </span>
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                {{ Form::hidden('visit_id',$visit->id) }}
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <label for="title"
                                               class="sr-only">{{ __('messages.common.title') }}</label>
                                        {{ Form::text('problem_name', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Enter problem','id' => 'problemName','required']) }}
                                    </div>
                                </div>
                                <div class="col-md-12 text-center mt-3">
                                    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary','id'=> 'problemSubmitBtn']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end:::Tab pane-->
        <!--begin:::Tab pane-->
        <div class="tab-pane fade" id="observationsTab" role="tabpanel">
            <!--begin::Card-->
            <div class="tab-pane fade active show" id="observationsTab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <div class="card-header align-items-center">
                        <h3 class="align-left m-0">{{ __('messages.visit.observations') }}</h3>
                    </div>
                    <div class="card-body p-9 pt-4">
                        @php $observationRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.observation' : 'add.observation' @endphp
                        {{  Form::open(['route' => $observationRoute, 'id' => 'addVisitObservation']) }}
                        <div class="p-0 visit-detail-card">
                            <div class="px-2">
                                <ul class="list-group list-group-flush problem-list" id="observationLists">
                                    @if(!empty($visit))
                                        @forelse($visit->observations as $val)
                                            <li class="list-group-item d-flex text-wrap text-break justify-content-between align-items-center py-5">{{ $val->observation_name }}
                                                <span class="remove-observation" data-id="{{ $val->id }}"
                                                      title="Delete">
                                                    <a href="javascript:void(0)"><i
                                                                class="fas fa-trash text-danger"></i></a>
                                                        </span>
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    {{ Form::hidden('visit_id',$visit->id) }}
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label for="title"
                                                   class="sr-only">{{ __('messages.visit.title') }}</label>
                                            {{ Form::text('observation_name', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Enter observation', 'id' => 'observationName', 'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary','id'=> 'observationSubmitBtn']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
        <!--begin:::Tab pane-->
        <div class="tab-pane fade" id="notesTab" role="tabpanel">
            <!--begin::Card-->
            <div class="tab-pane fade active show" id="notesTab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <div class="card-header align-items-center">
                        <h3 class="align-left m-0">{{ __('messages.visit.notes') }}</h3>
                    </div>
                    <div class="card-body p-9 pt-4">
                        @php $noteRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.note' : 'add.note' @endphp
                        {{ Form::open(['route' => $noteRoute, 'id' => 'addVisitNote']) }}
                        <div class="p-0 visit-detail-card">
                            <div class="px-2">
                                <ul class="list-group list-group-flush problem-list" id="noteLists">
                                    @if(!empty($visit))
                                        @forelse($visit->notes as $val)
                                            <li class="list-group-item text-wrap text-break d-flex justify-content-between align-items-center py-5">{{ $val->note_name }}
                                                <span class="remove-note" data-id="{{ $val->id }}">
                                                    <a href="javascript:void(0)"><i
                                                                class="fas fa-trash text-danger"></i></a>
                                                        </span>
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    {{ Form::hidden('visit_id',$visit->id) }}
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label for="title"
                                                   class="sr-only">{{ __('messages.visit.title') }}</label>
                                            {{ Form::text('note_name', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Enter note','id' => 'noteName','required']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary','id'=> 'noteSubmitBtn']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
        <!--begin:::Tab pane-->
        <div class="tab-pane fade" id="prescriptionsTab" role="tabpanel">
            <!--begin::Card-->
            <div class="tab-pane fade active show" id="prescriptionsTab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h3 class="align-left m-0">{{ __('messages.visit.prescriptions') }}</h3>
                            <div class="ml-auto d-flex align-items-center">
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                                     href="#addVisitPrescription"
                                     role="button" aria-expanded="false"
                                     aria-controls="addVisitPrescription">
                                    <a href="#" class="btn btn-primary text-right"><i
                                                class="fa fa-plus"></i>{{ __('messages.common.add') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-9 pt-4">
                        @php $prescriptionRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.prescription' : 'add.prescription' @endphp
                        {{ Form::open(['route' => $prescriptionRoute, 'id' => 'addPrescription']) }}
                        <div id="addVisitPrescription" class="collapse">
                            {{ Form::hidden('visit_id',$visit->id) }}
                            <div class="row">
                                {{ Form::hidden('prescription_id',null,['id' => 'prescriptionId']) }}
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('prescription_name', 'Name:', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                                    {{ Form::text('prescription_name', null,['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'Name', 'required', 'id' => 'prescriptionNameId','maxlength'=>121]) }}
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('frequency', 'Frequency:', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                                    {{ Form::text('frequency', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'Frequency', 'required', 'id' => 'frequencyId']) }}
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('duration', 'Duration:', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                                    {{ Form::text('duration', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'Duration','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'required', 'id' => 'durationId']) }}
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('description', 'Description:', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                                    {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'Description','id' => 'descriptionId', 'rows'=> 5]) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-5 mt-5">
                                    <div class="w-100 d-flex justify-content-end">
                                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3','id'=> 'prescriptionSubmitBtn']) }}
                                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                                             href="#addVisitPrescription" role="button"
                                             aria-expanded="false" aria-controls="addVisitPrescription">
                                            {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-light btn-active-light-primary reset-form']) }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                        <div class="overflow-auto">
                            <table class="table align-middle overflow-auto table-row-dashed fs-6 gy-5 mt-5 whitespace-nowrap">
                                <thead>
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th scope="col">{{ __('messages.prescription.name') }}</th>
                                    <th scope="col">{{ __('messages.prescription.frequency') }}</th>
                                    <th scope="col">{{ __('messages.prescription.duration') }}</th>
                                    <th class="text-center" width="20%">{{ __('messages.common.action') }}</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold visit-prescriptions">
                                @if(!empty($visit))
                                    @forelse($visit->prescriptions as $prescription)
                                        <tr id="prescriptionLists">
                                            <td class="text-break text-wrap">{{$prescription->prescription_name}}</td>
                                            <td class="text-break text-wrap">{{$prescription->frequency}}</td>
                                            <td class="text-break text-wrap">{{$prescription->duration}}</td>
                                            <td class="text-center">
                                                <a href="#"
                                                   data-id="{{$prescription->id}}"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-prescription-btn"
                                                   title="Edit">
                                                                <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                     height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
                                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                      fill="#000000" fill-rule="nonzero"
                                                                      transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"/>
                                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                      fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                </svg></span>
                                                </a>
                                                <a href="#" data-id="{{$prescription->id}}"
                                                   class="delete-prescription-btn btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                   title="Delete">
                                                                <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                     height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                   fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                      fill="#000000" fill-rule="nonzero"/>
                                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                      fill="#000000" opacity="0.3"/></g></svg></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="noPrescriptionLists">
                                            <td colspan="5" class="text-center font-text-muted text-gray-600" {{$styleCss}}=
                                            'font-size: 13px'>{{ __('messages.common.no_data_available_in_table') }}</td>
                                        </tr>
                                    @endforelse
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
    </div>
    <!--end:::Tab content-->
</div>


