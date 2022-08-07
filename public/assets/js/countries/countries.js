/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/assets/js/countries/countries.js ***!
  \****************************************************/


var tableName = '#countriesTable';
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
      url: route('countries.index')
    },
    columnDefs: [{
      'targets': [0, 1],
      'width': '20%'
    }, {
      'targets': [2],
      'orderable': false,
      'className': 'text-center',
      'width': '8%'
    }],
    columns: [{
      data: 'name',
      name: 'name'
    }, {
      data: function data(row) {
        var _row$short_code;

        var shortCode = (_row$short_code = row.short_code) !== null && _row$short_code !== void 0 ? _row$short_code : 'N/A';
        return shortCode;
      },
      name: 'short_code'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id
        }];
        return prepareTemplateRender('#countriesTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('countries.destroy', recordId), tableName, 'Country');
});
$(document).on('click', '#addCountry', function () {
  $('#addCountryModal').modal('show').appendTo('body');
});
$(document).on('submit', '#addCountryForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('countries.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addCountryModal').modal('hide');
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$(document).on('click', '.edit-btn', function (event) {
  $('#editCountryModal').modal('show').appendTo('body');
  var id = $(event.currentTarget).data('id');
  $('#editCountryId').val(id);
  $.ajax({
    url: route('countries.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#editCountryName').val(result.data.name);
        $('#editShortCodeName').val(result.data.short_code);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$(document).on('submit', '#editCountryForm', function (event) {
  event.preventDefault();
  var formData = $(this).serialize();
  var id = $('#editCountryId').val();
  $.ajax({
    url: route('countries.update', id),
    type: 'POST',
    data: formData,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editCountryModal').modal('hide');
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$('#addCountryModal').on('hidden.bs.modal', function (e) {
  $('#addCountryForm')[0].reset();
});
/******/ })()
;