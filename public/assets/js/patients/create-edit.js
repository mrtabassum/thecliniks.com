/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/js/patients/create-edit.js ***!
  \*****************************************************/


$(document).ready(function () {
  $('#dob').flatpickr({
    maxDate: new Date(),
    disableMobile: true
  });
  $('#countryId').val(countryId).trigger('change');
  setTimeout(function () {
    $('#stateId').val(stateId).trigger('change');
  }, 300);
  setTimeout(function () {
    $('#cityId').val(cityId).trigger('change');
  }, 500);
  $('input[type=radio][name=gender]').on('change', function () {
    var file = $('#profilePicture').val();

    if (isEmpty(file)) {
      if (this.value == 1) {
        $('.image-input-wrapper').attr('style', 'background-image:url(' + manAvatar + ')');
      } else if (this.value == 2) {
        $('.image-input-wrapper').attr('style', 'background-image:url(' + womanAvatar + ')');
      }
    }
  });
});
$('#countryId').on('change', function () {
  $('#stateId').empty();
  $('#cityId').empty();
  $.ajax({
    url: route('states-list'),
    type: 'get',
    dataType: 'json',
    data: {
      countryId: $(this).val()
    },
    success: function success(data) {
      $('#stateId').empty();
      $('#cityId').empty();
      $('#stateId').append($('<option value=""></option>').text('Select State'));
      $('#cityId').append($('<option value=""></option>').text('Select City'));
      $.each(data.data, function (i, v) {
        $('#stateId').append($('<option></option>').attr('value', i).text(v));
      });
    }
  });
});
$('#stateId').on('change', function () {
  $('#cityId').empty();
  $.ajax({
    url: route('cities-list'),
    type: 'get',
    dataType: 'json',
    data: {
      stateId: $(this).val()
    },
    success: function success(data) {
      $('#cityId').empty();
      $('#cityId').append($('<option value=""></option>').text('Select City'));
      $.each(data.data, function (i, v) {
        $('#cityId').append($('<option></option>').attr('value', i).text(v));
      });

      if (isEdit && cityId) {
        $('#cityId').val(cityId).trigger('change');
      }
    }
  });
});
$('#createPatientForm,#editPatientForm').on('submit', function () {
  if ($('#error-msg').text() !== '') {
    $('#phoneNumber').focus();
    displayErrorMessage("Contact number is " + $('#error-msg').text());
    return false;
  }
});
$(document).on('click', '.removeAvatarIcon', function () {
  $('#bgImage').css('background-image', '');
  $('#bgImage').css('background-image', 'url(' + backgroundImg + ')');
  $('#removeAvatar').addClass('hide');
  $('#tooltip287851').addClass('hide');
});
/******/ })()
;