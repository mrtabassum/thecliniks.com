/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/assets/js/visits/doctor-visit.js ***!
  \****************************************************/


var tableName = '#visitsTable';
$(document).ready(function () {
  var tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[1, 'desc']],
    ajax: {
      url: doctorVisitUrl
    },
    columnDefs: [{
      'targets': [0],
      'width': '30%'
    }, {
      'targets': [1],
      'width': '30%'
    }, {
      'targets': [2],
      'orderable': false,
      'className': 'text-center',
      'width': '12%'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                            <div class=\"symbol-label\">\n                                <img src=\"".concat(row.visit_patient.profile, "\" alt=\"\"\n                                     class=\"w-100 object-cover\">\n                            </div>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <a class=\"text-primary-800 mb-1 d-block\">").concat(row.visit_patient.user.full_name, "</a>\n                        <span class=\"d-block\">").concat(row.visit_patient.user.email, "</span>\n                    </div>");
      },
      name: 'visit_patient.user.full_name'
    }, {
      data: function data(row) {
        return row;
      },
      render: function render(row) {
        if (row.visit_date === null) {
          return 'N/A';
        }

        return "<span class=\"badge badge-light-info\">".concat(moment(row.visit_date).format('Do MMM, Y'), "</span>");
      },
      name: 'visit_date'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': route('doctors.visits.edit', row.id),
          'showUrl': route('doctors.visits.show', row.id)
        }];
        return prepareTemplateRender('#visitsTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('doctors.visits.destroy', recordId), tableName, 'Visit');
});
/******/ })()
;