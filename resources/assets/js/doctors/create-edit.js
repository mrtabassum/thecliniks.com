'use strict';

$(document).ready(function () {
    $('#dob').flatpickr({
        maxDate: new Date(),
        disableMobile: true
    });

    let isDefault = false;
    let deletedQualifications = [];
    let degree;
    let university;
    let year;
    let updateId;
    let primaryId;
    let id = 1;
    $('.showQualification').hide();
    $(document).on('click', '#addQualification', function () {
        isDefault = false;
        $('#degree').val('');
        $('#university').val('');
        $('#year').val('').trigger('change');
        $('.showQualification').slideToggle(500);
    });
    $(document).on('click', '#cancelQualification', function () {
        $('.showQualification').slideUp(500);
    });
    $(document).on('click', '#saveQualification', function (e) {
        e.preventDefault();
        degree = $('#degree').val();
        university = $('#university').val();
        year = $('#year').val();
        let existId = $('#doctorQualificationTbl tr:last-child td:first-child').html();
        existId++;
        if (existId) {
            id = existId;
        }
        let prepareData = {
            'id': primaryId,
            'degree': degree,
            'year': year,
            'university': university,
        };
        let data = {
            'id': id,
            'degree': degree,
            'year': year,
            'university': university,
        };
        let emptyDegree = $('#degree').val().trim().replace(/ \r\n\t/g, '') ===
            '';
        let emptyUniversity = $('#university').
            val().
            trim().
            replace(/ \r\n\t/g, '') === '';
        let emptyYear = $('#year').val().trim().replace(/ \r\n\t/g, '') === '';
        if (emptyDegree) {
            displayErrorMessage('The degree field is required.');
            return false;
        } else if (emptyUniversity) {
            displayErrorMessage('The university is required.');
            return false;
        } else if (emptyYear) {
            displayErrorMessage('The year is required.');
            return false;
        }
        if (updateId == null) {
            qualification.push(prepareData);
        } else {
            qualification[updateId - 1] = prepareData;
        }
        let qualificationHtml = prepareTemplateRender(
            '#qualificationTemplateData', data);
        if (isDefault == false) {
            $('tbody').append(qualificationHtml);
            id++;
        } else if (isDefault == true) {
            let data = {
                'id': updateId,
                'degree': degree,
                'year': year,
                'university': university,
            };
            let updateQualificationHtml = prepareTemplateRender(
                '#qualificationTemplateData', data);
            let table = $('table tbody');
            $(table).find('tr').each(function (i, v) {
                i = i + 1;
                if (i == updateId) {
                    $('tbody').find(v).replaceWith(updateQualificationHtml);
                }
            });
        }
        $('.showQualification').slideUp(500);
        $('#degree').val('');
        $('#university').val('');
        $('#year').val('');
    });

    $(document).on('click', '.delete-btn-qualification', function (event) {
        $('#degree').val('');
        $('#university').val('');
        $('#year').val('').trigger('change');
        qualification.pop([0]);
        $('.showQualification').slideUp(500);

        let Ele = $(this);
        let qualificationID = $(this).data('id');
        let header = 'Qualification';

        Swal.fire({
            title: 'Delete !',
            text: 'Are you sure want to delete this "' + header + '" ?',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: '#266CB0',
            showLoaderOnConfirm: true,
            cancelButtonText: 'No, Cancel',
            confirmButtonText: 'Yes, Delete!',
        }).then(function (result) {
            if (result.isConfirmed) {
                deletedQualifications.push(qualificationID);
                $('#deletedQualifications').val(deletedQualifications);
                Ele.parent().parent().remove().remove();
                Swal.fire({
                    title: 'Deleted!',
                    text: header + ' has been deleted.',
                    icon: 'success',
                    confirmButtonColor: '#266CB0',
                    timer: 2000,
                });
            }
        });
    });

    $(document).on('click', '.edit-btn-qualification', function () {
        $('#degree').val('');
        $('#university').val('');
        $('#year').val('');
        updateId = $(this).data('id');
        primaryId = $(this).data('primary-id');
        let currentRow = $(this).closest('tr');
        let currentDegree = currentRow.find('td:eq(1)').text();
        let currentCollage = currentRow.find('td:eq(2)').text();
        let currentYear = currentRow.find('td:eq(3)').text();
        $('#degree').val(currentDegree);
        $('#university').val(currentCollage);
        $('#year').val(currentYear).trigger('change');
        isDefault = true;
        $('.showQualification').slideToggle(500);
    });

    $(document).on('submit', '#editDoctorForm', function (e) {
        e.preventDefault();
        let formData = new FormData($(this)[0]);

        formData.append('qualifications', JSON.stringify(qualification));
        $.ajax({
            url: route('doctors.update', uId),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    window.location.href = route('doctors.index');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $('input[type=radio][name=gender]').on('change', function () {
        let file = $('#profilePicture').val();
        if (isEmpty(file)) {
            if (this.value == 1) {
                $('.image-input-wrapper').
                    attr('style', 'background-image:url(' + manAvatar + ')');
            } else if (this.value == 2) {
                $('.image-input-wrapper').
                    attr('style', 'background-image:url(' + womanAvatar + ')');
            }
        }
    });

    $('#countryId').on('change', function () {
        $.ajax({
            url: route('get-state'),
            type: 'get',
            dataType: 'json',
            data: { data: $(this).val() },
            success: function (data) {
                $('#stateId').empty();
                $('#cityId').empty();
                $('#stateId').
                    append($('<option value=""></option>').text('Select State'));
                $('#cityId').append(
                    $('<option value=""></option>').text('Select City'));
                $.each(data.data, function (i, v) {
                    $('#stateId').append($('<option></option>').attr('value', i).text(v));
                });
                if (isEdit && stateId) {
                    $('#stateId').val(stateId).trigger('change');
                }
            },
        });
    });
    
    $('#stateId').on('change', function () {
        $.ajax({
            url: route('get-city'),
            type: 'get',
            dataType: 'json',
            data: {
                state: $(this).val(),
                country: $('#countryId').val(),
            },
            success: function (data) {
                $('#cityId').empty();
                $('#cityId').append(
                    $('<option value=""></option>').text('Select City'));
                $.each(data.data, function (i, v) {
                    $('#cityId').append($('<option ></option>').attr('value', i).text(v));});
                if (isEdit && cityId) {
                    $('#cityId').val(cityId).trigger('change');
                }
            },
        });
    });
    if (isEdit & countryId) {
        $('#countryId').val(countryId).trigger('change');
    }
});

$(document).on('keyup', '#twitterUrl', function () {
    this.value = this.value.toLowerCase();
});

$(document).on('keyup', '#linkedinUrl', function () {
    this.value = this.value.toLowerCase();
});

$(document).on('keyup', '#instagramUrl', function () {
    this.value = this.value.toLowerCase();
});

$('#createDoctorForm,#editDoctorForm').on('submit', function () {
    let twitterUrl = $('#twitterUrl').val();
    let linkedinUrl = $('#linkedinUrl').val();
    let instagramUrl = $('#instagramUrl').val();
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter.[a-z]{2,3}\/?.*/i);
    let linkedinExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);
    let instagramExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i);

    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(
        twitterExp) ? true : false));
    if (!twitterCheck) {
        displayErrorMessage('Please enter a valid Twitter Url');
        return false;
    }

    let linkedInCheck = (linkedinUrl == '' ? true : (linkedinUrl.match(
        linkedinExp) ? true : false));
    if (!linkedInCheck) {
        displayErrorMessage('Please enter a valid Linkedin Url');
        return false;
    }

    let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
        instagramExp) ? true : false));
    if (!instagramCheck) {
        displayErrorMessage('Please enter a valid Instagram Url');
        return false;
    }

    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus();
        displayErrorMessage(`Contact number is ` + $('#error-msg').text());
        return false;
    }
});

$(document).on('click', '.removeAvatarIcon', function () {
    $('#bgImage').css('background-image', '');
    $('#bgImage').css('background-image', 'url(' + backgroundImg + ')');
    $('#removeAvatar').remove();
});

