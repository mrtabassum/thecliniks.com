/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/assets/js/staff/create-edit.js ***!
  \**************************************************/


$(document).ready(function () {
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
$('#createStaffForm,#editStaffForm').on('submit', function () {
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