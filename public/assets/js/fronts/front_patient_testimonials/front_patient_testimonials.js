/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*********************************************************************************************!*\
  !*** ./resources/assets/js/fronts/front_patient_testimonials/front_patient_testimonials.js ***!
  \*********************************************************************************************/


var tableName = '#frontPatientTestimonialsTable';
var tbl = $(tableName).DataTable({
  processing: true,
  serverSide: true,
  searchDelay: 500,
  'language': {
    'lengthMenu': 'Show _MENU_'
  },
  'order': [[1, 'asc']],
  ajax: {
    url: route('front-patient-testimonials.index')
  },
  columnDefs: [{
    'targets': [2],
    'orderable': false,
    'className': 'text-center',
    'width': '8%'
  }, {
    'targets': [1],
    'width': '72%'
  }, {
    'targets': [0],
    'width': '20%',
    'className': 'whitespace-nowrap'
  }],
  columns: [{
    data: function data(row) {
      return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                        <a href=\"javascript:void(0)\">\n                            <div class=\"symbol-label\">\n                                <img src=\"".concat(row.front_patient_profile, "\" alt=\"\"\n                                     class=\"w-100 object-cover\">\n                            </div>\n                        </a>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <a href=\"javascript:void(0)\"\n                           class=\"text-primary-800 mb-1 d-block\">").concat(row.name, "</a>\n                           <span class=\"d-block text-muted fw-bold\">").concat(row.designation, "</span>\n                    </div>");
    },
    name: 'name'
  }, {
    data: 'short_description',
    name: 'short_description'
  }, {
    data: function data(row) {
      var data = [{
        'id': row.id,
        'editUrl': route('front-patient-testimonials.edit', row.id)
      }];
      return prepareTemplateRender('#actionsTemplates', data);
    },
    name: 'id'
  }]
});
handleSearchDatatable(tbl);
$(document).on('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('front-patient-testimonials.destroy', recordId), tableName, 'Front Patient Testimonial');
});
/******/ })()
;