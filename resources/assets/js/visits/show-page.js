'use strict';

$(document).ready(function () {
    setTimeout(function () {
        $('.visit-detail-width').
            parent().
            parent().
            addClass('visit-detail-width');
    }, 100);

});

// Add visit Problem Data
$(document).on('submit', '#addVisitProblem', function (e) {
    e.preventDefault();
    let problemName = $('#problemName').val();
    let empty = problemName.trim().replace(/ \r\n\t/g, '') === '';

    if (empty) {
        displayErrorMessage(
            'Problem field is not contain only white space');
        return false;
    }
    let btnSubmitEle = $(this).find('#problemSubmitBtn');
    setAdminBtnLoader(btnSubmitEle);
    let problemAddUrl = doctorLogin
        ? route('doctors.visits.add.problem')
        : route('add.problem');
    $.ajax({
        url: problemAddUrl,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (result) {
            $('ul#problemLists').empty();
            if (result.data.length > 0) {
                displaySuccessMessage(result.message);
                $.each(result.data, function (i, val) {
                    $('#problemName').val('');
                    $('#problemLists').
                        append(
                            `<li class="list-group-item text-break text-wrap d-flex justify-content-between align-items-center py-5">${val.problem_name}<span class="remove-problem" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" data-id="${val.id}"><a href="javascript:void(0)"><i class="fas fa-trash text-danger"></i></a></span></li>`);
                });
            } else {
                $('#problemLists').
                    append(
                        `<p class="text-center fw-bold text-muted mt-3">${noRecordsFound}</p>`);
            }
        },
        complete: function () {
            $('#problemSubmitBtn').attr('disabled', false)
        },
    });
});

// Delete Visit Problem Data
$(document).on('click', '.remove-problem', function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let problemDeleteUrl = doctorLogin ? route('doctors.visits.delete.problem',
        id) : route('delete.problem', id);
    $(this).closest('li').remove();
    $.ajax({
        url: problemDeleteUrl,
        type: 'POST',
        dataType: 'json',
        success: function (result) {
            if (result.success) {
                if ($('#problemLists li').length < 1) {
                    displaySuccessMessage(result.message);
                    $('#problemLists').
                        append(
                            `<p class="text-center fw-bold mt-3 text-muted text-gray-600">${noRecordsFound}</p>`);
                } else {
                    displaySuccessMessage(result.message);
                }
            }
        },
    });
});

// Add Visit Observation Data
$(document).on('submit', '#addVisitObservation', function (e) {
    e.preventDefault();
    let observationName = $('#observationName').val();
    let empty2 = observationName.trim().replace(/ \r\n\t/g, '') === '';

    if (empty2) {
        displayErrorMessage(
            'Observation field is not contain only white space');
        return false;
    }
    let btnSubmitEle = $(this).find('#observationSubmitBtn');
    setAdminBtnLoader(btnSubmitEle);
    let observationAddUrl = doctorLogin ? route(
        'doctors.visits.add.observation') : route('add.observation');
    $.ajax({
        url: observationAddUrl,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (result) {
            $('ul#observationLists').empty();
            if (result.data.length > 0) {
                displaySuccessMessage(result.message);
                $.each(result.data, function (i, val) {
                    $('#observationName').val('');
                    $('#observationLists').
                        append(
                            `<li class="list-group-item text-break text-wrap d-flex justify-content-between align-items-center py-5">${val.observation_name}<span class="remove-observation" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" data-id="${val.id}"><a href="javascript:void(0)"><i class="fas fa-trash text-danger"></i></a></span></li>`);
                });
            } else {
                $('#observationLists').
                    append(
                        `<p class="text-center fw-bold text-muted mt-3">${noRecordsFound}</p>`);
            }
        },
        complete: function () {
            $('#observationSubmitBtn').attr('disabled', false)
        },
    });
});

// Delete Visit Observation Data
$(document).on('click', '.remove-observation', function (e) {
    e.preventDefault();

    let id = $(this).attr('data-id');
    let observationDeleteUrl = doctorLogin ? route(
        'doctors.visits.delete.observation', id) : route('delete.observation',
        id);
    $(this).closest('li').remove();
    $.ajax({
        url: observationDeleteUrl,
        type: 'POST',
        dataType: 'json',
        success: function (result) {
            if (result.success) {
                if ($('#observationLists li').length < 1) {
                    displaySuccessMessage(result.message);
                    $('#observationLists').
                        append(
                            `<p class="text-center fw-bold mt-3 text-muted text-gray-600">${noRecordsFound}</p>`);
                } else {
                    displaySuccessMessage(result.message);
                }
            }
        },
    });
});

// Add visit Note Data
$(document).on('submit', '#addVisitNote', function (e) {
    e.preventDefault();

    let noteName = $('#noteName').val();
    let empty2 = noteName.trim().replace(/ \r\n\t/g, '') === '';

    if (empty2) {
        displayErrorMessage(
            'Note field is not contain only white space');
        return false;
    }
    let btnSubmitEle = $(this).find('#noteSubmitBtn');
    setAdminBtnLoader(btnSubmitEle);
    let noteAddUrl = doctorLogin ? route('doctors.visits.add.note') : route(
        'add.note');
    $.ajax({
        url: noteAddUrl,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (result) {
            $('ul#noteLists').empty();
            if (result.data.length > 0) {
                displaySuccessMessage(result.message);
                $.each(result.data, function (i, val) {
                    $('#noteName').val('');
                    $('#noteLists').
                        append(
                            `<li class="list-group-item text-break text-wrap d-flex justify-content-between align-items-center py-5">${val.note_name}<span class="remove-note" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" data-id="${val.id}"><a href="javascript:void(0)"><i class="fas fa-trash text-danger"></i></a></span></li>`);
                });
            } else {
                $('#noteLists').
                    append(
                        `<p class="text-center fw-bold text-muted mt-3">${noRecordsFound}</p>`);
            }
        },
        complete: function () {
            $('#noteSubmitBtn').attr('disabled', false)
        },
    });
});

// Delete Visit Note Data
$(document).on('click', '.remove-note', function (e) {
    e.preventDefault();

    let id = $(this).attr('data-id');
    $(this).closest('li').remove();
    let noteDeleteUrl = doctorLogin
        ? route('doctors.visits.delete.note', id)
        : route('delete.note', id);
    $.ajax({
        url: noteDeleteUrl,
        type: 'POST',
        dataType: 'json',
        success: function (result) {
            if (result.success) {
                if ($('#noteLists li').length < 1) {
                    displaySuccessMessage(result.message);
                    $('#noteLists').
                        append(
                            `<p class="text-center fw-bold mt-3 text-muted text-gray-600">${noRecordsFound}</p>`);
                } else {
                    displaySuccessMessage(result.message);
                }
            }
        },
    });
});

// Add visit Prescription Data
$(document).on('submit', '#addPrescription', function (e) {
    e.preventDefault();
    let btnSubmitEle = $(this).find('#prescriptionSubmitBtn');
    setAdminBtnLoader(btnSubmitEle);
    let prescriptionAddUrl = doctorLogin ? route(
        'doctors.visits.add.prescription') : route('add.prescription');
    $.ajax({
        url: prescriptionAddUrl,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (result) {
            $('#addPrescription')[0].reset();
            $('.visit-prescriptions').empty();
            $('#prescriptionId').val('');
            $.each(result.data, function (i, val) {
                let data = [
                    {
                        'id': val.id,
                        'name': val.prescription_name,
                        'frequency': val.frequency,
                        'duration': val.duration,
                    }];

                const visitPrescriptionTblData = prepareTemplateRender(
                    '#visitsPrescriptionTblTemplate', data);
                $('.visit-prescriptions').append(visitPrescriptionTblData);
            });

            $('#addVisitPrescription').removeClass('show');
            displaySuccessMessage(result.message);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            $('#prescriptionSubmitBtn').attr('disabled', false)
        },
    });
});

// Edit Visit Prescription Data
function renderData (id) {
    let prescriptionEditUrl = doctorLogin ? route(
        'doctors.visits.edit.prescription', id) : route('edit.prescription',
        id);
    $.ajax({
        url: prescriptionEditUrl,
        type: 'GET',
        success: function (result) {
            $('#addPrescription')[0].reset();
            $('#prescriptionId').val(result.data.id);
            $('#prescriptionNameId').val(result.data.prescription_name);
            $('#frequencyId').val(result.data.frequency);
            $('#durationId').val(result.data.duration);
            $('#descriptionId').val(result.data.description);
        },
    });
}

$(document).on('click', '.edit-prescription-btn', function () {
    let id = $(this).attr('data-id');
    if (!$('#addVisitPrescription').hasClass('show')) {
        $('#addVisitPrescription').addClass('show');
    }
    renderData(id);
});

// Delete Visit Prescription Data
$(document).on('click', '.delete-prescription-btn', function (e) {
    e.preventDefault();

    let id = $(this).attr('data-id');
    $(this).closest('tr').remove();
    let prescriptionDeleteUrl = doctorLogin ? route(
        'doctors.visits.delete.prescription', id) : route('delete.prescription',
        id);
    $.ajax({
        url: prescriptionDeleteUrl,
        type: 'POST',
        dataType: 'json',
        success: function (result) {
            $('#addPrescription')[0].reset();
            $('#prescriptionId').val('');
            if (result.data.length < 1) {
                $('#addVisitPrescription').removeClass('show');
                displaySuccessMessage(result.message);
                $('.visit-prescriptions').
                    append(
                        `<tr><td colspan="4" class="text-center fw-bold  text-muted text-gray-600">No data available in table</td></tr>`);
            } else {
                $('#addVisitPrescription').removeClass('show');
                displaySuccessMessage(result.message);
            }
        },
    });
});

// Reset Form JS
$(document).on('click', '.reset-form', function () {
    $('#addPrescription')[0].reset();
});
