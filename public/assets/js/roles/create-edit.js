/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/assets/js/roles/create-edit.js ***!
  \**************************************************/


$(document).ready(function () {
  var totalPermissionsCount = totalPermissions - 1;
  var checkAllLength = $('.permission:checked').length;

  if (isEdit == true) {
    if (checkAllLength === totalPermissionsCount) {
      $('#checkAllPermission').prop('checked', true);
    } else {
      $('#checkAllPermission').prop('checked', false);
    }
  }
});
$(document).on('click', '#checkAllPermission', function () {
  if ($('#checkAllPermission').is(':checked')) {
    $('.permission').each(function () {
      $(this).prop('checked', true);
    });
  } else {
    $('.permission').each(function () {
      $(this).prop('checked', false);
    });
  }
});
$(document).on('click', '.permission', function () {
  var checkAllLength = $('.permission:checked').length;
  var totalPermissionsCount = totalPermissions - 1;

  if (checkAllLength === totalPermissionsCount) {
    $('#checkAllPermission').prop('checked', true);
  } else {
    $('#checkAllPermission').prop('checked', false);
  }
});
/******/ })()
;