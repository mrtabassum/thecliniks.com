/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!************************************************************!*\
  !*** ./resources/assets/js/clinic_schedule/create-edit.js ***!
  \************************************************************/


$(document).on('submit', '#saveForm', function (e) {
  e.preventDefault();
  var data = new FormData($(this)[0]);
  $.ajax({
    url: route('checkRecord'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      saveUpdateForm(data);
    },
    error: function error(result) {
      Swal.fire({
        title: 'Delete !',
        text: result.responseJSON.message,
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        closeOnConfirm: true,
        confirmButtonColor: '#266CB0',
        showLoaderOnConfirm: true,
        cancelButtonText: 'No, Cancel',
        confirmButtonText: 'Yes, Update!'
      }).then(function (result) {
        if (result.isConfirmed) {
          saveUpdateForm(data);
        }
      });
    }
  });
});

function saveUpdateForm(data) {
  $.ajax({
    url: $(this).attr('action'),
    type: 'POST',
    data: data,
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        setTimeout(function () {
          location.reload();
        }, 1500);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {}
  });
}

$(document).on('change', 'select[name^="startTimes"]', function (e) {
  var selectedIndex = $(this)[0].selectedIndex;
  var endTimeOptions = $(this).closest('.weekly-row').find('select[name^="endTimes"] option');
  endTimeOptions.eq(selectedIndex + 1).prop('selected', true).trigger('change');
  endTimeOptions.each(function (index) {
    if (index <= selectedIndex) {
      $(this).attr('disabled', true);
    } else {
      $(this).attr('disabled', false);
    }
  });
});
/******/ })()
;