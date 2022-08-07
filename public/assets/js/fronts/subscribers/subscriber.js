/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**************************************************************!*\
  !*** ./resources/assets/js/fronts/subscribers/subscriber.js ***!
  \**************************************************************/


var tableName = '#subscribersTable';
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
      url: route('subscribers.index')
    },
    columnDefs: [{
      'targets': [1],
      'orderable': false,
      'searchable': false,
      'className': 'text-center',
      'width': '8%'
    }],
    columns: [{
      data: 'email',
      name: 'email'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id
        }];
        return prepareTemplateRender('#subscriberActionTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '.delete-btn', function () {
  var subscriberId = $(this).attr('data-id');
  deleteItem(route('subscribers.destroy', subscriberId), tableName, 'Subscriber');
});
/******/ })()
;