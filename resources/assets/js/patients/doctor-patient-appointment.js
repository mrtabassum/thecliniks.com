'use strict';

let tableName = '#patentAppointmentDataTable';
$(document).ready(function () {
    let start = moment().startOf('week');
    let end = moment().endOf('week');
    let filterDate = $('#doctorAppointmentDateFilter');

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

    let appointmentUrl = (doctorRole == true) ? route(
        'doctors.patients.appointment') : route('patients.appointment');
    let tbl = $('#patentAppointmentDataTable').DataTable({
        deferRender: true,
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [0, 'desc'],
        ajax: {
            url: appointmentUrl,
            data: function (data) {
                data.status = $('#appointmentStatus').
                    find('option:selected').
                    val();
                data.patientId = patientID;
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
                'width': '10%',
                'orderable': false,
                'searchable': false,
            },
            {
                'targets': [2],
                'width': '8%',
                'className': 'text-center pr-0',
                'orderable': false,
                'searchable': false,
            },
        ],
        columns: [
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
                    let showUrl = !isEmpty(doctorRole) ? route(
                        'doctors.appointment.detail', row.id) : route(
                        'appointments.show', row.id);

                    let data = [
                        {
                            'id': row.id,
                            'role': userRole,
                            'showUrl': showUrl,
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
                $('#patentAppointmentDataTable').
                    DataTable().
                    ajax.
                    reload(null, true);
            });
            $('#doctorAppointmentDateFilter').change(function () {
                $('#patentAppointmentDataTable').
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
        url: route('doctors.change-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            appointmentStatus: appointmentStatus,
        },
        success: function (result) {
            $(currentData).children('option.booked').addClass('hide');
            $('#patentAppointmentDataTable').
                DataTable().
                ajax.
                reload(null, true);
            displaySuccessMessage(result.message);
        },
    });
});

$(document).on('click', '#resetFilter', function () {
    $('#appointmentStatus').val(book).trigger('change');
    $('#doctorAppointmentDateFilter').
        val(moment().format('MM/DD/YYYY') + ' - ' +
            moment().format('MM/DD/YYYY')).
        trigger('change');
});
