'use strict';

let tableName = '#currenciesTable';
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
            url: route('currencies.index'),
        },
        columnDefs: [
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
        ],
        columns: [
            {
                data: 'currency_name',
                name: 'currency_name',
            }, {
                data: 'currency_icon',
                name: 'currency_icon',
            }, {
                data: 'currency_code',
                name: 'currency_code',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'editUrl': route('currencies.edit', row.id),
                        },
                    ];

                    return prepareTemplateRender('#currenciesTemplate',
                        data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#createCurrency', function () {
    $('#createCurrencyModal').modal('show').appendTo('body');
});

$('#createCurrencyModal').on('hidden.bs.modal', function () {
    resetModalForm('#createCurrencyForm', '#createCurrencyValidationErrorsBox');
});

$('#editCurrencyModal').on('hidden.bs.modal', function () {
    resetModalForm('#editCurrencyForm', '#editCurrencyValidationErrorsBox');
});

$(document).on('click', '.edit-btn', function (event) {
    let id = $(event.currentTarget).data('id');
    renderData(id);
});

function renderData (id) {
    $.ajax({
        url: route('currencies.edit', id),
        type: 'GET',
        success: function (result) {
            $('#currencyID').val(result.data.id);
            $('#editCurrency_Name').val(result.data.currency_name);
            $('#editCurrency_Icon').val(result.data.currency_icon);
            $('#editCurrency_Code').val(result.data.currency_code);

            $('#editCurrencyModal').modal('show');
        },
    });
}

$(document).on('submit', '#createCurrencyForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('currencies.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#createCurrencyModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('submit', '#editCurrencyForm', function (e) {
    e.preventDefault();
    let formData = $(this).serialize();
    let id = $('#currencyID').val();
    $.ajax({
        url: route('currencies.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            $('#editCurrencyModal').modal('hide');
            displaySuccessMessage(result.message);
            $(tableName).DataTable().ajax.reload(null, false);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
        },
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('currencies.destroy', recordId), tableName, 'Currency');
});
