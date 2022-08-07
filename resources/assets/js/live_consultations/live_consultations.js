'use strict';

$(document).ready(function () {

    $('#consultationDate').flatpickr({
        enableTime: true,
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });

    $('.edit-consultation-date').flatpickr({
        enableTime: true,
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });

    let tbl = $('#liveConsultationTable').DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [8, 'desc'],
        ajax: {
            url: doctorRole ? route('doctors.live-consultation.index') : route('patients.live-consultation.index'),
            data: function (data) {
                data.status = $('#statusArr').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [1],
                'width': '15%',
            },
            {
                'targets': [5],
                'orderable': false,
                'width': '12%',
            },
            {
                'targets': [6],
                'orderable': true,
            },
            {
                'targets': [7],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '15%',
            },
            {
                'targets': [8],
                'visible': false,
            },
            {
                targets: '_all',
                defaultContent: 'N/A',
                'className': 'text-start align-middle text-nowrap',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<a href="#" class="show-data" data-id="' + row.id +
                        '">' + row.consultation_title + '</a>';
                },
                name: 'consultation_title',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.consultation_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(
                        row.consultation_date).format('LT')}</div>
                                <div>${moment(row.consultation_date).
                        format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'consultation_date',
            },
            {
                data: 'user.full_name',
                name: 'user.first_name',
            },
            {
                data: 'doctor.user.full_name',
                name: 'doctor.user.first_name',
            },
            {
                data: 'patient.user.full_name',
                name: 'patient.user.first_name',
            },
            {
                data: function (row) {
                    let status = row.status;
                    let colours = [
                        'warning',
                        'danger',
                        'success',
                    ];
                    if (adminRole || doctorRole) {
                        return `<div class="w-150px d-flex align-items-center">
                            <span class="slot-color-dot bg-${colours[status]} rounded-circle me-2"></span>
                            <select class="form-select-sm form-select-solid form-select change-status" data-id="${row.id}">` +
                            `<option value="0" ${status == 0 ? 'selected' : ''}
                                ${(status == 1 || status == 2)  ? 'disabled' : ''}>Awaited</option>
                            <option value="1" ${status == 1 ? 'selected' : ''}
                                ${(status == 2)  ? 'disabled' : ''}>Cancelled</option>
                            <option value="2" ${status == 2 ? 'selected' : ''}
                                ${(status == 1)  ? 'disabled' : ''}>Finished</option>`
                            + `</select></div>`;
                    }
                    if (row.status == 1) {
                        return `<span class="badge badge-light-danger fw-bolder ms-2 fs-8 py-1 px-3">Cancelled</span>`;
                    } else if (row.status == 0) {
                        return `<span class="badge badge-light-warning fw-bolder ms-2 fs-8 py-1 px-3">Awaited</span>`;
                    } else if (row.status == 2) {
                        return `<span class="badge badge-light-success fw-bolder ms-2 fs-8 py-1 px-3">Finished</span>`;
                    } else {
                        return row.status_text;
                    }
                },
                name: 'status',
            },
            {
                data: 'password',
                name: 'PASSWORD',
            },
            {
                data: function (row) {
                    let startUrl = row.meta.start_url;
                    let data = [
                        {
                            'id': row.id,
                            'status': row.status,
                            'url': (patientRole)
                                ? row.meta.join_url
                                : startUrl,
                            'title': (patientRole)
                                ? 'Join Meeting'
                                : 'Start Meeting',
                            'isDoctor': doctorRole,
                            'isAdmin': adminRole,
                            'isMeetingFinished': row.status == 2 ? true : false,
                        }];

                    return prepareTemplateRender(
                        '#liveConsultationActionTemplate',
                        data);
                }, name: 'id',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $('#statusArr').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#liveConsultationTable').DataTable().ajax.reload(null, true);
            });
        },
        drawCallback: function () {
            this.api().state.clear();
            $('.change-status').select2({
                width: '100%',
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#statusArr').val('').trigger('change');
});

$(document).on('click', '#addModalBtn', function () {
    resetModalForm('#addNewForm');
    $('#addDoctorID').trigger('change');
    $('#patientName').trigger('change');
    $('#consultationDate').flatpickr({
        enableTime: true,
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
        disableMobile: 'true',
    });
    $('#addModal').modal('show').appendTo('body');
});

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    setAdminBtnLoader(loadingButton);
    $.ajax({
        url: liveConsultationCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#liveConsultationTable').
                    DataTable().
                    ajax.
                    reload(null, false);
                setTimeout(function () {
                    loadingButton.button('reset');
                }, 2500);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            setTimeout(function () {
                loadingButton.button('reset');
            }, 2000);
        },
        complete: function () {
            setAdminBtnLoader(loadingButton);
        },
    });
});

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    setAdminBtnLoader(loadingButton);
    let id = $('#liveConsultationId').val();
    $.ajax({
        url: liveConsultationUrl + '/' + id,
        type: 'PUT',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#liveConsultationTable').
                    DataTable().
                    ajax.
                    reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            setAdminBtnLoader(loadingButton);
            loadingButton.button('reset');
        },
    });
});

$(document).on('change', '.change-status', function (e) {
    e.preventDefault();
    let statusId = $(this).val();
    $.ajax({
        url: liveConsultationUrl + '/change-status',
        type: 'POST',
        data: { statusId: statusId, id: $(this).data('id') },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#liveConsultationTable').
                    DataTable().
                    ajax.
                    reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('click', '.start-btn', function (event) {
    let liveConsultationId = $(event.currentTarget).data('id');
    startRenderData(liveConsultationId);
});

$(document).on('click', '.edit-btn', function (event) {
    let liveConsultationId = $(event.currentTarget).data('id');
    editRenderData(liveConsultationId);
});

window.editRenderData = function (id) {
    $.ajax({
        url: liveConsultationUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data;
                $('#liveConsultationId').val(liveConsultation.id);
                $('.edit-consultation-title').
                    val(liveConsultation.consultation_title);
                document.querySelector('.edit-consultation-date').
                    _flatpickr.
                    setDate(moment(liveConsultation.consultation_date).
                        format('YYYY-MM-DD h:mm A'));
                $('.edit-consultation-duration-minutes').
                    val(liveConsultation.consultation_duration_minutes);
                $('.edit-patient-name').
                    val(liveConsultation.patient_id).
                    trigger('change');
                $('.edit-doctor-name').
                    val(liveConsultation.doctor_id).
                    trigger('change');
                $('.host-enable,.host-disabled').prop('checked', false);
                if (liveConsultation.host_video == 1) {
                    $(`input[name="host_video"][value=${liveConsultation.host_video}]`).
                        prop('checked', true);
                } else {
                    $(`input[name="host_video"][value=${liveConsultation.host_video}]`).
                        prop('checked', true);
                }
                $('.client-enable,.client-disabled').prop('checked', false);
                if (liveConsultation.participant_video == 1) {
                    $(`input[name="participant_video"][value=${liveConsultation.participant_video}]`).
                        prop('checked', true);
                } else {
                    $(`input[name="participant_video"][value=${liveConsultation.participant_video}]`).
                        prop('checked', true);
                }
                $('.edit-consultation-type').
                    val(liveConsultation.type).
                    trigger('change');
                $('.edit-consultation-type-number').
                    val(liveConsultation.type_number).
                    trigger('change');
                $('.edit-description').val(liveConsultation.description);
                $('#editModal').modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

window.startRenderData = function (id) {
    $.ajax({
        url: doctorRole ? route('doctors.live.consultation.get.live.status', id) : route('patients.live.consultation.get.live.status', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data;
                $('#startLiveConsultationId').
                    val(liveConsultation.liveConsultation.id);
                $('.start-modal-title').text(
                    liveConsultation.liveConsultation.consultation_title);
                $('.host-name').
                    text(liveConsultation.liveConsultation.user.full_name);
                $('.date').text(moment(liveConsultation.liveConsultation.consultation_date).format('LT')+ ', '+moment(liveConsultation.liveConsultation.consultation_date).
                    format('Do MMM, Y'));
                $('.minutes').text(
                    liveConsultation.liveConsultation.consultation_duration_minutes);
                $('#startModal').
                    find('.status').
                    append((liveConsultation.zoomLiveData.data.status ===
                        'started') ? $('.status').text('Started') : $(
                        '.status').text('Awaited'));
                $('.start').attr('href', (patientRole)
                    ? liveConsultation.liveConsultation.meta.join_url
                    : ((liveConsultation.zoomLiveData.data.status ===
                        'started')
                        ? $('.start').addClass('disabled')
                        : liveConsultation.liveConsultation.meta.start_url),
                );
                $('#startModal').modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

$(document).on('click', '.delete-btn', function (event) {
    let liveConsultationId = $(event.currentTarget).data('id');
    deleteItem(
        liveConsultationUrl + '/' + liveConsultationId,
        '#liveConsultationTable',
        'Live Consultation',
    );
});

$(document).on('click', '.show-data', function (event) {
    let consultationId = $(event.currentTarget).data('id');
    $.ajax({
        url: doctorRole ? route('doctors.live-consultation.show', consultationId) : route('patients.live-consultation.show', consultationId),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data.liveConsultation;
                let showModal = $('#showModal');
                $('#startLiveConsultationId').val(liveConsultation.id);
                $('#consultationTitle').
                    text(liveConsultation.consultation_title);
                $('#consultationDates').
                    text(moment(liveConsultation.consultation_date).format('LT')+ ', '+moment(liveConsultation.consultation_date).
                        format('Do MMM, Y'));
                $('#consultationDurationMinutes').
                    text(liveConsultation.consultation_duration_minutes);
                $('#consultationPatient').
                    text(liveConsultation.patient.user.full_name);
                $('#consultationDoctor').
                    text(liveConsultation.doctor.user.full_name);
                (liveConsultation.host_video === 0) ? $(
                    '#consultationHostVideo').text('Disable') : $(
                    '#consultationHostVideo').text('Enable');
                (liveConsultation.participant_video === 0) ? $(
                    '#consultationParticipantVideo').text('Disable') : $(
                    '#consultationParticipantVideo').text('Enable');
                isEmpty(liveConsultation.description) ? $(
                    '#consultationDescription').text('N/A') : $(
                    '#consultationDescription').
                    text(liveConsultation.description);
                showModal.modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
});
