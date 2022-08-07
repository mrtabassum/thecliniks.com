/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/js/services/create-edit.js ***!
  \*****************************************************/


$(document).ready(function () {
  var price = $('.price-input').val();

  if (price === '') {
    $('.price-input').val('');
  } else {
    if (/[0-9]+(,[0-9]+)*$/.test(price)) {
      $('.price-input').val(getFormattedPrice(price));
      return true;
    } else {
      $('.price-input').val(price.replace(/[^0-9 \,]/, ''));
    }
  }
});
$(document).on('click', '#createServiceCategory', function () {
  $('#createServiceCategoryModal').modal('show').appendTo('body');
});
$(document).on('submit', '#createServiceCategoryForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('service-categories.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#createServiceCategoryModal').modal('hide');
        var data = {
          id: result.data.id,
          name: result.data.name
        };
        var newOption = new Option(data.name, data.id, false, true);
        $('#serviceCategory').append(newOption).trigger('change');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {
      processingBtn('#createServiceCategoryForm', '#btnSave');
    }
  });
});
$('#createServiceCategoryModal').on('hidden.bs.modal', function () {
  resetModalForm('#createServiceCategoryForm', '#createServiceCategoryValidationErrorsBox');
});
/******/ })()
;