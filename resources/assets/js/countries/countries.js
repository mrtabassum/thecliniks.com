'use strict';

let tableName = '#countriesTable';
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
            url: route('countries.index'),
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
            },
            {
                data: function (row) {
                    let shortCode = row.short_code ?? 'N/A';
                    return shortCode;
                },
                name: 'short_code',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        },
                    ];

                    return prepareTemplateRender('#countriesTemplate',
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
        deleteItem(route('countries.destroy', recordId), tableName, 'Country');
    });

    $(document).on('click', '#addCountry', function () {
        $('#addCountryModal').modal('show').appendTo('body');
    });

    $(document).on('submit', '#addCountryForm', function (e) {
        e.preventDefault();
        $.ajax({
            url: route('countries.store'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addCountryModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.edit-btn', function (event) {
        $('#editCountryModal').modal('show').appendTo('body');
        let id = $(event.currentTarget).data('id');
        $('#editCountryId').val(id);

        $.ajax({
            url: route('countries.edit', id),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#editCountryName').val(result.data.name);
                    $('#editShortCodeName').val(result.data.short_code);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('submit', '#editCountryForm', function (event) {
        event.preventDefault();
        let formData = $(this).serialize();
        let id = $('#editCountryId').val();

        $.ajax({
            url: route('countries.update', id),
            type: 'POST',
            data: formData,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editCountryModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

$('#addCountryModal').on('hidden.bs.modal', function (e) {
    $('#addCountryForm')[0].reset();
});
