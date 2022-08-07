'use strict';

let tableName = '#staffAppointmentDataTable';
$(document).ready(function () {
    let tbl = $('#staffAppointmentDataTable').dataTable({
        deferRender: true,
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [1, 'asc'],
        ajax: {

            data: function (data) {
                data.status = $('#appointmentStatus').
                    find('option:selected').
                    val();
                data.patientId = patientID;
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
                            <img src="${row.doctor.user.profile_image}" alt=""
                                 class="w-100">
                        </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${route('doctors.appointment.detail',
                        row.doctor.id)}"
                           class="text-primary-800 mb-1 d-block">${row.doctor.user.full_name}</a>
                           <span class="d-block text-muted fw-bold">${row.doctor.user.email}</span>
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
                    return `
                            <div class="w-120px">
                            <select class="form-select-sm form-select-solid form-select status-change" data-control="select2" data-id="${row.id}">
                                    <option class="booked" disabled value="${book}" ${row.status ==
                    book ? 'selected' : ''}>Booked</option>
                                    <option value="${checkIn}" ${row.status ==
                    checkIn ? 'selected' : ''}>Check In</option>
                                    <option value="${checkOut}" ${row.status ==
                    checkOut ? 'selected' : ''}>Check Out</option>
                                    <option value="${cancel}" ${row.status ==
                    cancel ? 'selected' : ''}>Cancelled</option>
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
                        },
                    ];

                    return prepareTemplateRender('#appointmentsTemplate',
                        data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#appointmentStatus').change(function () {
                $('#staffAppointmentDataTable').
                    DataTable().
                    ajax.
                    reload(null, true);
            });
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
            $('#staffAppointmentDataTable').
                DataTable().
                ajax.
                reload(null, true);
            displaySuccessMessage(result.message);
        },
    });
});
