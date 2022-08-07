'use strict';

let tableName = '#doctorAppointmentTable';
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

    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: route('doctors.appointments'),
            data: function (data) {
                data.status = $('#doctorAppointmentStatus').
                    find('option:selected').
                    val();
                data.payment_type = $('#doctorPaymentStatus').
                    find('option:selected').
                    val();
                data.filter_date = filterDate.val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '25%',
            },
            {
                'targets': [1],
                'width': '20%',
            },
            {
                'targets': [3],
                'width': '15%',
                'className': 'text-center',
                'searchable': false,
            },
            {
                'targets': [4],
                'orderable': false,
                'searchable': false,
            },
            {
                'targets': [5],
                'className': 'text-center',
                'orderable': false,
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                <img src="${row.patient.profile}" alt=""
                                     class="w-100 object-cover  ">
                            </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <a class="text-primary-800 mb-1 d-block">${row.patient.user.full_name}</a>
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
                    return currencyIcon + ' ' + addCommas(row.payable_amount);
                },
                name: 'payable_amount',
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
                            <select class="form-select-sm form-select-solid form-select status-change doctor-appointment-status" data-id="${row.id}">
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
                            'showUrl': route('doctors.appointment.detail',
                                row.id),
                        },
                    ];

                    return prepareTemplateRender('#appointmentsTemplate',
                        data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#doctorAppointmentStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#doctorAppointmentTable').
                    DataTable().
                    ajax.
                    reload(null, true);
            });
            $('#doctorPaymentStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#doctorAppointmentTable').
                    DataTable().
                    ajax.
                    reload(null, true);
            });
            $('#appointmentDate').change(function () {
                $('#doctorAppointmentTable').
                    DataTable().
                    ajax.
                    reload(null, true);
            });
        },
        drawCallback: function () {
            $('.payment-status, .doctor-appointment-status').select2();
        },
    });
    handleSearchDatatable(tbl);

    $(document).on('click', '#resetFilter', function () {
        $('#doctorPaymentStatus').val(allPaymentCount).trigger('change');
        $('#doctorAppointmentStatus').val(book).trigger('change');
        filterDate.data('daterangepicker').
            setStartDate(moment().startOf('week').format('MM/DD/YYYY'));
        filterDate.data('daterangepicker').
            setEndDate(moment().endOf('week').format('MM/DD/YYYY'));
    });
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
            $('#doctorAppointmentTable').DataTable().ajax.reload(null, true);
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
        url: route('doctors.change-payment-status', appointmentId),
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
