'use strict';

let tableName = '#specializationsTable';
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
            url: route('specializations.index'),
        },
        columnDefs: [
            {
                'targets': [1],
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
                    let data = [
                        {
                            'id': row.id,
                        },
                    ];
                    return prepareTemplateRender('#specializationsTemplate',
                        data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#createSpecialization', function () {
    $('#createSpecializationModal').modal('show').appendTo('body');
});

$('#createSpecializationModal').on('hidden.bs.modal', function () {
    resetModalForm('#createSpecializationForm',
        '#createSpecializationValidationErrorsBox');
});

$('#editSpecializationModal').on('hidden.bs.modal', function () {
    resetModalForm('#editSpecializationForm',
        '#editSpecializationValidationErrorsBox');
});

$(document).on('click', '.edit-btn', function (event) {
    let id = $(event.currentTarget).data('id');
    renderData(id);
});

function renderData (id) {
    $.ajax({
        url: route('specializations.edit', id),
        type: 'GET',
        success: function (result) {
            $('#specializationID').val(result.data.id);
            $('#editName').val(result.data.name);
            $('#editSpecializationModal').modal('show');
        },
    });
}

$(document).on('submit', '#createSpecializationForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('specializations.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#createSpecializationModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('submit', '#editSpecializationForm', function (e) {
    e.preventDefault();
    let formData = $(this).serialize();
    let id = $('#specializationID').val();
    $.ajax({
        url: route('specializations.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            $('#editSpecializationModal').modal('hide');
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
    deleteItem(route('specializations.destroy', recordId), tableName, 'Specialization');
});
