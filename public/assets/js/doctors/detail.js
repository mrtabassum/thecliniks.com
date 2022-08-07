/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/assets/js/doctors/detail.js ***!
  \***********************************************/


var tableName = '#doctorAppointmentDataTable';
$(document).ready(function () {
  var start = moment().startOf('week');
  var end = moment().endOf('week');
  var filterDate = $('#patientAppointmentDateFilter');

  function cb(start, end) {
    filterDate.html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
  }

  filterDate.daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'This Week': [moment().startOf('week'), moment().endOf('week')],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  }, cb);
  cb(start, end);
  var Url = doctorRole == true ? route('doctors.doctors.appointment') : route('doctors.appointment');
  var tbl = $('#doctorAppointmentDataTable').DataTable({
    deferRender: true,
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [1, 'desc'],
    ajax: {
      url: Url,
      data: function data(_data) {
        _data.status = $('#appointmentStatus').find('option:selected').val();
        _data.doctorId = doctorID;
        _data.filter_date = filterDate.val();
      }
    },
    columnDefs: [{
      'targets': [0],
      'width': '30%'
    }, {
      'targets': [1],
      'width': '30%'
    }, {
      'targets': [2],
      'width': '20%'
    }, {
      'targets': [3],
      'width': '8%',
      'className': 'text-center pr-0'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                        <div class=\"symbol-label\">\n                            <img src=\"".concat(row.patient.profile, "\" alt=\"\"\n                                 class=\"w-100 object-cover\">\n                        </div>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <a href=\"").concat(doctorRole == true ? route('doctors.patient.detail', row.patient.id) : route('patients.show', row.patient.id), "\"\n                           class=\"text-primary-800 mb-1 d-block\">").concat(row.patient.user.full_name, "</a>\n                           <span class=\"d-block text-muted fw-bold\">").concat(row.patient.user.email, "</span>\n                    </div>");
      },
      name: 'patient.user.full_name'
    }, {
      data: function data(row) {
        return "<span class=\"badge badge-light-info\">".concat(moment(row.date).format('Do MMM, Y '), " ").concat(row.from_time, " ").concat(row.from_time_type, " - ").concat(row.to_time, " ").concat(row.to_time_type, "</span>");
      },
      name: 'date'
    }, {
      data: function data(row) {
        var status = row.status;
        var colours = ['danger', 'primary', 'success', 'warning', 'danger'];
        return "\n                            <div class=\"w-150px d-flex align-items-center\">\n                            <span class=\"slot-color-dot bg-".concat(colours[status], " rounded-circle me-2\"></span>\n                            <select class=\"form-select-sm form-select-solid form-select status-change appointment-status\" data-id=\"").concat(row.id, "\">\n                                    <option class=\"booked\" disabled value=\"").concat(book, "\" ").concat(row.status == book ? 'selected' : '', ">Booked</option>\n                                    <option value=\"").concat(checkIn, "\" ").concat(row.status == checkIn ? 'selected' : '', " ").concat(row.status == checkIn ? 'selected' : '', " ").concat(row.status == cancel || row.status == checkOut ? 'disabled' : '', ">Check In</option>\n                                    <option value=\"").concat(checkOut, "\" ").concat(row.status == checkOut ? 'selected' : '', " ").concat(row.status == cancel || row.status == book ? 'disabled' : '', ">Check Out</option>\n                                    <option value=\"").concat(cancel, "\" ").concat(row.status == cancel ? 'selected' : '', " ").concat(row.status == checkIn ? 'disabled' : '', " ").concat(row.status == checkOut ? 'disabled' : '', ">Cancelled</option>\n                            </select>\n                            </div>");
      },
      name: 'status'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'role': userRole,
          'showUrl': route('appointments.show', row.id)
        }];
        return prepareTemplateRender('#appointmentsTemplate', data);
      },
      name: 'id'
    }],
    'fnInitComplete': function fnInitComplete() {
      $('#appointmentStatus').change(function () {
        $('#filter').removeClass('show');
        $('#filterBtn').removeClass('show');
        $('#doctorAppointmentDataTable').DataTable().ajax.reload(null, true);
      });
      $('#patientAppointmentDateFilter').change(function () {
        $('#doctorAppointmentDataTable').DataTable().ajax.reload(null, true);
      });
    },
    drawCallback: function drawCallback() {
      $('.appointment-status').select2();
    }
  });
  handleSearchDatatable(tbl);
});
$(document).on('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  var url = !isEmpty(userRole) ? route('patients.appointments.destroy', recordId) : route('appointments.destroy', recordId);
  deleteItem(url, tableName, 'Appointment');
});
$(document).on('change', '.status-change', function () {
  var appointmentStatus = $(this).val();
  var appointmentId = $(this).data('id');
  var currentData = $(this);
  $.ajax({
    url: route('change-status', appointmentId),
    type: 'POST',
    data: {
      appointmentId: appointmentId,
      appointmentStatus: appointmentStatus
    },
    success: function success(result) {
      $(currentData).children('option.booked').addClass('hide');
      $('#doctorAppointmentDataTable').DataTable().ajax.reload(null, true);
      displaySuccessMessage(result.message);
    }
  });
});
$(document).on('click', '#resetFilter', function () {
  $('#appointmentStatus').val(book).trigger('change');
  $('#patientAppointmentDateFilter').val(moment().startOf('week').format('MM/DD/YYYY') + ' - ' + moment().endOf('week').format('MM/DD/YYYY')).trigger('change');
});
/******/ })()
;