/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!******************************************************!*\
  !*** ./resources/assets/js/fronts/sliders/slider.js ***!
  \******************************************************/


var tableName = '#slidersTable';
$(document).ready(function () {
  var tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[1, 'asc']],
    ajax: {
      url: route('sliders.index')
    },
    columnDefs: [{
      'targets': [0],
      'width': '5%',
      'sortable': false
    }, {
      'targets': [3],
      'orderable': false,
      'className': 'text-center',
      'width': '8%'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                                <div class=\"symbol-label\">\n                                    <img src=\"".concat(row.slider_image, "\" alt=\"\"\n                                         class=\"w-100\">\n                                </div>\n                            </div>");
      },
      name: 'id'
    }, {
      data: 'title',
      name: 'title'
    }, {
      data: 'short_description',
      name: 'short_description'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': route('sliders.edit', row.id)
        }];
        return prepareTemplateRender('#sliderActionsTemplates', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
}); // $(document).on('click', '.delete-btn', function (event) {
//     let recordId = $(event.currentTarget).data('id');
//     deleteItem(route('sliders.destroy', recordId), tableName, 'Slider');
// });
/******/ })()
;