/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************************************************!*\
  !*** ./resources/assets/js/service_categories/service_categories.js ***!
  \**********************************************************************/


var tableName = '#serviceCategoriesTable';
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
      url: route('service-categories.index')
    },
    columnDefs: [{
      'targets': [0],
      'width': '40%'
    }, {
      'targets': [1],
      'className': 'text-center'
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
        return "<span class=\"badge badge-light-danger\">".concat(row.services_count, "</span>");
      },
      name: 'services_count'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id
        }];
        return prepareTemplateRender('#serviceCategoriesTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '#createServiceCategory', function () {
  $('#createServiceCategoryModal').modal('show').appendTo('body');
});
$('#createServiceCategoryModal').on('hidden.bs.modal', function () {
  resetModalForm('#createServiceCategoryForm', '#createServiceCategoryValidationErrorsBox');
});
$('#editServiceCategoryModal').on('hidden.bs.modal', function () {
  resetModalForm('#editServiceCategoryForm', '#editServiceCategoryValidationErrorsBox');
});
$(document).on('click', '.edit-btn', function (event) {
  var id = $(event.currentTarget).data('id');
  renderData(id);
});

function renderData(id) {
  $.ajax({
    url: route('service-categories.edit', id),
    type: 'GET',
    success: function success(result) {
      $('#serviceCategoryID').val(result.data.id);
      $('#editName').val(result.data.name);
      $('#editServiceCategoryModal').modal('show');
    }
  });
}

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
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$(document).on('submit', '#editServiceCategoryForm', function (e) {
  e.preventDefault();
  var formData = $(this).serialize();
  var id = $('#serviceCategoryID').val();
  $.ajax({
    url: route('service-categories.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      $('#editServiceCategoryModal').modal('hide');
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
  deleteItem(route('service-categories.destroy', recordId), tableName, 'Service Category');
});
/******/ })()
;