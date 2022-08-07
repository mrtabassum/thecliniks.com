/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/assets/js/visits/visits.js ***!
  \**********************************************/


var tableName = '#visitsTable';
$(document).ready(function () {
  var tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[2, 'desc']],
    ajax: {
      url: visitUrl
    },
    columnDefs: [{
      'targets': [0],
      'width': '30%'
    }, {
      'targets': [1],
      'width': '30%'
    }, {
      'targets': [2],
      'width': '18%'
    }, {
      'targets': [3],
      'orderable': false,
      'className': 'text-center',
      'width': '12%'
    }],
    columns: [{
      data: function data(row) {
        var reviewHtmlData = getAvgReviewHtmlData(row.visit_doctor.reviews);
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                        <a href=\"javascript:void(0)\">\n                            <div class=\"symbol-label\">\n                                <img src=\"".concat(row.visit_doctor.user.profile_image, "\" alt=\"\"\n                                     class=\"w-100 object-cover\">\n                            </div>\n                        </a>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <div class=\"d-inline-block align-self-center d-flex\">\n                            <a href=\"").concat(route('doctors.show', row.visit_doctor.id), "\"\n                           class=\"text-primary-800 mb-1 d-inline-block align-self-center\">").concat(row.visit_doctor.user.full_name, "</a>\n                            <div class=\"star-ratings d-inline-block align-self-center ms-2\">\n                                ").concat(reviewHtmlData, "\n                            </div>\n                        </div>\n                        <span class=\"d-block\">").concat(row.visit_doctor.user.email, "</span>\n                    </div>");
      },
      name: 'visit_doctor.user.full_name'
    }, {
      data: function data(row) {
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                        <a href=\"javascript:void(0)\">\n                            <div class=\"symbol-label\">\n                                <img src=\"".concat(row.visit_patient.profile, "\" alt=\"\"\n                                     class=\"w-100 object-cover\">\n                            </div>\n                        </a>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <a href=\"").concat(route('patients.show', row.visit_patient.id), "\"\n                           class=\"text-primary-800 mb-1 d-block\">").concat(row.visit_patient.user.full_name, "</a>\n                        <span class=\"d-block\">").concat(row.visit_patient.user.email, "</span>\n                    </div>");
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
          'editUrl': route('visits.edit', row.id),
          'showUrl': route('visits.show', row.id)
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
  deleteItem(route('visits.destroy', recordId), tableName, 'Visit');
});
/******/ })()
;