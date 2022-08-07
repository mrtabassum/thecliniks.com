<div class="col-12">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body  border-top p-9">
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.appointment_unique_id') }}</label>
                        <div class="col-lg-8 fv-row">
                            <span class="badge badge-light-warning">{{$transaction['data']->appointment_id}}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">{{ __('messages.transaction.transaction_id') }}</label>
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bolder fs-6 text-gray-800">{{$transaction['data']->transaction_id}}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor_appointment.amount') }}</label>
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bolder fs-6 text-gray-800">{{ getCurrencyIcon() }} {{number_format($transaction['data']->amount)}}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.payment_method') }}</label>
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bolder fs-6 text-gray-800">{{\App\Models\Appointment::PAYMENT_METHOD[$transaction['data']['type']]}}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.appointment_at') }}</label>
                        <div class="col-lg-8 fv-row">
                                                            <span class="badge badge-light-info">
                                    {{ \Carbon\Carbon::parse($transaction['data']->appointment['date'])->format('jS M, Y')}} {{$transaction['data']->appointment['from_time']}} {{$transaction['data']->appointment['from_time_type']}} - {{$transaction['data']->appointment['to_time']}} {{$transaction['data']->appointment['to_time_type']}}
                                </span>
                        </div>
                    </div>
                    @if(!getLogInUser()->hasRole('patient'))
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.patient') }}</label>
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bolder fs-6 text-gray-800">{{$transaction['data']->user->full_name}}</span>
                        </div>
                    </div>
                    @endif
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor.doctor') }}</label>
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bolder fs-6 text-gray-800">{{$transaction['data']->appointment->doctor->user->full_name}}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">{{ __('messages.transaction.payment_status') }}</label>
                        <div class="col-lg-8 fv-row">
                            <span class="badge badge-light-success">{{ __('messages.transaction.paid') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

