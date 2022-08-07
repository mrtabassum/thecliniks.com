/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/assets/js/services/services.js ***!
  \**************************************************/


var tableName = '#servicesTable';
$(document).ready(function () {
  var tbl = $(tableName).DataTable({
    deferRender: true,
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[1, 'asc']],
    ajax: {
      url: route('services.index'),
      data: function data(_data) {
        _data.status = $('#servicesStatus').find('option:selected').val();
      }
    },
    columnDefs: [{
      'targets': [0],
      'width': '8%',
      'orderable': false,
      'searchable': false
    }, {
      'targets': [2],
      'width': '25%'
    }, {
      'targets': [3],
      'width': '20%'
    }, {
      'targets': [4],
      'width': '5%',
      'className': 'text-center',
      'orderable': false,
      'searchable': false
    }, {
      'targets': [5],
      'orderable': false,
      'className': 'text-center',
      'width': '8%'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                        <div class=\"symbol-label\">\n                            <img src=\"".concat(row.icon, "\" alt=\"\"\n                                 class=\"w-100 object-cover\">\n                        </div>\n                    </div>");
      },
      name: 'icon'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: 'service_category.name',
      name: 'service_category.name'
    }, {
      data: function data(row) {
        return currencyIcon + ' ' + getFormattedPrice(row.charges);
      },
      name: 'charges'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'status': row.status
        }];
        return prepareTemplateRender('#servicesTemplate', data);
      },
      name: 'status'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': route('services.edit', row.id)
        }];
        return prepareTemplateRender('#actionsTemplates', data);
      },
      name: 'id'
    }],
    'fnInitComplete': function fnInitComplete() {
      $('#servicesStatus').change(function () {
        $('#filter').removeClass('show');
        $('#filterBtn').removeClass('show');
        $('#servicesTable').DataTable().ajax.reload(null, true);
      });
    }
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '#resetFilter', function () {
  $('#servicesStatus').val(all).trigger('change');
});
$(document).on('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('services.destroy', recordId), tableName, 'Service');
});
$(document).on('click', '.service-statusbar', function (event) {
  var recordId = $(event.currentTarget).data('id');
  $.ajax({
    type: 'PUT',
    url: route('service.status'),
    data: {
      id: recordId
    },
    success: function success(result) {
      displaySuccessMessage(result.message);
    }
  });
});
/******/ })()
;