/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/assets/js/visits/create-edit.js ***!
  \***************************************************/


$(document).ready(function () {
  $('#date').flatpickr({
    disableMobile: true
  });
  $('#editDate').flatpickr({
    disableMobile: true
  });
});
$(document).on('submit', '#saveForm', function (e) {
  e.preventDefault();
  $('#btnSubmit').attr('disabled', true);
  $('#saveForm')[0].submit();
});
/******/ })()
;