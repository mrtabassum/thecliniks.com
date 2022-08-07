<table class="table table-responsive-sm align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100 whitespace-nowrap"
       id="transactionsTable">
    <thead>
    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
        @if(!getLogInUser()->hasRole('patient'))
            <th>{{ __('messages.appointment.patient') }}</th>
        @endif
        <th>{{ __('messages.appointment.date') }}</th>
        <th>{{ __('messages.appointment.payment_method') }}</th>
        <th>{{ __('messages.doctor_appointment.amount') }}</th>
        <th class="text-end min-w-100px">{{ __('messages.common.action') }}</th>
    </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
    </tbody>
</table>
