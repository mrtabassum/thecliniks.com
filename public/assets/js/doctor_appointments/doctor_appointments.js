/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!************************************************************************!*\
  !*** ./resources/assets/js/doctor_appointments/doctor_appointments.js ***!
  \************************************************************************/


var tableName = '#doctorAppointmentTable';
$(document).ready(function () {
  var start = moment().startOf('week');
  var end = moment().endOf('week');
  var filterDate = $('#appointmentDate');

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
  var tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[1, 'desc']],
    ajax: {
      url: route('doctors.appointments'),
      data: function data(_data) {
        _data.status = $('#doctorAppointmentStatus').find('option:selected').val();
        _data.payment_type = $('#doctorPaymentStatus').find('option:selected').val();
        _data.filter_date = filterDate.val();
      }
    },
    columnDefs: [{
      'targets': [0],
      'width': '25%'
    }, {
      'targets': [1],
      'width': '20%'
    }, {
      'targets': [3],
      'width': '15%',
      'className': 'text-center',
      'searchable': false
    }, {
      'targets': [4],
      'orderable': false,
      'searchable': false
    }, {
      'targets': [5],
      'className': 'text-center',
      'orderable': false
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                            <div class=\"symbol-label\">\n                                <img src=\"".concat(row.patient.profile, "\" alt=\"\"\n                                     class=\"w-100 object-cover  \">\n                            </div>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <a class=\"text-primary-800 mb-1 d-block\">").concat(row.patient.user.full_name, "</a>\n                        <span class=\"d-block text-muted fw-bold\">").concat(row.patient.user.email, "</span>\n                    </div>");
      },
      name: 'patient.user.full_name'
    }, {
      data: function data(row) {
        return "<div class=\"badge badge-light-info\">\n                                <div class=\"mb-2\">".concat(row.from_time, " ").concat(row.from_time_type, " - ").concat(row.to_time, " ").concat(row.to_time_type, "</div>\n                                <div class=\"\">").concat(moment(row.date).format('Do MMM, Y '), "</div>\n                            </div>");
      },
      name: 'date'
    }, {
      data: function data(row) {
        return currencyIcon + ' ' + addCommas(row.payable_amount);
      },
      name: 'payable_amount'
    }, {
      data: function data(row) {
        return "\n                        <select class=\"form-select-sm form-select-solid form-select change-payment-status payment-status\" data-id=\"".concat(row.id, "\">\n                                <option value=\"").concat(paid, "\" ").concat(row.payment_type == paid ? 'selected' : '', ">Paid</option>\n                                <option value=\"").concat(pending, "\" ").concat(row.payment_type == paid ? 'disabled' : 'selected', ">Pending</option>\n                        </select>");
      },
      name: 'payment_type'
    }, {
      data: function data(row) {
        var status = row.status;
        var colours = ['danger', 'primary', 'success', 'warning', 'danger'];
        return "\n                            <div class=\"w-150px d-flex align-items-center\">\n                            <span class=\"slot-color-dot bg-".concat(colours[status], " rounded-circle me-2\"></span>\n                            <select class=\"form-select-sm form-select-solid form-select status-change doctor-appointment-status\" data-id=\"").concat(row.id, "\">\n                                    <option class=\"booked\" disabled value=\"").concat(book, "\" ").concat(row.status == book ? 'selected' : '', ">Booked</option>\n                                    <option value=\"").concat(checkIn, "\" ").concat(row.status == checkIn ? 'selected' : '', " ").concat(row.status == checkIn ? 'selected' : '', " ").concat(row.status == cancel || row.status == checkOut ? 'disabled' : '', ">Check In</option>\n                                    <option value=\"").concat(checkOut, "\" ").concat(row.status == checkOut ? 'selected' : '', " ").concat(row.status == cancel || row.status == book ? 'disabled' : '', ">Check Out</option>\n                                    <option value=\"").concat(cancel, "\" ").concat(row.status == cancel ? 'selected' : '', " ").concat(row.status == checkIn ? 'disabled' : '', " ").concat(row.status == checkOut ? 'disabled' : '', ">Cancelled</option>\n                            </select>\n                            </div>");
      },
      name: 'status'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'showUrl': route('doctors.appointment.detail', row.id)
        }];
        return prepareTemplateRender('#appointmentsTemplate', data);
      },
      name: 'id'
    }],
    'fnInitComplete': function fnInitComplete() {
      $('#doctorAppointmentStatus').change(function () {
        $('#filter').removeClass('show');
        $('#filterBtn').removeClass('show');
        $('#doctorAppointmentTable').DataTable().ajax.reload(null, true);
      });
      $('#doctorPaymentStatus').change(function () {
        $('#filter').removeClass('show');
        $('#filterBtn').removeClass('show');
        $('#doctorAppointmentTable').DataTable().ajax.reload(null, true);
      });
      $('#appointmentDate').change(function () {
        $('#doctorAppointmentTable').DataTable().ajax.reload(null, true);
      });
    },
    drawCallback: function drawCallback() {
      $('.payment-status, .doctor-appointment-status').select2();
    }
  });
  handleSearchDatatable(tbl);
  $(document).on('click', '#resetFilter', function () {
    $('#doctorPaymentStatus').val(allPaymentCount).trigger('change');
    $('#doctorAppointmentStatus').val(book).trigger('change');
    filterDate.data('daterangepicker').setStartDate(moment().startOf('week').format('MM/DD/YYYY'));
    filterDate.data('daterangepicker').setEndDate(moment().endOf('week').format('MM/DD/YYYY'));
  });
});
$(document).on('change', '.status-change', function () {
  var appointmentStatus = $(this).val();
  var appointmentId = $(this).data('id');
  var currentData = $(this);
  $.ajax({
    url: route('doctors.change-status', appointmentId),
    type: 'POST',
    data: {
      appointmentId: appointmentId,
      appointmentStatus: appointmentStatus
    },
    success: function success(result) {
      $(currentData).children('option.booked').addClass('hide');
      $('#doctorAppointmentTable').DataTable().ajax.reload(null, true);
      displaySuccessMessage(result.message);
    }
  });
});
$(document).on('change', '.change-payment-status', function () {
  var paymentStatus = $(this).val();
  var appointmentId = $(this).data('id');
  $('#paymentStatusModal').modal('show').appendTo('body');
  $('#paymentStatus').val(paymentStatus);
  $('#appointmentId').val(appointmentId);
});
$(document).on('submit', '#paymentStatusForm', function (event) {
  event.preventDefault();
  var paymentStatus = $('#paymentStatus').val();
  var appointmentId = $('#appointmentId').val();
  var paymentMethod = $('#paymentType').val();
  $.ajax({
    url: route('doctors.change-payment-status', appointmentId),
    type: 'POST',
    data: {
      appointmentId: appointmentId,
      paymentStatus: paymentStatus,
      paymentMethod: paymentMethod
    },
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#paymentStatusModal').modal('hide');
        location.reload();
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
/******/ })()
;