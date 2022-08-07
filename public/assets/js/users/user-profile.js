/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/assets/js/users/user-profile.js ***!
  \***************************************************/


$(document).on('click', '#changePassword', function () {
  $('#changePasswordForm')[0].reset();
  $('.pass-check-meter div.flex-grow-1').removeClass('active');
  $('#changePasswordModal').modal('show').appendTo('body');
});
$(document).on('click', '#passwordChangeBtn', function () {
  $.ajax({
    url: changePasswordUrl,
    type: 'PUT',
    data: $('#changePasswordForm').serialize(),
    success: function success(result) {
      $('#changePasswordModal').modal('hide');
      $('#changePasswordForm')[0].reset();
      displaySuccessMessage(result.message);
      setTimeout(function () {
        location.reload();
      }, 1000);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});

window.printErrorMessage = function (selector, errorResult) {
  $(selector).show().html('');
  $(selector).text(errorResult.message);
};

$(document).on('click', '#emailNotification', function () {
  $('#emailNotificationModal').modal('show').appendTo('body');
  $('#emailNotificationForm')[0].reset();
});
$(document).on('click', '#emailNotificationChange', function () {
  $.ajax({
    url: route('emailNotification'),
    type: 'PUT',
    data: $('#emailNotificationForm').serialize(),
    success: function success(result) {
      $('#emailNotificationModal').modal('hide');
      displaySuccessMessage(result.message);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$(document).on('click', '.changeLanguage', function () {
  var languageName = $(this).data('prefix-value');
  $.ajax({
    type: 'POST',
    url: updateLanguageURL,
    data: {
      languageName: languageName
    },
    success: function success(result) {
      displaySuccessMessage(result.message);
      setTimeout(function () {
        location.reload();
      }, 1000);
    }
  });
});
/******/ })()
;