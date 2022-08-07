'use strict';

let dateEle = '#templateAppointmentDate';
$(document).ready(function () {
    $('#templateAppointmentDate').datepicker({
        format: 'yyyy-mm-dd',
        startDate: new Date(),
        todayHighlight: true
    });

    let timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes === 0
        ? 0
        : -timezone_offset_minutes;

    $('#isPatientAccount').on('change',function (){
        if(this.checked){
            $('.name-details').addClass('d-none');
            $('.registered-patient').removeClass('d-none');
            $('#template-medical-email').keyup(function () {
                $('#patientName').val('');
                let email = $('#template-medical-email').val();

                $.ajax({
                    url: route('get-patient-name'),
                    type: 'GET',
                    data: { 'email': email },
                    success: function (result) {
                        if (result.data) {
                            $('#patientName').val(result.data);
                        }
                    },
                });
            });
        }else{
            $('.name-details').removeClass('d-none');
            $('.registered-patient').addClass('d-none');
        }
    })

    let selectedDate;
    $('.no-time-slot').removeClass('d-none');
    $(document).on('change', dateEle, function () {
        selectedDate = $(this).val();
        $('#slotData').html('');
        $.ajax({
            url: route('doctor-session-time'),
            type: 'GET',
            data: {
                'doctorId': $('#doctorId').val(),
                'date': selectedDate,
                'timezone_offset_minutes': timezone_offset_minutes,
            },
            success: function (result) {
                if (result.success) {
                    $.each(result.data['slots'], function (index, value) {
                        $('.no-time-slot').addClass('d-none');
                        if (result.data['bookedSlot'] == null) {
                            $('#slotData').
                                append(
                                    '<span class="time-slot col-2" data-id="' +
                                    value + '">' + value + '</span>');
                        } else {
                            if ($.inArray(value,
                                result.data['bookedSlot']) !== -1) {
                                $('#slotData').
                                    append(
                                        '<span class="time-slot col-2 bookedSlot " data-id="' +
                                        value + '">' + value + '</span>');
                            } else {
                                $('#slotData').
                                    append(
                                        '<span class="time-slot col-2" data-id="' +
                                        value + '">' + value + '</span>');
                            }

                        }
                    });
                }
            },
            error: function (result) {
                $('.book-appointment-message').css('display','block');
                let response = '<div class="gen alert alert-danger">'+result.responseJSON.message+'</div>';
                $('.book-appointment-message').html(response).delay(5000).hide('slow');
            },
        });
    });

    $(document).on('click', '.time-slot', function () {
        if ($('.time-slot').hasClass('activeSlot')) {
            $('.time-slot').removeClass('activeSlot');
            $(this).addClass('activeSlot');
        } else {
            $(this).addClass('activeSlot');
        }
        let fromToTime = $(this).attr('data-id').split('-');
        let fromTime = fromToTime[0];
        let toTime = fromToTime[1];
        $('#timeSlot').val('');
        $('#toTime').val('');
        $('#timeSlot').val(fromTime);
        $('#toTime').val(toTime);
    });

    let charge;
    let addFees = parseInt($('#addFees').val());
    let totalFees;
    let serviceIdExist = $('#serviceId').val();
    $(document).on('change', '#doctorId', function () {
        $('#payableAmountText').addClass('d-none');
        $('#chargeId').val('');
        $('#payableAmount').val('');
        $('#templateAppointmentDate').val('');
        $('#addFees').val('');
        $('#slotData').html('');
        $('.no-time-slot').removeClass('d-none');
        $(dateEle).removeAttr('disabled');
        $.ajax({
            url: route('get-service'),
            type: 'GET',
            data: {
                'doctorId': $(this).val(),
            },
            success: function (result) {
                if (result.success) {
                    $(dateEle).removeAttr('disabled');
                    $('#serviceId').empty();
                    $('#serviceId').
                        append($('<option value=""></option>').
                            text('Select Service'));
                    $.each(result.data, function (i, v) {
                        $('#serviceId').
                            append($('<option></option>').
                                attr('value', v.id).
                                attr('selected', v.id == serviceIdExist).
                                text(v.name));
                    });
                    if (serviceIdExist && $('#serviceId').val()){
                        $('#payableAmountText').removeClass('d-none');
                    }
                    $("#serviceId").selectpicker("refresh");
                }
            },
        });
    });
    let payableAmount = '';
    $(document).on('change', '#serviceId', function () {
        if ($(this).val() == '') {
            $('#payableAmountText').addClass('d-none');
            return;
        }
        $.ajax({
            url: route('get-charge'),
            type: 'GET',
            data: {
                'chargeId': $(this).val(),
            },
            success: function (result) {
                if (result.success) {
                    $('#payableAmountText').removeClass('d-none');
                    $('#payableAmount').
                        text(currencyIcon + ' ' + getFormattedPrice(result.data.charges));
                    payableAmount = result.data.charges;
                    charge = result.data.charges;
                }
            },
        });
    });
    $('#frontAppointmentBook').on('submit',function (e) {
        e.preventDefault();

        let firstName = $('#template-medical-first_name').val().trim();
        let lastName = $('#template-medical-last_name').val().trim();
        let email = $('#template-medical-email').val().trim();
        let doctor = $('#doctorId').val().trim();
        let services = $('#serviceId').val().trim();
        let appointmentDate = $('#templateAppointmentDate').val().trim();
        let paymentType = $('#paymentMethod').val().trim();
        $('.book-appointment-message').css('display','block');
        if (!$('#isPatientAccount').is(':checked')) {
            if (firstName == '') {
                response = '<div class="gen alert alert-danger">First name field is required. </div>';
                $(window).scrollTop($('.appointment-form').offset().top)
                $('.book-appointment-message').html(response).delay(5000).hide('slow');
                return false;
            }
            if (lastName == '') {
                response = '<div class="gen alert alert-danger">Last name field is required. </div>';
                $(window).scrollTop($('.appointment-form').offset().top)
                $('.book-appointment-message').html(response).delay(5000).hide('slow');
                return false;
            }
        }

        if (email == '') {
            response = '<div class="gen alert alert-danger">Email field is required. </div>';
            $('.book-appointment-message').html(response).delay(5000).hide('slow');
            $(window).scrollTop($('.appointment-form').offset().top)
            return false;
        }
        if (doctor == '') {
            response = '<div class="gen alert alert-danger">Doctor field is required. </div>';
            $('.book-appointment-message').html(response).delay(5000).hide('slow');
            $(window).scrollTop($('.appointment-form').offset().top)
            return false;
        }
        if (services == '') {
            response = '<div class="gen alert alert-danger">Services field is required. </div>';
            $('.book-appointment-message').html(response).delay(5000).hide('slow');
            $(window).scrollTop($('.appointment-form').offset().top)
            return false;
        }
        if (appointmentDate == '') {
            response = '<div class="gen alert alert-danger">Appointment date field is required. </div>';
            $('.book-appointment-message').
                html(response).
                delay(5000).
                hide('slow');
            $(window).scrollTop($('.appointment-form').offset().top);
            return false;
        }
        if (paymentType == '') {
            response = '<div class="gen alert alert-danger">Payment Method field is required. </div>';
            $('.book-appointment-message').
                html(response).
                delay(5000).
                hide('slow');
            $(window).scrollTop($('.appointment-form').offset().top);
            return false;
        }

        let btnSaveEle = $(this).find('#saveBtn');
        setFrontBtnLoader(btnSaveEle);

        let formData = new FormData($(this)[0]);
        formData.append('payable_amount', payableAmount);
        let response = '<div class="alert alert-warning alert-dismissable"> Processing.. </div>';
        jQuery(this).
            find('.book-appointment-message').
            html(response).
            show('slow');
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    let appointmentID = result.data.appointmentId;
                    
                    response = '<div class="gen alert alert-success">' + result.message + '</div>';
                    
                    $('.book-appointment-message').html(response).delay(5000).hide('slow');
                    $(window).scrollTop($('.appointment-form').offset().top);
                    $('#frontAppointmentBook')[0].reset();
                    
                    if (result.data.payment_type == paystack) {
                        
                        return location.href = result.data.redirect_url;
                    }
                    
                    if (result.data.payment_type == authorizeMethod) {

                        window.location.replace(route('authorize.init',{'appointmentId': appointmentID}));
                    }

                    if (result.data.payment_type == paytmMethod) {

                        window.location.replace(route('paytm.init', { 'appointmentId': appointmentID }));
                    }

                    if (result.data.payment_type == paypal) {
                        $.ajax({
                            type: 'GET',
                            url: route('paypal.init'),
                            data: { 'appointmentId': appointmentID },
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

                    if (result.data.payment_type == razorpayMethod) {
                        $.ajax({
                            type: 'POST',
                            url: route('razorpay.init'),
                            data: {'_token': csrfToken,'appointmentId': appointmentID },
                            success: function (result) {
                                if (result.success) {
                                    let { id, amount, name, email, contact } = result.data

                                    options.amount = amount
                                    options.order_id = id
                                    options.prefill.name = name
                                    options.prefill.email = email
                                    options.prefill.contact = contact
                                    options.prefill.appointmentID = appointmentID
                                    
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

                    if (result.data.payment_type == stripeMethod) {
                        let sessionId = result.data[0].sessionId;
                        stripe.redirectToCheckout({
                            sessionId: sessionId,
                        }).then(function (result) {
                            manageAjaxErrors(result);
                        });
                    }
                    
                    if (result.data === manually) {
                        setTimeout(function () {
                            location.reload();
                        }, 1200);
                    }
                }
            },
            error: function (result) {
                $('.book-appointment-message').css('display', 'block');
                response = '<div class="gen alert alert-danger">' +
                    result.responseJSON.message + '</div>';
                $(window).scrollTop($('.appointment-form').offset().top);
                $('.book-appointment-message').
                    html(response).
                    delay(5000).
                    hide('slow');
            },
            complete: function () {
                setFrontBtnLoader(btnSaveEle);
            },
        });
    });
});

$(document).on('click', '.show-more-btn', function () {
    if ($('.question').hasClass('d-none')) {
        $('.question').removeClass('d-none');
        $('.show-more-btn').html('show less');
    } else {
        $('.show-content').addClass('d-none');
        $('.show-more-btn').html('show more');
    }
});

$(document).ready(function (){
    let timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes === 0
        ? 0
        : -timezone_offset_minutes;
    let selectedDate = $('#templateAppointmentDate').val();
    
    if(!($('#doctorId').val() == '')){
        $(dateEle).removeAttr('disabled');
        $.ajax({
            url: route('get-service'),
            type: 'GET',
            data: {
                'doctorId': $('#doctorId').val(),
            },
            success: function (result) {
                if (result.success) {
                    $(dateEle).removeAttr('disabled');
                    $('#serviceId').empty();
                    $('#serviceId').
                        append($('<option value=""></option>').
                            text('Select Service'));
                    $.each(result.data, function (i, v) {
                        $('#serviceId').
                            append($('<option></option>').
                                attr('value', v.id).
                                text(v.name));
                    });
                    $("#serviceId").selectpicker("refresh");
                }
            },
        });
    }
    
    let payableAmount ='';
    let charge ='';
    if(!($('#serviceId').val() == '')){
        $.ajax({
            url: route('get-charge'),
            type: 'GET',
            data: {
                'chargeId': $('#serviceId').val(),
            },
            success: function (result) {
                if (result.success) {
                    $('#payableAmountText').removeClass('d-none');
                    $('#payableAmount').
                        text(currencyIcon + ' ' + getFormattedPrice(result.data.charges));
                    payableAmount = result.data.charges;
                    charge = result.data.charges;
                }
            },
        });
    }
    
    if (!selectedDate){
        return false;
    }
    
    $('#slotData').html('');
    $.ajax({
        url: route('doctor-session-time'),
        type: 'GET',
        data: {
            'doctorId': $('#doctorId').val(),
            'date': selectedDate,
            'timezone_offset_minutes': timezone_offset_minutes,
        },
        success: function (result) {
            if (result.success) {
                $.each(result.data['slots'], function (index, value) {
                    $('.no-time-slot').addClass('d-none');
                    if (result.data['bookedSlot'] == null) {
                        $('#slotData').
                        append(
                            '<span class="time-slot col-2" data-id="' +
                            value + '">' + value + '</span>');
                    } else {
                        if ($.inArray(value,
                            result.data['bookedSlot']) !== -1) {
                            $('#slotData').
                            append(
                                '<span class="time-slot col-2 bookedSlot " data-id="' +
                                value + '">' + value + '</span>');
                        } else {
                            $('#slotData').
                            append(
                                '<span class="time-slot col-2" data-id="' +
                                value + '">' + value + '</span>');
                        }

                    }
                });
            }
        },
        error: function (result) {
            $('.book-appointment-message').css('display', 'block');
            let response = '<div class="gen alert alert-danger">' +
                result.responseJSON.message + '</div>';
            $('.book-appointment-message').
                html(response).
                delay(5000).
                hide('slow');
        },
    });

});

window.setFrontBtnLoader = function (btnLoader) {
    if (btnLoader.attr('data-old-text')) {
        btnLoader.html(btnLoader.attr('data-old-text')).prop('disabled', false);
        btnLoader.removeAttr('data-old-text');
        return;
    }
    btnLoader.attr('data-old-text', btnLoader.text());
    btnLoader.html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').
        prop('disabled', true);
};

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
