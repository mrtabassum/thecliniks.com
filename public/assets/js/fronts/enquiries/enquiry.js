/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*********************************************************!*\
  !*** ./resources/assets/js/fronts/enquiries/enquiry.js ***!
  \*********************************************************/


var tableName = '#enquiriesTable';
$(document).ready(function () {
  var tbl = $(tableName).DataTable({
    deferRender: true,
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[3, 'desc']],
    ajax: {
      url: route('enquiries.index'),
      data: function data(_data) {
        _data.status = $('#enquiriesStatus').find('option:selected').val();
      }
    },
    columnDefs: [{
      'targets': [4],
      'orderable': false,
      'searchable': false,
      'className': 'text-center',
      'width': '8%'
    }, {
      'targets': [0],
      'width': '20%'
    }, {
      'targets': [2, 3],
      'width': '12%'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"d-inline-block align-top\">\n                        <a class=\"text-primary-800 mb-1 d-block\">".concat(row.name, "</a>\n                        <span class=\"d-block text-muted fw-bold\">").concat(row.email, "</span>\n                    </div>");
      },
      name: 'name'
    }, {
      data: function data(row) {
        var messageLength = row.message;

        if (row.message.length >= 55) {
          return messageLength.substring(0, 55) + '...';
        }

        return row.message;
      },
      name: 'message'
    }, {
      data: function data(row) {
        if (row.view) {
          return "<div class=\"badge badge-light-success\">".concat(row.view_name, "</div>");
        } else {
          return "<div class=\"badge badge-light-danger\">".concat(row.view_name, "</div>");
        }
      },
      name: 'view_name'
    }, {
      data: function data(row) {
        return "<div class=\"badge badge-light-info\">\n                                <div class=\"\">".concat(moment.parseZone(row.created_at).format('Do MMM, Y h:mm A'), "</div>\n                            </div>");
      },
      name: 'created_at'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'showUrl': route('enquiries.show', row.id)
        }];
        return prepareTemplateRender('#enquiryActionTemplate', data);
      },
      name: 'id'
    }],
    'fnInitComplete': function fnInitComplete() {
      $('#enquiriesStatus').change(function () {
        $('#filter').removeClass('show');
        $('#filterBtn').removeClass('show');
        $('#enquiriesTable').DataTable().ajax.reload(null, true);
      });
    }
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '#resetFilter', function () {
  $('#enquiriesStatus').val(all).trigger('change');
});
$(document).on('click', '.delete-btn', function () {
  var enquiryId = $(this).attr('data-id');
  deleteItem(route('enquiries.destroy', enquiryId), tableName, 'Enquiry');
});
/******/ })()
;