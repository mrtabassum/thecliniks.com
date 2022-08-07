'use strict';

let tableName = '#frontPatientTestimonialsTable';
let tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[1, 'asc']],
    ajax: {
        url: route('front-patient-testimonials.index'),
    },
    columnDefs: [
        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
        },
        {
            'targets': [1],
            'width': '72%',
        }, {
            'targets': [0],
            'width': '20%',
            'className': 'whitespace-nowrap',
        },
    ],
    columns: [
        {
            data: function (row) {
                return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="javascript:void(0)">
                            <div class="symbol-label">
                                <img src="${row.front_patient_profile}" alt=""
                                     class="w-100 object-cover">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="javascript:void(0)"
                           class="text-primary-800 mb-1 d-block">${row.name}</a>
                           <span class="d-block text-muted fw-bold">${row.designation}</span>
                    </div>`;
            },
            name: 'name',
        },
        {
            data: 'short_description',
            name: 'short_description',
        },
        {
            data: function (row) {
                let data = [
                    {
                        'id': row.id,
                        'editUrl': route('front-patient-testimonials.edit',
                            row.id),
                    },
                ];

                return prepareTemplateRender('#actionsTemplates', data);
            },
            name: 'id',
        },
    ],
});
handleSearchDatatable(tbl);

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('front-patient-testimonials.destroy', recordId), tableName,
        'Front Patient Testimonial');
});
