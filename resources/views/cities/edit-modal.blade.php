<div class="modal show fade" id="editCityModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">{{__('messages.city.edit_city')}}</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 mb-6">
                {{ Form::open(['id' => 'editCityForm']) }}
                {{ Form::hidden('id',null,['id' => 'cityID']) }}
                <div class="alert alert-danger d-none" id="editCityValidationErrorsBox"></div>
                <div class="d-flex flex-column scroll-y me-n7 pe-7"
                     data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                     data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                     data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"
                {{ $styleCss }}="max-height: 317px;">
                <div class="row gx-10">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        {{ Form::label('name', __('messages.common.name').':', ['class' => 'required fw-bold fs-6 mb-2']) }}
                        {{ Form::text('name', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'Name',                                         'required','id'=>'editName']) }}
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        {{ Form::label('state_id', __('messages.city.state').':', ['class' => 'required fw-bold fs-6 mb-2']) }}
                        {{ Form::select('state_id', $states, null, ['id' => 'editStateId','data-dropdown-parent'=>'#editCityModal',
                        'class' => 'form-select form-select-solid form-select-lg fw-bold', 'aria-label'=>"Select a State",
                        'required','data-control'=>"select2"]) }}
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="pt-3">
                    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
                    {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-light btn-active-light-primary','data-bs-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
