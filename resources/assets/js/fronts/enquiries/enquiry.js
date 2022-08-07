'use strict';

let tableName = '#enquiriesTable';
$(document).ready(function () {
    let tbl = $(tableName).DataTable({
        deferRender: true,
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[3, 'desc']],
        ajax: {
            url: route('enquiries.index'),
            data: function (data) {
                data.status = $('#enquiriesStatus').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [4],
                'orderable': false,
                'searchable': false,
                'className': 'text-center',
                'width': '8%',
            }, {
                'targets': [0],
                'width': '20%',
            }, {
                'targets': [2, 3],
                'width': '12%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="d-inline-block align-top">
                        <a class="text-primary-800 mb-1 d-block">${row.name}</a>
                        <span class="d-block text-muted fw-bold">${row.email}</span>
                    </div>`;
                },
                name: 'name',
            },
            {
                data: function (row) {
                    let messageLength = row.message;

                    if (row.message.length >= 55) {
                        return messageLength.substring(0, 55) + '...';
                    }
                    return row.message;
                },
                name: 'message',
            }, 
            {
                data: function (row) {
                    if (row.view) {
                        return `<div class="badge badge-light-success">${row.view_name}</div>`;
                    } else {
                        return `<div class="badge badge-light-danger">${row.view_name}</div>`;
                    }
                },
                name: 'view_name',
            }, {
                data: function (row) {
                    return `<div class="badge badge-light-info">
                                <div class="">${moment.parseZone(row.created_at).
                        format('Do MMM, Y h:mm A')}</div>
                            </div>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'showUrl': route('enquiries.show', row.id),
                        },
                    ];

                    return prepareTemplateRender('#enquiryActionTemplate',
                        data);
                },
                name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#enquiriesStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#enquiriesTable').DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#enquiriesStatus').val(all).trigger('change');
});

$(document).on('click', '.delete-btn', function () {
    let enquiryId = $(this).attr('data-id');
    deleteItem(route('enquiries.destroy', enquiryId), tableName, 'Enquiry');
});
