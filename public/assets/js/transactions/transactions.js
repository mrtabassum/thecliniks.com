/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************************************!*\
  !*** ./resources/assets/js/transactions/transactions.js ***!
  \**********************************************************/


var tableName = '#transactionsTable';
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
      url: route('transactions')
    },
    columnDefs: [{
      'targets': [1],
      'width': '28%',
      'className': 'text-center'
    }, {
      'targets': [2],
      'width': '18%'
    }, {
      'targets': [4],
      'orderable': false,
      'searchable': false,
      'className': 'text-center',
      'width': '8%'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                        <div class=\"symbol-label\">\n                            <img src=\"".concat(row.user.profile_image, "\" alt=\"\"\n                                 class=\"w-100 object-cover\">\n                        </div>\n                    </div>\n                    <div class=\"d-inline-block align-top\">\n                        <a href=\"").concat(route('patients.show', row.user.patient.id), "\"\n                           class=\"text-primary-800 mb-1 d-block\">").concat(row.user.full_name, "</a>\n                        <span class=\"d-block text-muted fw-bold\">").concat(row.user.email, "</span>\n                    </div>");
      },
      name: 'user.first_name'
    }, {
      data: function data(row) {
        return "<span class=\"badge badge-light-info\">".concat(moment.parseZone(row.created_at).format('Do MMM, Y h:mm A'), "</span>");
      },
      name: 'created_at'
    }, {
      data: function data(row) {
        if (row.type == manuallyMethod) {
          return manually;
        }

        if (row.type == stripeMethod) {
          return stripe;
        }

        if (row.type == paystckMethod) {
          return paystck;
        }

        if (row.type == paypalMethod) {
          return paypal;
        }

        if (row.type == razorpayMethod) {
          return razorpay;
        }

        if (row.type == authorizeMethod) {
          return authorize;
        }

        if (row.type == paytmMethod) {
          return paytm;
        }

        return '';
      },
      name: 'type'
    }, {
      data: function data(row) {
        return currencyIcon + ' ' + getFormattedPrice(row.amount);
      },
      name: 'amount'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'showUrl': route('transactions.show', row.id)
        }];
        return prepareTemplateRender('#transactionsTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(tbl);
});
/******/ })()
;