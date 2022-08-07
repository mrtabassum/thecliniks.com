<div class="modal fade event-modal" id="doctorAppointmentCalendarModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">{{__('messages.appointment.appointment_details')}}</h2>
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="d-flex">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user-injured fs-3 me-3"></i>
                            <span class="fs-3 fw-bolder me-3" data-kt-calendar="event_name"></span>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="svg-icon svg-icon-1 svg-icon-success me-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                       height="24px" viewBox="0 0 24 24" version="1.1">
                     <circle fill="#000000" cx="12" cy="12" r="8"/>
                  </svg>
               </span>
                    <div class="fs-6">
                        <span class="fw-bolder">{{__('messages.appointment.starts')}}</span>
                        <span data-kt-calendar="event_start_date"></span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-9">
                    <span class="svg-icon svg-icon-1 svg-icon-danger me-5">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1">
                         <circle fill="#000000" cx="12" cy="12" r="8"/>
                      </svg>
                   </span>
                    <div class="fs-6">
                        <span class="fw-bolder">{{__('messages.appointment.ends')}}</span>
                        <span data-kt-calendar="event_end_date"></span>
                    </div>
                </div>
                @php
                    $styleCss = 'style';
                @endphp
                <div class="d-flex align-items-center">
                    <label for="" {{ $styleCss }}="width: 125px">{{__('messages.appointment.appointment_unique_id')}}
                    :</label>
                    <div class="fs-6 fw-bold ms-3"><span class="ms-1" data-kt-calendar="event_uId"></span></div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <label for="" {{ $styleCss }}="width: 125px">{{__('messages.appointment.service')}}:</label>
                    <div class="fs-6 fw-bold ms-3"><span class="ms-1" data-kt-calendar="event_service"></span></div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <label for="" {{ $styleCss }}="width: 125px">{{__('messages.appointment.payable_amount')}}:</label>
                    <div class="fs-6 fw-bold ms-3"><span>$</span><span class="ms-1"
                                                                       data-kt-calendar="event_amount"></span></div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <label for="" {{ $styleCss }}="width: 170px">{{__('messages.appointment.status')}}:</label>
                    <select class="form-select-sm form-select-solid form-select status-change" data-control="select2"
                            data-kt-calendar="event_status" data-minimum-results-for-search="Infinity">
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
