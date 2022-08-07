/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*************************************************************!*\
  !*** ./resources/assets/js/patient_visits/patient-visit.js ***!
  \*************************************************************/


var tableName = '#patientVisitsTable';
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
      url: route('patients.patient.visits.index')
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
      'width': '4%'
    }],
    columns: [{
      data: function data(row) {
        var reviewHtmlData = getAvgReviewHtmlData(row.visit_doctor.reviews);
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                            <div class=\"symbol-label\">\n                                <img src=\"".concat(row.visit_doctor.user.profile_image, "\" alt=\"\"\n                                     class=\"w-100 object-cover\">\n                            </div>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <div class=\"d-inline-block align-self-center d-flex\">\n                            <a class=\"text-primary-800 mb-1 d-inline-block align-self-center\">").concat(row.visit_doctor.user.full_name, "</a>\n                            <div class=\"star-ratings d-inline-block align-self-center ms-2\">\n                                ").concat(reviewHtmlData, "\n                            </div>\n                        </div>\n                        <span class=\"d-block\">").concat(row.visit_doctor.user.email, "</span>\n                    </div>");
      },
      name: 'visit_doctor.user.full_name'
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
          'showUrl': route('patients.patient.visits.show', row.id)
        }];
        return prepareTemplateRender('#patientVisitsTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
});
/******/ })()
;