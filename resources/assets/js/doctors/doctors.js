'use strict';

let tableName = '#doctorTable';
$(document).ready(function () {
    let tbl = $(tableName).DataTable({
        deferRender: true,
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[4, 'desc']],
        ajax: {
            url: route('doctors.index'),
            data: function (data) {
                data.status = $('#doctorStatus').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '30%',
            },
            {
                'targets': [4],
                'width': '20%',
                'className': 'text-center',
            },
            {
                'targets': [1],
                'width': '5%',
                'orderable': false,
                'searchable': false,
            },
            {
                'targets': [5],
                'width': '13%',
                'class': 'text-center',
                'orderable': false,
                'searchable': false,
            },
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center',
            },
            {
                'targets': [2],
                'orderable': false,
                'searchable': false,
            },
        ],
        columns: [
            {
                data: function (row) {
                    let reviewHtmlData  = getAvgReviewHtmlData(row.reviews)
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.user.profile_image}" alt=""
                                 class="w-100 object-cover">
                        </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <div class="d-inline-block align-self-center d-flex">
                            <a href="${route('doctors.show', row.id)}"
                            class="text-primary-800 mb-1 d-inline-block align-self-center">${row.user.full_name}</a>
                            <div class="star-ratings d-inline-block align-self-center ms-2">
                                ${reviewHtmlData}
                            </div>
                        </div>
                        <span class="d-block text-muted fw-bold">${row.user.email}</span>
                    </div>`;
                },
                name: 'user.full_name',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.user.id,
                            'status': row.user.status,
                        },
                    ];
                    return prepareTemplateRender('#changeDoctorStatus', data);
                },
                name: 'user.status',
            },
            {
                data: function (row) {
                    return `<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
                            <input class="form-check-input h-20px w-30px email-verified" data-id="${row.user.id}" type="checkbox" value=""
                               ${row.user.email_verified_at ? 'checked' : ''} />
                            </div>`;
                },
                name: 'user.id',
            },
            {
                data: function (row) {
                    return `<td class=" text-center action-table-btn">
                        <a title="Impersonate ${row.user.full_name}" class="btn btn-sm btn-primary" href="${ route('impersonate', row.user.id) }">
                            Impersonate
                        </a>
                        </td>`;
                },
                name: 'user.id',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.created_at === null) {
                        return 'N/A';
                    }

                    return `<span class="badge badge-light-info">${moment.parseZone(
                        row.created_at).format('Do MMM, Y h:mm A')}</span>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'userId': row.user_id,
                            'editUrl': route('doctors.edit', row.id),
                            'emailVerified': isEmpty(row.user.email_verified_at),
                        },
                    ];

                    return prepareTemplateRender('#userActionTemplate',
                        data);
                },
                name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#doctorStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#doctorTable').DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#doctorStatus').val(all).trigger('change');
});

$(document).on('click', '.delete-btn', function () {
    let userId = $(this).attr('data-id');
    let deleteUserUrl = route('doctors.destroy', userId);
    deleteItem(deleteUserUrl, '#doctorTable', 'Doctor');
});

$(document).on('click', '.add-qualification', function () {
    let userId = $(this).attr('data-id');
    $('#qualificationID').val(userId);
    $('#qualificationModal').modal('show');
});

$(document).on('submit', '#qualificationForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('add.qualification'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#year').val(null).trigger('change');
                $('#qualificationModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$('#qualificationModal').on('hidden.bs.modal', function () {
    resetModalForm('#qualificationForm');
    $('#year').val(null).trigger('change');
});

$(document).on('click', '.doctor-status', function (event) {
    let recordId = $(event.currentTarget).data('id');

    $.ajax({
        type: 'PUT',
        url: route('doctor.status'),
        data: { id: recordId },
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

$(document).on('change','.email-verified',function(e){
    let recordId = $(e.currentTarget).data('id');
    let value = $(this).is(':checked') ? 1 : 0;
    $.ajax({
        type: 'POST',
        url: route('emailVerified'),
        data: { 
            id: recordId,
            value : value
        },
        success: function (result) {
            $(tableName).DataTable().ajax.reload(null, false);
            displaySuccessMessage(result.message);
        },
    });
});
