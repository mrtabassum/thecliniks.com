/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!******************************************************!*\
  !*** ./resources/assets/js/currencies/currencies.js ***!
  \******************************************************/


var tableName = '#currenciesTable';
$(document).ready(function () {
  var tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[0, 'asc']],
    ajax: {
      url: route('currencies.index')
    },
    columnDefs: [{
      'targets': [3],
      'orderable': false,
      'className': 'text-center',
      'width': '8%'
    }],
    columns: [{
      data: 'currency_name',
      name: 'currency_name'
    }, {
      data: 'currency_icon',
      name: 'currency_icon'
    }, {
      data: 'currency_code',
      name: 'currency_code'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': route('currencies.edit', row.id)
        }];
        return prepareTemplateRender('#currenciesTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '#createCurrency', function () {
  $('#createCurrencyModal').modal('show').appendTo('body');
});
$('#createCurrencyModal').on('hidden.bs.modal', function () {
  resetModalForm('#createCurrencyForm', '#createCurrencyValidationErrorsBox');
});
$('#editCurrencyModal').on('hidden.bs.modal', function () {
  resetModalForm('#editCurrencyForm', '#editCurrencyValidationErrorsBox');
});
$(document).on('click', '.edit-btn', function (event) {
  var id = $(event.currentTarget).data('id');
  renderData(id);
});

function renderData(id) {
  $.ajax({
    url: route('currencies.edit', id),
    type: 'GET',
    success: function success(result) {
      $('#currencyID').val(result.data.id);
      $('#editCurrency_Name').val(result.data.currency_name);
      $('#editCurrency_Icon').val(result.data.currency_icon);
      $('#editCurrency_Code').val(result.data.currency_code);
      $('#editCurrencyModal').modal('show');
    }
  });
}

$(document).on('submit', '#createCurrencyForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('currencies.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#createCurrencyModal').modal('hide');
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$(document).on('submit', '#editCurrencyForm', function (e) {
  e.preventDefault();
  var formData = $(this).serialize();
  var id = $('#currencyID').val();
  $.ajax({
    url: route('currencies.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      $('#editCurrencyModal').modal('hide');
      displaySuccessMessage(result.message);
      $(tableName).DataTable().ajax.reload(null, false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {}
  });
});
$(document).on('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('currencies.destroy', recordId), tableName, 'Currency');
});
/******/ })()
;