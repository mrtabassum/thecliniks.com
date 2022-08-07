/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/assets/js/cities/cities.js ***!
  \**********************************************/


var tableName = '#citiesTable';
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
      url: route('cities.index')
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
      data: 'state.name',
      name: 'state.name'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id
        }];
        return prepareTemplateRender('#citiesTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '#createCity', function () {
  $('#createCityModal').modal('show').appendTo('body');
});
$('#createCityModal').on('hidden.bs.modal', function () {
  resetModalForm('#createCityForm', '#createCityValidationErrorsBox');
  $('#stateCity').val(null).trigger('change');
});
$('#editCityModal').on('hidden.bs.modal', function () {
  resetModalForm('#editCityForm', '#editCityValidationErrorsBox');
});
$(document).on('click', '.edit-btn', function (event) {
  var id = $(event.currentTarget).data('id');
  renderData(id);
});

function renderData(id) {
  $.ajax({
    url: route('cities.edit', id),
    type: 'GET',
    success: function success(result) {
      $('#cityID').val(result.data.id);
      $('#editName').val(result.data.name);
      $('#editStateId').val(result.data.state_id).trigger('change');
      $('#editCityModal').modal('show');
    }
  });
}

$(document).on('submit', '#createCityForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('cities.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#createCityModal').modal('hide');
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$(document).on('submit', '#editCityForm', function (e) {
  e.preventDefault();
  var formData = $(this).serialize();
  var id = $('#cityID').val();
  $.ajax({
    url: route('cities.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      $('#editCityModal').modal('hide');
      displaySuccessMessage(result.message);
      $(tableName).DataTable().ajax.reload(null, false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$(document).on('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('cities.destroy', recordId), tableName, 'City');
});
/******/ })()
;