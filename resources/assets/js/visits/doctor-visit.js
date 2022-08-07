'use strict';

let tableName = '#visitsTable';
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
            url: doctorVisitUrl,
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '30%',
            },
            {
                'targets': [1],
                'width': '30%',
            },
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center',
                'width': '12%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                <img src="${row.visit_patient.profile}" alt=""
                                     class="w-100 object-cover">
                            </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <a class="text-primary-800 mb-1 d-block">${row.visit_patient.user.full_name}</a>
                        <span class="d-block">${row.visit_patient.user.email}</span>
                    </div>`;
                },
                name: 'visit_patient.user.full_name',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.visit_date === null) {
                        return 'N/A';
                    }

                    return `<span class="badge badge-light-info">${moment(
                        row.visit_date).format('Do MMM, Y')}</span>`;
                },
                name: 'visit_date',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'editUrl': route('doctors.visits.edit', row.id),
                            'showUrl': route('doctors.visits.show', row.id),
                        },
                    ];

                    return prepareTemplateRender('#visitsTemplate',
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
    deleteItem(route('doctors.visits.destroy', recordId), tableName, 'Visit');
});
