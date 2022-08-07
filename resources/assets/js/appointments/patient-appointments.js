'use strict';

let tableName = '#appointmentsTable';
$(document).ready(function () {
    let start = moment().startOf('week');
    let end = moment().endOf('week');
    let filterDate = $('#patientAppointmentDate');

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
        'order': [[1, 'desc']],
        ajax: {
            url: url,
            data: function (data) {
                data.status = $('#patientAppointmentStatus').
                    find('option:selected').
                    val();
                data.payment_type = $('#patientPaymentStatus').
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
                'targets': [2],
                'width': '20%',
            },
            {
                'targets': [3],
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
                    let reviewHtmlData  = getAvgReviewHtmlData(row.doctor.reviews)
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.doctor.user.profile_image}" alt=""
                                 class="w-100 object-cover">
                        </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <div class="d-inline-block align-self-center d-flex">
                            <a class="text-primary-800 mb-1 d-inline-block align-self-center">${row.doctor.user.full_name}</a>
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
                    if (row.payment_type === 2) {
                        return `<span class="badge badge-light-success">${paid}</span>`;
                    } else {
                        return `<span class="badge badge-light-danger">${pending}</span>
                        <a href="javascript:void(0)" data-id="${row.id}" class="btn btn-icon btn-bg-light text-hover-primary btn-sm me-1 payment-btn" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Appointment Payment">
                            <i class="far fa-credit-card fs-4"></i>
                        </a>`;
                    }
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
                    const takeStatus = {
                        '1': 'Booked',
                        '2': 'Check In',
                        '3': 'Check Out',
                        '4': 'Cancelled',
                    };

                    return `<div class="w-120px d-flex align-items-center">
                                <span class="bg-${colours[status]} rounded-circle h-10px w-10px me-2"></span>
                                <span class="">${takeStatus[status]}</span>
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
                            'canceled': row.status,
                            'showUrl': route('patients.appointment.detail',
                                row.id),
                        },
                    ];

                    return prepareTemplateRender('#appointmentsTemplate',
                        data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#patientAppointmentStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#appointmentsTable').DataTable().ajax.reload(null, true);
            });
            $('#patientPaymentStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#appointmentsTable').DataTable().ajax.reload(null, true);
            });
            $('#patientAppointmentDate').change(function () {
                $('#appointmentsTable').DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);

    $(document).on('click', '#resetFilter', function () {
        $('#patientPaymentStatus').val(allPaymentCount).trigger('change');
        $('#patientAppointmentStatus').val(book).trigger('change');
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

$(document).on('click', '.cancel-appointment', function (event) {
    let appointmentId = $(event.currentTarget).data('id');
    cancelAppointment(route('patients.cancel-status'), tableName, 'Appointment',
        appointmentId);

});

window.cancelAppointment = function (url, tableId, header, appointmentId) {
    Swal.fire({
        title: 'Cancelled Appointment !',
        text: 'Are you sure want to cancel this ' + header + ' ?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonColor: '#266CB0',
        showLoaderOnConfirm: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
    }).then(function (result) {
        if (result.isConfirmed) {
            deleteItemAjax(url, tableId, header, appointmentId);
        }
    });
};

function deleteItemAjax (url, tableId, header, appointmentId) {

    $.ajax({
        url: route('patients.cancel-status'),
        type: 'POST',
        data: { appointmentId: appointmentId },
        success: function (obj) {
            if (obj.success) {
                if ($(tableId).DataTable().data().count() == 1) {
                    $(tableId).DataTable().page('previous').draw('page');
                } else {
                    $(tableId).DataTable().ajax.reload(null, false);
                }
            }
            Swal.fire({
                title: 'Cancelled Appointment!',
                text: header + ' has been Cancelled.',
                icon: 'success',
                confirmButtonColor: '#266CB0',
                timer: 2000,
            });
        },
        error: function (data) {
            Swal.fire({
                title: 'Error',
                icon: 'error',
                text: data.responseJSON.message,
                type: 'error',
                confirmButtonColor: '#266CB0',
                timer: 5000,
            });
        },
    });
}

$(document).on('submit', '#patientPaymentForm', function (event) {
    let paymentGatewayType = $('#paymentGatewayType').val();
    let appointmentId = $('#patientAppointmentId').val();
    let btnSubmitEle = $(this).find('#submitBtn');
    setAdminBtnLoader(btnSubmitEle);

    if (paymentGatewayType == stripeMethod) {
        $.ajax({
            url: route('patients.appointment-payment'),
            type: 'POST',
            data: { appointmentId: appointmentId },
            success: function (result) {
                let sessionId = result.data.sessionId;
                stripe.redirectToCheckout({
                    sessionId: sessionId,
                }).then(function (result) {
                    manageAjaxErrors(result);
                });
            },
        });
    }

    if (paymentGatewayType == paytmMethod) {
        window.location.replace(route('paytm.init', { 'appointmentId': appointmentId }));
    }

    if (paymentGatewayType == paystackMethod) {

        window.location.replace(route('paystack.init', { 'appointmentData': appointmentId }));
    }
    
    if (paymentGatewayType == authorizeMethod) {

        window.location.replace(route('authorize.init',{'appointmentId': appointmentId}));
    }

    if (paymentGatewayType == paypalMethod) {
        $.ajax({
            type: 'GET',
            url: route('paypal.init'),
            data: { 'appointmentId': appointmentId},
            success: function (result) {
                if (result.statusCode == 201) {
                    let redirectTo = '';

                    $.each(result.result.links,
                        function (key, val) {
                            if (val.rel == 'approve') {
                                redirectTo = val.href;
                            }
                        });
                    location.href = redirectTo;
                }
            },
            error: function (result) {
            },
            complete: function () {
            },
        });
    }

    if (paymentGatewayType == razorpayMethod) {
        $.ajax({
            type: 'POST',
            url: route('razorpay.init'),
            data: {'appointmentId': appointmentId },
            success: function (result) {
                if (result.success) {
                    let { id, amount, name, email, contact } = result.data

                    options.amount = amount
                    options.order_id = id
                    options.prefill.name = name
                    options.prefill.email = email
                    options.prefill.contact = contact
                    options.prefill.appointmentID = appointmentId

                    let razorPay = new Razorpay(options)
                    razorPay.open()
                    razorPay.on('payment.failed', storeFailedPayment)
                }
            },
            error: function (result) {
            },
            complete: function () {
            },
        })
    }

    return false;
});

function storeFailedPayment (response) {
    $.ajax({
        type: 'POST',
        url: route('razorpay.failed'),
        data: {
            data: response,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
            }
        },
        error: function () {
        },
    });
}

$(document).on('click', '.payment-btn', function (event) {

    let appointmentId = $(this).data('id');

    $('#paymentGatewayModal').modal('show').appendTo('body');

    $('#patientAppointmentId').val(appointmentId);
});

$('#paymentGatewayModal').on('hidden.bs.modal', function (e) {
    $('#patientPaymentForm')[0].reset();
    $('#paymentGatewayType').val(null).trigger('change');
});
