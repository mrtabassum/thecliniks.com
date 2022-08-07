'use strict';

let tableName = '#doctorSessionsTable';
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
            url: recordsURL,
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '30%',
            },
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
            {
                'targets': [1],
                'width': '20%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    let reviewHtmlData  = getAvgReviewHtmlData(row.doctor.reviews)
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.doctor.user.profile_image}" alt=""
                                 class="w-100 object-cover">
                        </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <div class="d-inline-block align-self-center d-flex">
                            <a href="${route('doctors.show', row.doctor_id)}"
                                class="text-primary-800 mb-1 d-inline-block align-self-center">${row.doctor.user.full_name}</a>
                                <div class="star-ratings d-inline-block align-self-center ms-2">
                                     ${reviewHtmlData}
                                </div>
                        </div>
                        <span class="d-block text-muted fw-bold">${row.doctor.user.email}</span>
                    </div>`;
                },
                name: 'doctor.user.first_name',
            },
            {
                data: function ({ session_meeting_time }) {
                    return `<span class="badge badge-light-primary fs-7">${session_meeting_time}</span>`;
                },
                name: 'session_meeting_time',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'editUrl': recordsEditURL + '/' + row.id + '/edit',
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
    deleteItem((recordsEditURL + '/' + recordId), tableName,
        'Doctor Schedule');
});
