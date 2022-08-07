'use strict';

let tableName = '#patientVisitsTable';
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
            url: route('patients.patient.visits.index'),
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
                'width': '4%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    let reviewHtmlData  = getAvgReviewHtmlData(row.visit_doctor.reviews)
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                <img src="${row.visit_doctor.user.profile_image}" alt=""
                                     class="w-100 object-cover">
                            </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <div class="d-inline-block align-self-center d-flex">
                            <a class="text-primary-800 mb-1 d-inline-block align-self-center">${row.visit_doctor.user.full_name}</a>
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
                            'showUrl': route('patients.patient.visits.show',
                                row.id),
                        },
                    ];

                    return prepareTemplateRender('#patientVisitsTemplate',
                        data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
