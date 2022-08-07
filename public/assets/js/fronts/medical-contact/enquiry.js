/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***************************************************************!*\
  !*** ./resources/assets/js/fronts/medical-contact/enquiry.js ***!
  \***************************************************************/


$(document).on('submit', '#enquiryForm', function (e) {
  e.preventDefault();
  var btnLoader = $(this).find('button[type="submit"]');
  setBtnLoader(btnLoader);
  $.ajax({
    url: route('enquiries.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        toastr.success(result.message);
        $('#enquiryForm')[0].reset();
        setTimeout(function () {
          location.reload();
        }, 1200);
      }
    },
    error: function error(_error) {
      toastr.error(_error.responseJSON.message);
    },
    complete: function complete() {
      setBtnLoader(btnLoader);
    }
  });
});
/******/ })()
;