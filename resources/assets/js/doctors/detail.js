'use strict';

let tableName = '#doctorAppointmentDataTable';
$(document).ready(function () {
    let start = moment().startOf('week');
    let end = moment().endOf('week');
    let filterDate = $('#patientAppointmentDateFilter');

    function cb (start, end) {
        filterDate.html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    }

    filterDate.daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [
                moment().subtract(1, 'days'),
                moment().subtract(1, 'days')],
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [
                moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')],
        },
    }, cb);

    cb(start, end);

    let Url = (doctorRole == true)
        ? route('doctors.doctors.appointment')
        : route('doctors.appointment');
    let tbl = $('#doctorAppointmentDataTable').DataTable({
        deferRender: true,
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [1, 'desc'],
        ajax: {
            url: Url,
            data: function (data) {
                data.status = $('#appointmentStatus').
                    find('option:selected').
                    val();
                data.doctorId = doctorID;
                data.filter_date = filterDate.val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '30%',
            },
            {
                'targets': [1],
                'width': '30%',
            },
            {
                'targets': [2],
                'width': '20%',
            },
            {
                'targets': [3],
                'width': '8%',
                'className': 'text-center pr-0',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.patient.profile}" alt=""
                                 class="w-100 object-cover">
                        </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${(doctorRole == true) ? route(
                        'doctors.patient.detail', row.patient.id) : route(
                        'patients.show', row.patient.id)}"
                           class="text-primary-800 mb-1 d-block">${row.patient.user.full_name}</a>
                           <span class="d-block text-muted fw-bold">${row.patient.user.email}</span>
                    </div>`;
                },
                name: 'patient.user.full_name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info">${moment(
                        row.date).
                        format(
                            'Do MMM, Y ')} ${row.from_time} ${row.from_time_type} - ${row.to_time} ${row.to_time_type}</span>`;
                },
                name: 'date',
            },
            {
                data: function (row) {
                    let status = row.status;
                    let colours = [
                        'danger',
                        'primary',
                        'success',
                        'warning',
                        'danger',
                    ];
                    return `
                            <div class="w-150px d-flex align-items-center">
                            <span class="slot-color-dot bg-${colours[status]} rounded-circle me-2"></span>
                            <select class="form-select-sm form-select-solid form-select status-change appointment-status" data-id="${row.id}">
                                    <option class="booked" disabled value="${book}" ${row.status ==
                    book ? 'selected' : ''}>Booked</option>
                                    <option value="${checkIn}" ${row.status ==
                    checkIn ? 'selected' : ''} ${row.status == checkIn
                        ? 'selected'
                        : ''} ${(row.status == cancel || row.status == checkOut)
                        ? 'disabled'
                        : ''}>Check In</option>
                                    <option value="${checkOut}" ${row.status ==
                    checkOut ? 'selected' : ''} ${(row.status == cancel ||
                        row.status == book) ? 'disabled' : ''}>Check Out</option>
                                    <option value="${cancel}" ${row.status ==
                    cancel ? 'selected' : ''} ${row.status == checkIn
                        ? 'disabled'
                        : ''} ${row.status == checkOut ? 'disabled' : ''}>Cancelled</option>
                            </select>
                            </div>`;
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'role': userRole,
                            'showUrl': route('appointments.show', row.id),
                        },
                    ];

                    return prepareTemplateRender('#appointmentsTemplate',
                        data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#appointmentStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#doctorAppointmentDataTable').
                    DataTable().
                    ajax.
                    reload(null, true);
            });
            $('#patientAppointmentDateFilter').change(function () {
                $('#doctorAppointmentDataTable').
                    DataTable().
                    ajax.
                    reload(null, true);
            });
        },
        drawCallback: function () {
            $('.appointment-status').select2();
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    let url = !isEmpty(userRole) ? route('patients.appointments.destroy',
        recordId) : route('appointments.destroy', recordId);
    deleteItem(url, tableName,
        'Appointment');
});

$(document).on('change', '.status-change', function () {
    let appointmentStatus = $(this).val();
    let appointmentId = $(this).data('id');
    let currentData = $(this);

    $.ajax({
        url: route('change-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            appointmentStatus: appointmentStatus,
        },
        success: function (result) {
            $(currentData).children('option.booked').addClass('hide');
            $('#doctorAppointmentDataTable').
                DataTable().
                ajax.
                reload(null, true);
            displaySuccessMessage(result.message);
        },
    });
});

$(document).on('click', '#resetFilter', function () {
    $('#appointmentStatus').val(book).trigger('change');
    $('#patientAppointmentDateFilter').
        val(moment().startOf('week').format('MM/DD/YYYY') + ' - ' +
            moment().endOf('week').format('MM/DD/YYYY')).
        trigger('change');
});
