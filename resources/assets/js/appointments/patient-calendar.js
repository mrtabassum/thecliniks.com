'use strict';

let popover;
let popoverState = false;
let calendar;
let data = {
    id: '',
    uId: '',
    eventName: '',
    eventDescription: '',
    eventStatus: '',
    startDate: '',
    endDate: '',
    amount: 0,
    service: '',
    doctorName: '',
};

// View event variables
let viewEventName, viewEventDescription, viewEventStatus, viewStartDate,
    viewEndDate,
    viewModal,
    viewEditButton,
    viewDeleteButton,
    viewService,
    viewUId,
    viewAmount;

$(document).ready(function () {
    initCalendarApp();
    init();
});

const initCalendarApp = function () {
    let calendarEl = document.getElementById('appointmentCalendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,
        editable: false,
        dayMaxEvents: true,
        displayEventTime: false,
        buttonText: {
            month: 'Month',
        },
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth',
        },
        events: function (info, successCallback, failureCallback) {
            $.ajax({
                url: route('patients.appointments.calendar'),
                type: 'GET',
                data: info,
                success: function (result) {
                    if (result.success) {
                        successCallback(result.data);
                    }
                },
                error: function (result) {
                    displayErrorMessage(result.responseJSON.message);
                    failureCallback();
                },
            });
        },
        // MouseEnter event --- more info: https://fullcalendar.io/docs/eventMouseEnter
        eventMouseEnter: function (arg) {
            formatArgs({
                id: arg.event.id,
                title: arg.event.title,
                startStr: arg.event.startStr,
                endStr: arg.event.endStr,
                description: arg.event.extendedProps.description,
                status: arg.event.extendedProps.status,
                amount: arg.event.extendedProps.amount,
                uId: arg.event.extendedProps.uId,
                service: arg.event.extendedProps.service,
                doctorName: arg.event.extendedProps.doctorName,
            });

            // Show popover preview
            initPopovers(arg.el);
        },
        eventMouseLeave: function () {
            hidePopovers();
        },
        // Click event --- more info: https://fullcalendar.io/docs/eventClick
        eventClick: function (arg) {
            hidePopovers();
            formatArgs({
                id: arg.event.id,
                title: arg.event.title,
                startStr: arg.event.startStr,
                endStr: arg.event.endStr,
                description: arg.event.extendedProps.description,
                status: arg.event.extendedProps.status,
                amount: arg.event.extendedProps.amount,
                uId: arg.event.extendedProps.uId,
                service: arg.event.extendedProps.service,
                doctorName: arg.event.extendedProps.doctorName,
            });
            handleViewEvent();
        },
    });
    calendar.render();
};

const init = () => {
    const viewElement = document.getElementById('patientEventModal');
    viewModal = new bootstrap.Modal(viewElement);
    viewEventName = viewElement.querySelector(
        '[data-kt-calendar="event_name"]');
    viewEventDescription = viewElement.querySelector(
        '[data-kt-calendar="event_description"]');
    viewEventStatus = viewElement.querySelector(
        '[data-kt-calendar="event_status"]');
    viewAmount = viewElement.querySelector('[data-kt-calendar="event_amount"]');
    viewUId = viewElement.querySelector('[data-kt-calendar="event_uId"]');
    viewService = viewElement.querySelector(
        '[data-kt-calendar="event_service"]');
    viewStartDate = viewElement.querySelector(
        '[data-kt-calendar="event_start_date"]');
    viewEndDate = viewElement.querySelector(
        '[data-kt-calendar="event_end_date"]');
    viewEditButton = viewElement.querySelector('#kt_modal_view_event_edit');
    viewDeleteButton = viewElement.querySelector('#kt_modal_view_event_delete');
};

// Format FullCalendar responses
const formatArgs = (res) => {
    data.id = res.id;
    data.eventName = res.title;
    data.eventDescription = res.description;
    data.eventStatus = res.status;
    data.startDate = res.startStr;
    data.endDate = res.endStr;
    data.amount = res.amount;
    data.uId = res.uId;
    data.service = res.service;
    data.doctorName = res.doctorName;
};

// Initialize popovers --- more info: https://getbootstrap.com/docs/4.0/components/popovers/
const initPopovers = (element) => {
    hidePopovers();

    // Generate popover content
    const startDate = data.allDay ? moment(data.startDate).
        format('Do MMM, YYYY') : moment(data.startDate).
        format('Do MMM, YYYY - h:mm a');
    const endDate = data.allDay
        ? moment(data.endDate).format('Do MMM, YYYY')
        : moment(data.endDate).format('Do MMM, YYYY - h:mm a');
    const popoverHtml = '<div class="fw-bolder mb-2"><b>Doctor</b>: ' +
        data.doctorName +
        '</div><div class="fs-7"><span class="fw-bold">Start:</span> ' +
        startDate +
        '</div><div class="fs-7 mb-4"><span class="fw-bold">End:</span> ' +
        endDate + '</div>';

    // Popover options
    let options = {
        container: 'body',
        trigger: 'manual',
        boundary: 'window',
        placement: 'auto',
        dismiss: true,
        html: true,
        title: 'Appointment Details',
        content: popoverHtml,
    };

    // Initialize popover
    popover = KTApp.initBootstrapPopover(element, options);

    // Show popover
    popover.show();

    // Update popover state
    popoverState = true;

    // Open view event modal
    // handleViewButton();
};

// Hide active popovers
const hidePopovers = () => {
    if (popoverState) {
        popover.dispose();
        popoverState = false;
    }
};

// Handle view button
const handleViewButton = () => {
    const viewButton = document.querySelector('#kt_calendar_event_view_button');
    viewButton.addEventListener('click', e => {
        e.preventDefault();
        hidePopovers();
        handleViewEvent();
    });
};

// Handle view event
const handleViewEvent = () => {
    $('.fc-popover').addClass('hide');
    viewModal.show();

    // Detect all day event
    let eventNameMod;
    let startDateMod;
    let endDateMod;

    eventNameMod = '';
    startDateMod = moment(data.startDate).format('Do MMM, YYYY - h:mm a');
    endDateMod = moment(data.endDate).format('Do MMM, YYYY - h:mm a');
    viewEndDate.innerText = ': ' + endDateMod;
    viewStartDate.innerText = ': ' + startDateMod;

    // Populate view data
    viewEventName.innerText = 'Doctor: ' + data.doctorName;
    $(viewEventStatus).val(data.eventStatus);
    viewAmount.innerText = addCommas(data.amount);
    viewUId.innerText = data.uId;
    viewService.innerText = data.service;
};
