'use strict';

let tableName = '#faqsTable';
let tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[1, 'asc']],
    ajax: {
        url: route('faqs.index'),
    },
    columnDefs: [
        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
        },
    ],
    columns: [
        {
            data: 'question',
            name: 'question',
        },
        {
            data: 'answer',
            name: 'answer',
        },
        {
            data: function (row) {
                let data = [
                    {
                        'id': row.id,
                        'editUrl': route('faqs.edit', row.id),
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

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('faqs.destroy', recordId), tableName, 'FAQ');
});
