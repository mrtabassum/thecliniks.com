'use strict';

let tableName = '#statesTable';
$(document).ready(function () {
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'asc']],
        ajax: {
            url: route('states.index'),
        },
        columnDefs: [
            {
                'targets': [0, 1],
                'width': '20%',
            },
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
        ],
        columns: [
            {
                data: 'name',
                name: 'name',
            }, {
                data: 'country.name',
                name: 'country.name',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        },
                    ];

                    return prepareTemplateRender('#statesTemplate',
                        data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#addState', function () {
    $('#addStateModal').modal('show').appendTo('body');
});

$(document).on('submit', '#addStateForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('states.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addStateModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('click', '.edit-btn', function (event) {
    $('#editStateModal').modal('show').appendTo('body');
    let id = $(event.currentTarget).data('id');
    $('#editStateId').val(id);

    $.ajax({
        url: route('states.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#editStateName').val(result.data.name);
                $('#selectCountry').val(result.data.country_id).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('submit', '#editStateForm', function (event) {
    event.preventDefault();
    let id = $('#editStateId').val();
    let formData = $(this).serialize();

    $.ajax({
        url: route('states.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editStateModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$('#addStateModal').on('hidden.bs.modal', function (e) {
    $('#addStateForm')[0].reset();
    $('#countryState').val(null).trigger('change');
})

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('states.destroy', recordId), tableName, 'State');
});
