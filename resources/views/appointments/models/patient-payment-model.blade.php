<div class="modal show fade" id="paymentGatewayModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">{{__('messages.appointment.Select_payment_method')}}</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000)
                                    translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2"
                                      rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 mb-6">
                {{ Form::open(['id' => 'patientPaymentForm'])}}
                {{ Form::hidden('patientAppointmentId',null,['id'=>'patientAppointmentId']) }}
                <div class="alert alert-danger d-none" id="editPasswordValidationErrorsBox"></div>
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                     data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                     data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                     data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                    <div class="fv-row fv-plugins-icon-container">
                        <div class="mb-5">
                            {{ Form::select('payment_gateway', $paymentGateway, null, ['id' => 'paymentGatewayType',
                            'class' => 'form-select form-select-solid','data-dropdown-parent'=>'#paymentGatewayModal',
                            'required','data-control'=>"select2", 'placeholder' => 'Select payment method']) }}
                        </div>
                    </div>
                </div>
                <div class="pt-5">
                    <div class="d-flex">
                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2','id'=>'submitBtn']) }}
                        {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-light btn-active-light-primary','data-bs-dismiss'=>'modal']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
