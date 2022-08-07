/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!****************************************************************!*\
  !*** ./resources/assets/js/google_calendar/google_calendar.js ***!
  \****************************************************************/


$(document).on('click', '#syncGoogleCalendar', function () {
  var btnSubmitEle = $(this);
  setAdminBtnLoader(btnSubmitEle);
  $.ajax({
    url: route('syncGoogleCalendarList'),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        setTimeout(function () {
          location.reload();
        }, 1200);
      }
    },
    complete: function complete() {
      setAdminBtnLoader(btnSubmitEle);
    }
  });
});
$(document).on('submit', '#googleCalendarForm', function (e) {
  e.preventDefault();

  if (!$('.google-calendar').is(':checked')) {
    displayErrorMessage('Please select a calendar.');
    return;
  }

  var url = '';

  if (!isEmpty(doctorRole)) {
    url = route('doctors.appointmentGoogleCalendar.store');
  } else if (!isEmpty(patientRole)) {
    url = route('patients.appointmentGoogleCalendar.store');
  }

  $.ajax({
    url: url,
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        setTimeout(function () {
          location.reload();
        }, 1200);
      }
    },
    error: function error(_error) {
      displayErrorMessage(_error.responseJSON.message);
    }
  });
});
/******/ })()
;