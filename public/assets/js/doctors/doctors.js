/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/assets/js/doctors/doctors.js ***!
  \************************************************/


var tableName = '#doctorTable';
$(document).ready(function () {
  var tbl = $(tableName).DataTable({
    deferRender: true,
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[4, 'desc']],
    ajax: {
      url: route('doctors.index'),
      data: function data(_data) {
        _data.status = $('#doctorStatus').find('option:selected').val();
      }
    },
    columnDefs: [{
      'targets': [0],
      'width': '30%'
    }, {
      'targets': [4],
      'width': '20%',
      'className': 'text-center'
    }, {
      'targets': [1],
      'width': '5%',
      'orderable': false,
      'searchable': false
    }, {
      'targets': [5],
      'width': '13%',
      'class': 'text-center',
      'orderable': false,
      'searchable': false
    }, {
      'targets': [3],
      'orderable': false,
      'className': 'text-center'
    }, {
      'targets': [2],
      'orderable': false,
      'searchable': false
    }],
    columns: [{
      data: function data(row) {
        var reviewHtmlData = getAvgReviewHtmlData(row.reviews);
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                        <div class=\"symbol-label\">\n                            <img src=\"".concat(row.user.profile_image, "\" alt=\"\"\n                                 class=\"w-100 object-cover\">\n                        </div>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <div class=\"d-inline-block align-self-center d-flex\">\n                            <a href=\"").concat(route('doctors.show', row.id), "\"\n                            class=\"text-primary-800 mb-1 d-inline-block align-self-center\">").concat(row.user.full_name, "</a>\n                            <div class=\"star-ratings d-inline-block align-self-center ms-2\">\n                                ").concat(reviewHtmlData, "\n                            </div>\n                        </div>\n                        <span class=\"d-block text-muted fw-bold\">").concat(row.user.email, "</span>\n                    </div>");
      },
      name: 'user.full_name'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.user.id,
          'status': row.user.status
        }];
        return prepareTemplateRender('#changeDoctorStatus', data);
      },
      name: 'user.status'
    }, {
      data: function data(row) {
        return "<div class=\"form-check form-switch form-check-custom form-check-solid justify-content-center\">\n                            <input class=\"form-check-input h-20px w-30px email-verified\" data-id=\"".concat(row.user.id, "\" type=\"checkbox\" value=\"\"\n                               ").concat(row.user.email_verified_at ? 'checked' : '', " />\n                            </div>");
      },
      name: 'user.id'
    }, {
      data: function data(row) {
        return "<td class=\" text-center action-table-btn\">\n                        <a title=\"Impersonate ".concat(row.user.full_name, "\" class=\"btn btn-sm btn-primary\" href=\"").concat(route('impersonate', row.user.id), "\">\n                            Impersonate\n                        </a>\n                        </td>");
      },
      name: 'user.id'
    }, {
      data: function data(row) {
        return row;
      },
      render: function render(row) {
        if (row.created_at === null) {
          return 'N/A';
        }

        return "<span class=\"badge badge-light-info\">".concat(moment.parseZone(row.created_at).format('Do MMM, Y h:mm A'), "</span>");
      },
      name: 'created_at'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'userId': row.user_id,
          'editUrl': route('doctors.edit', row.id),
          'emailVerified': isEmpty(row.user.email_verified_at)
        }];
        return prepareTemplateRender('#userActionTemplate', data);
      },
      name: 'id'
    }],
    'fnInitComplete': function fnInitComplete() {
      $('#doctorStatus').change(function () {
        $('#filter').removeClass('show');
        $('#filterBtn').removeClass('show');
        $('#doctorTable').DataTable().ajax.reload(null, true);
      });
    }
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '#resetFilter', function () {
  $('#doctorStatus').val(all).trigger('change');
});
$(document).on('click', '.delete-btn', function () {
  var userId = $(this).attr('data-id');
  var deleteUserUrl = route('doctors.destroy', userId);
  deleteItem(deleteUserUrl, '#doctorTable', 'Doctor');
});
$(document).on('click', '.add-qualification', function () {
  var userId = $(this).attr('data-id');
  $('#qualificationID').val(userId);
  $('#qualificationModal').modal('show');
});
$(document).on('submit', '#qualificationForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('add.qualification'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#year').val(null).trigger('change');
        $('#qualificationModal').modal('hide');
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$('#qualificationModal').on('hidden.bs.modal', function () {
  resetModalForm('#qualificationForm');
  $('#year').val(null).trigger('change');
});
$(document).on('click', '.doctor-status', function (event) {
  var recordId = $(event.currentTarget).data('id');
  $.ajax({
    type: 'PUT',
    url: route('doctor.status'),
    data: {
      id: recordId
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
/******/ })()
;