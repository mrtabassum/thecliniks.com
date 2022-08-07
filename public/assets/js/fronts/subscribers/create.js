/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************************************!*\
  !*** ./resources/assets/js/fronts/subscribers/create.js ***!
  \**********************************************************/


$(document).on('submit', '#subscribeForm', function (e) {
  e.preventDefault(); // let btnLoader = $(this).find('button[type="submit"]');
  // setBtnLoader(btnLoader);

  $.ajax({
    url: route('subscribe.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        toastr.success(result.message);
        $('#subscribeForm')[0].reset();
        setTimeout(function () {
          location.reload();
        }, 1200);
      }
    },
    error: function error(_error) {
      toastr.error(_error.responseJSON.message);
      $('#subscribeForm')[0].reset();
    },
    complete: function complete() {// setBtnLoader(btnLoader);
    }
  });
});
/******/ })()
;