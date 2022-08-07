'use strict';

let tableName = '#slidersTable';
$(document).ready(function () {
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'asc']],
        ajax: {
            url: route('sliders.index'),
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '5%',
                'sortable': false,
            },
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <div class="symbol-label">
                                    <img src="${row.slider_image}" alt=""
                                         class="w-100">
                                </div>
                            </div>`;
                },
                name: 'id',
            },
            {
                data: 'title',
                name: 'title',
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
                            'editUrl': route('sliders.edit', row.id),
                        },
                    ];
                    return prepareTemplateRender('#sliderActionsTemplates', data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

// $(document).on('click', '.delete-btn', function (event) {
//     let recordId = $(event.currentTarget).data('id');
//     deleteItem(route('sliders.destroy', recordId), tableName, 'Slider');
// });
