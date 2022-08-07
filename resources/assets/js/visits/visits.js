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
        'order': [[2, 'desc']],
        ajax: {
            url: visitUrl,
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
                'width': '18%',
            },
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center',
                'width': '12%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    let reviewHtmlData  = getAvgReviewHtmlData(row.visit_doctor.reviews)
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="javascript:void(0)">
                            <div class="symbol-label">
                                <img src="${row.visit_doctor.user.profile_image}" alt=""
                                     class="w-100 object-cover">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <div class="d-inline-block align-self-center d-flex">
                            <a href="${route('doctors.show',
                        row.visit_doctor.id)}"
                           class="text-primary-800 mb-1 d-inline-block align-self-center">${row.visit_doctor.user.full_name}</a>
                            <div class="star-ratings d-inline-block align-self-center ms-2">
                                ${reviewHtmlData}
                            </div>
                        </div>
                        <span class="d-block">${row.visit_doctor.user.email}</span>
                    </div>`;
                },
                name: 'visit_doctor.user.full_name',
            },
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="javascript:void(0)">
                            <div class="symbol-label">
                                <img src="${row.visit_patient.profile}" alt=""
                                     class="w-100 object-cover">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${route('patients.show',
                        row.visit_patient.id)}"
                           class="text-primary-800 mb-1 d-block">${row.visit_patient.user.full_name}</a>
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
                            'editUrl': route('visits.edit', row.id),
                            'showUrl': route('visits.show', row.id),
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
    deleteItem(route('visits.destroy', recordId), tableName, 'Visit');
});
