'use strict';

let tableName = '#transactionsTable';
$(document).ready(function () {
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: route('transactions'),
        },
        columnDefs: [
            {
                'targets': [1],
                'width': '28%',
                'className': 'text-center',
            },
            {
                'targets': [2],
                'width': '18%',
            },
            {
                'targets': [4],
                'orderable': false,
                'searchable': false,
                'className': 'text-center',
                'width': '8%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.user.profile_image}" alt=""
                                 class="w-100 object-cover">
                        </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${route('patients.show', row.user.patient.id)}"
                           class="text-primary-800 mb-1 d-block">${row.user.full_name}</a>
                        <span class="d-block text-muted fw-bold">${row.user.email}</span>
                    </div>`;
                },
                name: 'user.first_name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info">${moment.parseZone(
                        row.created_at).format('Do MMM, Y h:mm A')}</span>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    if (row.type == manuallyMethod){    
                        return manually;
                    }
                    if (row.type == stripeMethod){
                        return stripe;
                    }
                    if (row.type == paystckMethod){
                        return paystck;
                    }
                    if (row.type == paypalMethod){
                        return paypal;
                    }
                    if (row.type == razorpayMethod){
                        return razorpay;
                    }
                    if (row.type == authorizeMethod){
                        return authorize;
                    }
                    if (row.type == paytmMethod){
                        return paytm;
                    }
                    return '';
                },
                name: 'type',
            },
            {
                data: function (row) {
                    return currencyIcon + ' ' + getFormattedPrice(row.amount);
                },
                name: 'amount',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'showUrl': route('transactions.show', row.id),
                        },
                    ];

                    return prepareTemplateRender('#transactionsTemplate',
                        data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
