/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./resources/assets/js/custom/custom-datatable.js ***!
  \********************************************************/


window.handleSearchDatatable = function (tbl) {
  $('input[name="search"][data-datatable-filter="search"]').unbind().bind('input', function (e) {
    if (this.value.length > 0 || e.keyCode == 13) {
      tbl.search(this.value).draw();
    }

    if (this.value == '') {
      tbl.search('').draw();
    }

    return;
  });
};

$.extend($.fn.dataTable.defaults, {
  'paging': true,
  'info': true,
  'ordering': true,
  'autoWidth': false,
  'pageLength': 10,
  'language': {
    'search': '',
    'sSearch': 'Search'
  },
  'preDrawCallback': function preDrawCallback() {
    customSearch();
  }
});

function customSearch() {
  $('.dataTables_filter input').addClass('form-control');
  $('.dataTables_filter input').attr('placeholder', 'Search');
}
/******/ })()
;