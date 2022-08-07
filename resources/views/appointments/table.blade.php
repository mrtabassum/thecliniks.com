<table class="table table-responsive-sm align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100 whitespace-nowrap"
       id="appointmentsTable">
    <thead>
    @if(getLogInUser()->hasRole('patient'))
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th>{{__('messages.doctor.doctor')}}</th>
            <th>{{__('messages.appointment.appointment_at')}}</th>
            <th>{{__('messages.appointment.service_charge')}}</th>
            <th>{{__('messages.appointment.payment')}}</th>
            <th>{{__('messages.doctor.status')}}</th>
            <th>{{__('messages.common.action')}}</th>
        </tr>
    @else
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-100px">{{__('messages.doctor.doctor')}}</th>
            <th class="min-w-100px">{{__('messages.appointment.patient')}}</th>
            <th class="min-w-100px">{{__('messages.appointment.appointment_at')}}</th>
            <th class="min-w-100px">{{__('messages.appointment.payment')}}</th>
            <th class="min-w-100px">{{__('messages.doctor.status')}}</th>
            <th class="min-w-100px">{{__('messages.common.action')}}</th>
        </tr>
    @endif
    </thead>
    <tbody class="text-gray-600 fw-bold">
    </tbody>
</table>
