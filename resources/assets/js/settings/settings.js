'use strict';

$(document).ready(function () {
    if (countryId != '') {
        $('#countryId').val(countryId).trigger('change');

        setTimeout(function () {
            $('#stateId').val(stateId).trigger('change');
        }, 500);

        setTimeout(function () {
            $('#cityId').val(cityId).trigger('change');
        }, 1000);
    }
});

$('#countryId').on('change', function () {
    $.ajax({
        url: route('states-list'),
        type: 'get',
        dataType: 'json',
        data: {countryId: $(this).val()},
        success: function (data) {
            $('#stateId').empty();
            $('#cityId').empty();
            $('#stateId').append(
                $('<option value=""></option>').text('Select State'));
            $('#cityId').append(
                $('<option value=""></option>').text('Select City'));
            $.each(data.data, function (i, v) {
                $('#stateId').append($('<option></option>').attr('value', i).text(v));
            });
        },
    });
});

$('#stateId').on('change', function () {
    $('#cityId').empty();
    $.ajax({
        url: route('cities-list'),
        type: 'get',
        dataType: 'json',
        data: {stateId: $(this).val()},
        success: function (data) {
            $('#cityId').empty();
            $('#cityId').append(
                $('<option value=""></option>').text('Select City'));
            $.each(data.data, function (i, v) {
                $('#cityId').
                    append($('<option></option>').attr('value', i).text(v));
            });
        },
    });
});

$('#generalSettingForm').on('submit', function () {
    let checkedPaymentMethod = $(
        'input[name="payment_gateway[]"]:checked').length;
    if (!checkedPaymentMethod) {
        displayErrorMessage('Please select any one payment gateway');
        return false;
    }
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus();
        displayErrorMessage(`Contact number is ` + $('#error-msg').text());
        return false;
    }
});
