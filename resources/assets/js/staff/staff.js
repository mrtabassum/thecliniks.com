'use strict';

let tableName = '#staffTable';
$(document).ready(function () {
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show_MENU_',
        },
        'order': [[0, 'asc']],
        ajax: {
            url: route('staff.index'),
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '50%',
            },
            {
                'targets': [2],
                'orderable': false,
                'searchable': false,
            },
            // {
            //     'targets': [3],
            //     'orderable': false,
            //     'className': 'text-center',
            // },
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.profile_image}" alt=""
                                 class="w-100 object-cover">
                        </div> 
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${route('staff.show', row.id)}"
                           class="text-primary-800 mb-1 d-block">${row.full_name}</a>
                           <span class="d-block">${row.email}</span>
                    </div>`;
                },
                name: 'full_name',
            },
            {
                data: 'role_name',
                name: 'role_name',
            },
            {
                data: function (row) {
                    return `<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
                            <input class="form-check-input h-20px w-30px email-verified" data-id="${row.id}" type="checkbox" value=""
                               ${row.email_verified_at ? 'checked' : ''}/>
                            </div>`;
                },
                name: 'id',
            },
            // {
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
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'editUrl': route('staff.edit', row.id),
                            'userId': row.id,
                            'emailVerified': isEmpty(row.email_verified_at),
                        },
                    ];

                    return prepareTemplateRender('#actionsTemplates',
                        data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('staff.destroy', recordId), tableName, 'Staff');
});

$(document).on('change','.email-verified',function(e){
    let recordId = $(e.currentTarget).data('id');
    let value = $(this).is(':checked') ? 1 : 0;
    $.ajax({
        type: 'POST',
        url: route('emailVerified'),
        data: { 
            id: recordId,
            value: value
        },
        success: function (result) {
            $(tableName).DataTable().ajax.reload(null, false);
            displaySuccessMessage(result.message);
        },
    });
});

$(document).on('click', '.email-verification', function (event) {
    let userId = $(event.currentTarget).data('id');
    $.ajax({
        type: 'POST',
        url: route('resend.email.verification', userId),
        success: function (result) {
            $(tableName).DataTable().ajax.reload(null, false);
            displaySuccessMessage(result.message);
        },
        error: function (result){
            displayErrorMessage(result.responseJSON.message);
        }
    });
});
