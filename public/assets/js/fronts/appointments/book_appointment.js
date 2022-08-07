/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*********************************************************************!*\
  !*** ./resources/assets/js/fronts/appointments/book_appointment.js ***!
  \*********************************************************************/


var dateEle = '#templateAppointmentDate';
$(document).ready(function () {
  $('#templateAppointmentDate').datepicker({
    format: 'yyyy-mm-dd',
    startDate: new Date(),
    todayHighlight: true
  });
  var timezone_offset_minutes = new Date().getTimezoneOffset();
  timezone_offset_minutes = timezone_offset_minutes === 0 ? 0 : -timezone_offset_minutes;
  $('#isPatientAccount').on('change', function () {
    if (this.checked) {
      $('.name-details').addClass('d-none');

      $('.registered-patient').removeClass('d-none');
      $('#template-medical-email').keyup(function () {
        $('#patientName').val('');
        var email = $('#template-medical-email').val();
        $.ajax({
          url: route('get-patient-name'),
          type: 'GET',
          data: {
            'email': email
          },
          success: function success(result) {
            if (result.data) {
              $('#patientName').val(result.data);
            }
          }
        });
      });
    } else {
      $('.name-details').removeClass('d-none');
      $('.registered-patient').addClass('d-none');
    }
  });
  var selectedDate;
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
        'timezone_offset_minutes': timezone_offset_minutes
      },
      success: function success(result) {
        if (result.success) {
          $.each(result.data['slots'], function (index, value) {
            $('.no-time-slot').addClass('d-none');

            if (result.data['bookedSlot'] == null) {
              $('#slotData').append('<span class="time-slot col-2" data-id="' + value + '">' + value + '</span>');
            } else {
              if ($.inArray(value, result.data['bookedSlot']) !== -1) {
                $('#slotData').append('<span class="time-slot col-2 bookedSlot " data-id="' + value + '">' + value + '</span>');
              } else {
                $('#slotData').append('<span class="time-slot col-2" data-id="' + value + '">' + value + '</span>');
              }
            }
          });
        }
      },
      error: function error(result) {
        $('.book-appointment-message').css('display', 'block');
        var response = '<div class="gen alert alert-danger">' + result.responseJSON.message + '</div>';
        $('.book-appointment-message').html(response).delay(5000).hide('slow');
      }
    });
  });
  $(document).on('click', '.time-slot', function () {
    if ($('.time-slot').hasClass('activeSlot')) {
      $('.time-slot').removeClass('activeSlot');
      $(this).addClass('activeSlot');
    } else {
      $(this).addClass('activeSlot');
    }

    var fromToTime = $(this).attr('data-id').split('-');
    var fromTime = fromToTime[0];
    var toTime = fromToTime[1];
    $('#timeSlot').val('');
    $('#toTime').val('');
    $('#timeSlot').val(fromTime);
    $('#toTime').val(toTime);
  });
  var charge;
  var addFees = parseInt($('#addFees').val());
  var totalFees;
  var serviceIdExist = $('#serviceId').val();
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
        'doctorId': $(this).val()
      },
      success: function success(result) {
        if (result.success) {
          $(dateEle).removeAttr('disabled');
          $('#serviceId').empty();
          $('#serviceId').append($('<option value=""></option>').text('Select Service'));
          $.each(result.data, function (i, v) {
            $('#serviceId').append($('<option></option>').attr('value', v.id).attr('selected', v.id == serviceIdExist).text(v.name));
          });

          if (serviceIdExist && $('#serviceId').val()) {
            $('#payableAmountText').removeClass('d-none');
          }

          $("#serviceId").selectpicker("refresh");
        }
      }
    });
  });
  var payableAmount = '';
  $(document).on('change', '#serviceId', function () {
    if ($(this).val() == '') {
      $('#payableAmountText').addClass('d-none');
      return;
    }

    $.ajax({
      url: route('get-charge'),
      type: 'GET',
      data: {
        'chargeId': $(this).val()
      },
      success: function success(result) {
        if (result.success) {
          $('#payableAmountText').removeClass('d-none');
          $('#payableAmount').text(currencyIcon + ' ' + getFormattedPrice(result.data.charges));
          payableAmount = result.data.charges;
          charge = result.data.charges;
        }
      }
    });
  });

  // Here Start Appointment Button
  $('#frontAppointmentBook').on('submit', function (e) {
    e.preventDefault();
    var firstName = $('#template-medical-first_name').val().trim();
    var lastName = $('#template-medical-last_name').val().trim();
    var email = $('#template-medical-email').val().trim();
    var doctor = $('#doctorId').val().trim();
    var services = $('#serviceId').val().trim();
    var appointmentDate = $('#templateAppointmentDate').val().trim();
    var paymentType = $('#paymentMethod').val().trim();
    $('.book-appointment-message').css('display', 'block');

    if (!$('#isPatientAccount').is(':checked')) {
      if (firstName == '') {
        response = '<div class="gen alert alert-danger">First name field is required. </div>';
        $(window).scrollTop($('.appointment-form').offset().top);
        $('.book-appointment-message').html(response).delay(5000).hide('slow');
        return false;
      }

      if (lastName == '') {
        response = '<div class="gen alert alert-danger">Last name field is required. </div>';
        $(window).scrollTop($('.appointment-form').offset().top);
        $('.book-appointment-message').html(response).delay(5000).hide('slow');
        return false;
      }
    }

    if (email == '') {
      response = '<div class="gen alert alert-danger">Email field is required. </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }

    if (doctor == '') {
      response = '<div class="gen alert alert-danger">Doctor field is required. </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }

    if (services == '') {
      response = '<div class="gen alert alert-danger">Services field is required. </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }

    if (appointmentDate == '') {
      response = '<div class="gen alert alert-danger">Appointment date field is required. </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }

    if (paymentType == '') {
      response = '<div class="gen alert alert-danger">Payment Method field is required. </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }

    var btnSaveEle = $(this).find('#saveBtn');
    setFrontBtnLoader(btnSaveEle);
    var formData = new FormData($(this)[0]);
    formData.append('payable_amount', payableAmount);
    var response = '<div class="alert alert-warning alert-dismissable"> Processing.. </div>';
    jQuery(this).find('.book-appointment-message').html(response).show('slow');
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function success(result) {
        if (result.success) {
          var appointmentID = result.data.appointmentId;
          response = '<div class="gen alert alert-success">' + result.message + '</div>';
          $('.book-appointment-message').html(response).delay(5000).hide('slow');
          $(window).scrollTop($('.appointment-form').offset().top);
          $('#frontAppointmentBook')[0].reset();

          if (result.data.payment_type == paystack) {
            return location.href = result.data.redirect_url;
          }

          if (result.data.payment_type == authorizeMethod) {
            window.location.replace(route('authorize.init', {
              'appointmentId': appointmentID
            }));
          }

          if (result.data.payment_type == paytmMethod) {
            window.location.replace(route('paytm.init', {
              'appointmentId': appointmentID
            }));
          }

          if (result.data.payment_type == paypal) {
            $.ajax({
              type: 'GET',
              url: route('paypal.init'),
              data: {
                'appointmentId': appointmentID
              },
              success: function success(result) {
                if (result.statusCode == 201) {
                  var redirectTo = '';
                  $.each(result.result.links, function (key, val) {
                    if (val.rel == 'approve') {
                      redirectTo = val.href;
                    }
                  });
                  location.href = redirectTo;
                }
              },
              error: function error(result) {},
              complete: function complete() {}
            });
          }

          if (result.data.payment_type == razorpayMethod) {
            $.ajax({
              type: 'POST',
              url: route('razorpay.init'),
              data: {
                '_token': csrfToken,
                'appointmentId': appointmentID
              },
              success: function success(result) {
                if (result.success) {
                  var _result$data = result.data,
                      id = _result$data.id,
                      amount = _result$data.amount,
                      name = _result$data.name,
                      _email = _result$data.email,
                      contact = _result$data.contact;
                  options.amount = amount;
                  options.order_id = id;
                  options.prefill.name = name;
                  options.prefill.email = _email;
                  options.prefill.contact = contact;
                  options.prefill.appointmentID = appointmentID;
                  var razorPay = new Razorpay(options);
                  razorPay.open();
                  razorPay.on('payment.failed', storeFailedPayment);
                }
              },
              error: function error(result) {},
              complete: function complete() {}
            });
          }

          if (result.data.payment_type == stripeMethod) {
            var sessionId = result.data[0].sessionId;
            stripe.redirectToCheckout({
              sessionId: sessionId
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
      error: function error(result) {
        $('.book-appointment-message').css('display', 'block');
        response = '<div class="gen alert alert-danger">' + result.responseJSON.message + '</div>';
        $(window).scrollTop($('.appointment-form').offset().top);
        $('.book-appointment-message').html(response).delay(5000).hide('slow');
      },
      complete: function complete() {
        setFrontBtnLoader(btnSaveEle);
      }
    });
  });

  
  // Here Start Checkout Button
  $('#frontServiceBuy').on('submit', function (e) {
    e.preventDefault();
    var firstName = $('#template-medical-first_name').val().trim();
    var lastName = $('#template-medical-last_name').val().trim();
    var email = $('#template-medical-email').val().trim();
    var services = $('#serviceId').val().trim();
    var paymentType = $('#paymentMethod').val().trim();
    var orderNo = $('#orderNo').val();
    var authToken = $('#authToken').val();
    var accountNo = $('#accountNo').val();
    
    
    
    $('.book-appointment-message').css('display', 'block');

    if (!$('#isPatientAccount').is(':checked')) {
      if (firstName == '') {
        response = '<div class="gen alert alert-danger">First name field is required. </div>';
        $(window).scrollTop($('.appointment-form').offset().top);
        $('.book-appointment-message').html(response).delay(5000).hide('slow');
        return false;
      }

      if (lastName == '') {
        response = '<div class="gen alert alert-danger">Last name field is required. </div>';
        $(window).scrollTop($('.appointment-form').offset().top);
        $('.book-appointment-message').html(response).delay(5000).hide('slow');
        return false;
      }


    }

    if (email == '') {
      response = '<div class="gen alert alert-danger">Email field is required. </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }


    if (services == '') {
      response = '<div class="gen alert alert-danger">Services field is required. </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }

    
    if (paymentType == '') {
      response = '<div class="gen alert alert-danger">Payment Method field is required. </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }

    if (orderNo == '') {
      response = '<div class="gen alert alert-danger">Order No Is required. </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }


    if (authToken == '') {
      response = '<div class="gen alert alert-danger">AuthToken Is required </div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }


    if (accountNo == '') {
      response = '<div class="gen alert alert-danger">Account No Is Required</div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
      $(window).scrollTop($('.appointment-form').offset().top);
      return false;
    }

    var btnSaveEle = $(this).find('#saveBtn');
    setFrontBtnLoader(btnSaveEle);
    var formData = new FormData($(this)[0]);
    formData.append('payable_amount', payableAmount);
    var response = '<div class="alert alert-warning alert-dismissable"> Processing.. </div>';
    jQuery(this).find('.book-appointment-message').html(response).show('slow');
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function success(result) {
        if (result.success) {
        
    
          var transactionReferenceNumber = result.data.transactionReferenceNumber;
          var transactionTypeid = result.data.transactionTypeid;
          var HashKey = result.data.HashKey;
          var AuthToken = result.data.AuthToken;

        
          var otp = document.querySelector('#otp');
          var otp_l = document.querySelector('#otp_l');
          
            otp.style.display = "block";
            otp_l.style.display = "block";
            

          

          response = '<div class="gen alert alert-success">' + result.message + '</div>';
          $('.book-appointment-message').html(response).delay(5000).hide('slow');
          $(window).scrollTop($('.appointment-form').offset().top);
          $('#frontServiceBuy')[0].reset();



        //   if (result.data.payment_type == card) {
        //       setTimeout(function () {
        //           location.reload();
        //         }, 1200);
        //   }
        
        //   if (result.data === manually) {
        //     setTimeout(function () {
        //       location.reload();
        //     }, 1200);
        //   }
        }
      },
      error: function error(result) {
        $('.book-appointment-message').css('display', 'block');
        response = '<div class="gen alert alert-danger">' + result.responseJSON.message + '</div>';
        $(window).scrollTop($('.appointment-form').offset().top);
        $('.book-appointment-message').html(response).delay(5000).hide('slow');
      },
      complete: function complete() {
        setFrontBtnLoader(btnSaveEle);
      }
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

$(document).ready(function () {
    $(dateEle).removeAttr('disabled');
    $.ajax({
      url: route('get-service'),
      type: 'GET',
      data: {
        // 'doctorId': $('#doctorId').val()
      },
      success: function success(result) {
        if (result.success) {
          $(dateEle).removeAttr('disabled');
          $('#serviceId').empty();
          $('#serviceId').append($('<option value=""></option>').text('Select Service'));
          $.each(result.data, function (i, v) {
            $('#serviceId').append($('<option></option>').attr('value', v.id).text(v.name));
          });
          $("#serviceId").selectpicker("refresh");
        }
      }
    });
  

  var payableAmount = '';
  var charge = '';

  if (!($('#serviceId').val() == '')) {
    $.ajax({
      url: route('get-charge'),
      type: 'GET',
      data: {
        'chargeId': $('#serviceId').val()
      },
      success: function success(result) {
        if (result.success) {
          $('#payableAmountText').removeClass('d-none');
          $('#payableAmount').text(currencyIcon + ' ' + getFormattedPrice(result.data.charges));
          payableAmount = result.data.charges;
          charge = result.data.charges;
        }
      }
    });
  }

  if (!selectedDate) {
    return false;
  }

  $('#slotData').html('');
  $.ajax({
    url: route('doctor-session-time'),
    type: 'GET',
    data: {
      'doctorId': $('#doctorId').val(),
      'date': selectedDate,
      'timezone_offset_minutes': timezone_offset_minutes
    },
    success: function success(result) {
      if (result.success) {
        $.each(result.data['slots'], function (index, value) {
          $('.no-time-slot').addClass('d-none');

          if (result.data['bookedSlot'] == null) {
            $('#slotData').append('<span class="time-slot col-2" data-id="' + value + '">' + value + '</span>');
          } else {
            if ($.inArray(value, result.data['bookedSlot']) !== -1) {
              $('#slotData').append('<span class="time-slot col-2 bookedSlot " data-id="' + value + '">' + value + '</span>');
            } else {
              $('#slotData').append('<span class="time-slot col-2" data-id="' + value + '">' + value + '</span>');
            }
          }
        });
      }
    },
    error: function error(result) {
      $('.book-appointment-message').css('display', 'block');
      var response = '<div class="gen alert alert-danger">' + result.responseJSON.message + '</div>';
      $('.book-appointment-message').html(response).delay(5000).hide('slow');
    }
  });
});

window.setFrontBtnLoader = function (btnLoader) {
  if (btnLoader.attr('data-old-text')) {
    btnLoader.html(btnLoader.attr('data-old-text')).prop('disabled', false);
    btnLoader.removeAttr('data-old-text');
    return;
  }

  btnLoader.attr('data-old-text', btnLoader.text());
  btnLoader.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled', true);
};

function storeFailedPayment(response) {
  $.ajax({
    type: 'POST',
    url: route('razorpay.failed'),
    data: {
      data: response
    },
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
      }
    },
    error: function error() {}
  });
}
/******/ })()
;