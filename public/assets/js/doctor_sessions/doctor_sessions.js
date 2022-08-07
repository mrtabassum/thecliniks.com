/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!****************************************************************!*\
  !*** ./resources/assets/js/doctor_sessions/doctor_sessions.js ***!
  \****************************************************************/


var tableName = '#doctorSessionsTable';
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
      url: recordsURL
    },
    columnDefs: [{
      'targets': [0],
      'width': '30%'
    }, {
      'targets': [2],
      'orderable': false,
      'className': 'text-center',
      'width': '8%'
    }, {
      'targets': [1],
      'width': '20%'
    }],
    columns: [{
      data: function data(row) {
        var reviewHtmlData = getAvgReviewHtmlData(row.doctor.reviews);
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                        <div class=\"symbol-label\">\n                            <img src=\"".concat(row.doctor.user.profile_image, "\" alt=\"\"\n                                 class=\"w-100 object-cover\">\n                        </div>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <div class=\"d-inline-block align-self-center d-flex\">\n                            <a href=\"").concat(route('doctors.show', row.doctor_id), "\"\n                                class=\"text-primary-800 mb-1 d-inline-block align-self-center\">").concat(row.doctor.user.full_name, "</a>\n                                <div class=\"star-ratings d-inline-block align-self-center ms-2\">\n                                     ").concat(reviewHtmlData, "\n                                </div>\n                        </div>\n                        <span class=\"d-block text-muted fw-bold\">").concat(row.doctor.user.email, "</span>\n                    </div>");
      },
      name: 'doctor.user.first_name'
    }, {
      data: function data(_ref) {
        var session_meeting_time = _ref.session_meeting_time;
        return "<span class=\"badge badge-light-primary fs-7\">".concat(session_meeting_time, "</span>");
      },
      name: 'session_meeting_time'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': recordsEditURL + '/' + row.id + '/edit'
        }];
        return prepareTemplateRender('#actionsTemplates', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(recordsEditURL + '/' + recordId, tableName, 'Doctor Schedule');
});
/******/ })()
;