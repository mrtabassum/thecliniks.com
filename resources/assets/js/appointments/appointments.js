'use strict';

let tableName = '#appointmentsTable';
$(document).ready(function () {
    let start = moment().startOf('week');
    let end = moment().endOf('week');
    let filterDate = $('#appointmentDate');

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

    let url = !isEmpty(userRole) ? route('patients.appointments.index') : route(
        'appointments.index');
    let tbl = $(tableName).DataTable({
        deferRender: true,
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[2, 'desc']],
        ajax: {
            url: url,
            data: function (data) {
                data.status = $('#appointmentStatus').
                    find('option:selected').
                    val();
                data.payment_type = $('#paymentStatus').
                    find('option:selected').
                    val();
                data.filter_date = filterDate.val();
            },
        },
        columnDefs: [
            {
                'targets': [0, 1],
                'width': '25%',
            },
            {
                'targets': [2],
                'width': '25%',
                'className': 'text-center',
            },
            {
                'targets': [3],
                'className': 'text-center',
                'searchable': false,
            },
            {
                'targets': [4],
                'searchable': false,
                'orderable': false,
            },
            {
                'targets': [5],
                'orderable': false,
                'width': '8%',
                'className': 'text-center',
            },
        ],
        columns: [
            {
                data: function (row) {
                    let reviewHtmlData  = getAvgReviewHtmlData(row.doctor.reviews)
                    let url = !isEmpty(userRole) ? route(
                        'patients.appointments.show', row.id) : route(
                        'appointments.show', row.id);
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.doctor.user.profile_image}" alt=""
                                 class="w-100 object-cover">
                        </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <div class="d-inline-block align-self-center d-flex">
                            <a href="${(adminRole == true) ? route('doctors.show',
                        row.doctor.id) : url}"
                           class="text-primary-800 mb-1 d-inline-block align-self-center">${row.doctor.user.full_name}</a>
                                <div class="star-ratings d-inline-block align-self-center ms-2">
                                     ${reviewHtmlData}
                                </div>
                        </div>
                        <span class="d-block text-muted fw-bold">${row.doctor.user.email}</span>
                    </div>`;
                },
                name: 'doctor.user.full_name',
            },
            {
                data: function (row) {
                    let url = !isEmpty(userRole) ? route(
                        'patients.appointments.show', row.id) : route(
                        'appointments.show', row.id);
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="javascript:void(0)">
                            <div class="symbol-label">
                                <img src="${row.patient.profile}" alt=""
                                     class="w-100 object-cover">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${(adminRole == true) ? route('patients.show',
                        row.patient.id) : url}"
                           class="text-primary-800 mb-1 d-block">${row.patient.user.full_name}</a>
                           <span class="d-block text-muted fw-bold">${row.patient.user.email}</span>
                    </div>`;
                },
                name: 'patient.user.full_name',
            },
            {
                data: function (row) {
                    return `<div class="badge badge-light-info">
                                <div class="mb-2">${row.from_time} ${row.from_time_type} - ${row.to_time} ${row.to_time_type}</div>
                                <div class="">${moment(row.date).
                        format('Do MMM, Y ')}</div>
                            </div>`;
                },
                name: 'date',
            },
            {
                data: function (row) {
                    return `
                        <select class="form-select-sm form-select-solid form-select change-payment-status payment-status" data-id="${row.id}">
                                <option value="${paid}" ${(row.payment_type ==
                        paid) ? 'selected' : ''}>Paid</option>
                                <option value="${pending}" ${(row.payment_type ==
                        paid) ? 'disabled' : 'selected'}>Pending</option>
                        </select>`;
                },
                name: 'payment_type',
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

                    return prepareTemplateRender('#appointmentsTemplate', data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#appointmentStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#appointmentsTable').DataTable().ajax.reload(null, true);
            });
            $('#paymentStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#appointmentsTable').DataTable().ajax.reload(null, true);
            });
            $('#appointmentDate').change(function () {
                $('#appointmentsTable').DataTable().ajax.reload(null, true);
            });
        },
        drawCallback: function () {
            $('.appointment-status, .payment-status').select2();
        },
    });
    handleSearchDatatable(tbl);

    $(document).on('click', '#resetFilter', function () {
        $('#appointmentsTable').DataTable().ajax.reload(null, true);
        $('#paymentStatus').val(allPaymentCount).trigger('change');
        $('#appointmentStatus').val(book).trigger('change');
        filterDate.data('daterangepicker').
            setStartDate(moment().startOf('week').format('MM/DD/YYYY'));
        filterDate.data('daterangepicker').
            setEndDate(moment().endOf('week').format('MM/DD/YYYY'));
    });
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
            $('#appointmentsTable').DataTable().ajax.reload(null, true);
            displaySuccessMessage(result.message);
        },
    });
});

$(document).on('change', '.change-payment-status', function () {
    let paymentStatus = $(this).val();
    let appointmentId = $(this).data('id');

    $('#paymentStatusModal').modal('show').appendTo('body');

    $('#paymentStatus').val(paymentStatus);
    $('#appointmentId').val(appointmentId);
});

$(document).on('submit', '#paymentStatusForm', function (event) {
    event.preventDefault();
    let paymentStatus = $('#paymentStatus').val();
    let appointmentId = $('#appointmentId').val();
    let paymentMethod = $('#paymentType').val();

    $.ajax({
        url: route('change-payment-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            paymentStatus: paymentStatus,
            paymentMethod: paymentMethod,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#paymentStatusModal').modal('hide');
                location.reload();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
