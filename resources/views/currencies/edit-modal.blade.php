<div class="modal show fade" id="editCurrencyModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">{{__('messages.currency.edit_currency')}}</h2>
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
                <form id="editCurrencyForm" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    @csrf
                    @method('POST')
                    {{ Form::hidden('id',null,['id' => 'currencyID']) }}
                    <div class="alert alert-danger d-none" id="editCurrencyValidationErrorsBox"></div>
                    <div class="d-flex flex-column scroll-y me-n7 pe-7"
                         data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                         data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                         data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"
                    {{ $styleCss }}="max-height: 317px;">
                    <div class="row gx-10">
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            {{ Form::label('currency_name', __('messages.common.name').':', ['class' => 'required fw-bold fs-6 mb-2']) }}
                            {{ Form::text('currency_name', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' =>                                        'Currency Name', 'required','id'=>'editCurrency_Name']) }}
                        </div>
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            {{ Form::label('currency_icon',__('messages.currency.currency_icon').':', ['class' => 'required fw-bold fs-6 mb-2']) }}
                            {{ Form::text('currency_icon', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' =>                                        'Currency Icon', 'required','id'=>'editCurrency_Icon']) }}
                        </div>
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            {{ Form::label('currency_code', __('messages.currency.currency_code').':', 
                                ['class' => 'required fw-bold fs-6 mb-2']) }}
                            {{ Form::text('currency_code', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' =>                                        'Currency Code', 'required','id'=>'editCurrency_Code']) }}
                            <div class="text-muted">
                                {{ __('messages.currency.note') }}
                                : {{ __('messages.currency.add_currency_code_as_per_three_letter_iso_code') }}.<a
                                        href="//stripe.com/docs/currencies"
                                        target="_blank">{{ __('messages.currency.you_can_find_out_here') }}.</a>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3">
                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
                        {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-light btn-active-light-primary'
                                ,'data-bs-dismiss'=>'modal']) }}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
