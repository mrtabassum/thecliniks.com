/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/assets/js/staff/staff.js ***!
  \********************************************/


var tableName = '#staffTable';
$(document).ready(function () {
  var tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show_MENU_'
    },
    'order': [[0, 'asc']],
    ajax: {
      url: route('staff.index')
    },
    columnDefs: [{
      'targets': [0],
      'width': '50%'
    }, {
      'targets': [2],
      'orderable': false,
      'searchable': false
    }, // {
    //     'targets': [3],
    //     'orderable': false,
    //     'className': 'text-center',
    // },
    {
      'targets': [3],
      'orderable': false,
      'className': 'text-center',
      'width': '8%'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                        <div class=\"symbol-label\">\n                            <img src=\"".concat(row.profile_image, "\" alt=\"\"\n                                 class=\"w-100 object-cover\">\n                        </div> \n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <a href=\"").concat(route('staff.show', row.id), "\"\n                           class=\"text-primary-800 mb-1 d-block\">").concat(row.full_name, "</a>\n                           <span class=\"d-block\">").concat(row.email, "</span>\n                    </div>");
      },
      name: 'full_name'
    }, {
      data: 'role_name',
      name: 'role_name'
    }, {
      data: function data(row) {
        return "<div class=\"form-check form-switch form-check-custom form-check-solid justify-content-center\">\n                            <input class=\"form-check-input h-20px w-30px email-verified\" data-id=\"".concat(row.id, "\" type=\"checkbox\" value=\"\"\n                               ").concat(row.email_verified_at ? 'checked' : '', "/>\n                            </div>");
      },
      name: 'id'
    }, // {
    //     data: function (row) {
    //         return `<td class=" text-center action-table-btn">
    //             <a title="Impersonate ${row.full_name}" class="btn btn-sm btn-primary" href="${ route('impersonate', row.id) }">
    //                 Impersonate
    //             </a>
    //             </td>`;
    //     },
    //     name: 'id',
    // },
    {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': route('staff.edit', row.id),
          'userId': row.id,
          'emailVerified': isEmpty(row.email_verified_at)
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
  deleteItem(route('staff.destroy', recordId), tableName, 'Staff');
});
$(document).on('change', '.email-verified', function (e) {
  var recordId = $(e.currentTarget).data('id');
  var value = $(this).is(':checked') ? 1 : 0;
  $.ajax({
    type: 'POST',
    url: route('emailVerified'),
    data: {
      id: recordId,
      value: value
    },
    success: function success(result) {
      $(tableName).DataTable().ajax.reload(null, false);
      displaySuccessMessage(result.message);
    }
  });
});
$(document).on('click', '.email-verification', function (event) {
  var userId = $(event.currentTarget).data('id');
  $.ajax({
    type: 'POST',
    url: route('resend.email.verification', userId),
    success: function success(result) {
      $(tableName).DataTable().ajax.reload(null, false);
      displaySuccessMessage(result.message);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
/******/ })()
;