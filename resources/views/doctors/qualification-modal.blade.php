<div class="modal show fade" id="qualificationModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">{{__('messages.doctor.add_qualification')}}</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000,                                      4.000000)"
                               fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16"
                                      height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2"
                                      rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
            @php
                $styleCss = 'style';
            @endphp
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                {{ Form::open(['id' => 'qualificationForm']) }}
                {{ Form::hidden('id',null,['id' => 'qualificationID']) }}
                <div class="alert alert-danger d-none" id="createCityValidationErrorsBox"></div>
                <div class="d-flex flex-column scroll-y me-n7 pe-7"
                     data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                     data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                     data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"
                {{ $styleCss }}="max-height: 317px;">
                <div class="row gx-10 mb-5">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        {{ Form::label('Degree', __('messages.doctor.degree').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('degree', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Degree', 'id'=>'degree']) }}
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        {{ Form::label('university', __('messages.doctor.university').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('university', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'University', 'id'=>'university']) }}
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                            {{ Form::label('Degree', __('messages.doctor.year').':', ['class' => 'form-label required fs-6 
                                    fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('year', $years,!empty($qualifications->year) ? $qualifications->year : null, 
        ['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id'=> 'year', 'placeholder' => 'Select Year','data-dropdown-parent'=>'#qualificationModal']) }}
                        </div>
                    </div>
                </div>
                <div class="pt-3">
                    {{ Form::submit(__('messages.common.save'),
                        ['class' => 'btn btn-primary me-2']) }}
                    {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-light btn-active-light-primary','data-bs-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
