'use strict';

$(document).on('click', '#monthData', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('doctors.appointment.dashboard'),
        type: 'GET',
        data: { month: 'month' },
        success: function (result) {
            if (result.success) {
                $('#monthlyReport').empty();
                $(document).find('#week').removeClass('show active');
                $(document).find('#day').removeClass('show active');
                $(document).find('#month').addClass('show active');
                if (result.data.patients.data != '') {
                    $.each(result.data.patients.data, function (index, value) {
                        let data = [
                            {
                                'image': value.patient.profile,
                                'name': value.patient.user.full_name,
                                'email': value.patient.user.email,
                                'patientId': value.patient.patient_unique_id,
                                'date': moment(value.date).format('Do MMM, Y'),
                                'from_time': value.from_time,
                                'from_time_type': value.from_time_type,
                                'to_time': value.to_time,
                                'to_time_type': value.to_time_type,
                                'route': route('doctors.patient.detail',
                                    value.patient_id),
                            }];
                        $(document).
                            find('#monthlyReport').
                            append(prepareTemplateRender(
                                '#doctorDashboardTemplate',
                                data));
                    });
                } else {
                    $(document).find('#monthlyReport').append(`
                                                <tr>
                                                    <td colspan="4" class="text-center fw-bold text-muted">No Data Available</td>
                                                </tr>`);
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('click', '#weekData', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('doctors.appointment.dashboard'),
        type: 'GET',
        data: { week: 'week' },
        success: function (result) {
            if (result.success) {
                $('#weeklyReport').empty();
                $(document).find('#month').removeClass('show active');
                $(document).find('#day').removeClass('show active');
                $(document).find('#week').addClass('show active');
                if (result.data.patients.data != '') {
                    $.each(result.data.patients.data, function (index, value) {
                        let data = [
                            {
                                'image': value.patient.profile,
                                'name': value.patient.user.full_name,
                                'email': value.patient.user.email,
                                'patientId': value.patient.patient_unique_id,
                                'date': moment(value.date).format('Do MMM, Y'),
                                'from_time': value.from_time,
                                'from_time_type': value.from_time_type,
                                'to_time': value.to_time,
                                'to_time_type': value.to_time_type,
                                'route': route('doctors.patient.detail',
                                    value.patient_id),
                            }];
                        $(document).
                            find('#weeklyReport').
                            append(prepareTemplateRender(
                                '#doctorDashboardTemplate',
                                data));
                    });
                } else {
                    $(document).find('#weeklyReport').append(`
                                                <tr>
                                                    <td colspan="4" class="text-center fw-bold text-muted">No Data Available</td>
                                                </tr>`);
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('click', '#dayData', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('doctors.appointment.dashboard'),
        type: 'GET',
        data: { day: 'day' },
        success: function (result) {
            if (result.success) {
                $('#dailyReport').empty();
                $(document).find('#month').removeClass('show active');
                $(document).find('#week').removeClass('show active');
                $(document).find('#day').addClass('show active');
                if (result.data.patients.data != '') {
                    $.each(result.data.patients.data, function (index, value) {
                        let data = [
                            {
                                'image': value.patient.profile,
                                'name': value.patient.user.full_name,
                                'email': value.patient.user.email,
                                'patientId': value.patient.patient_unique_id,
                                'date': moment(value.date).format('Do MMM, Y'),
                                'from_time': value.from_time,
                                'from_time_type': value.from_time_type,
                                'to_time': value.to_time,
                                'to_time_type': value.to_time_type,
                                'route': route('doctors.patient.detail',
                                    value.patient_id),
                            }];
                        $(document).
                            find('#dailyReport').
                            append(prepareTemplateRender(
                                '#doctorDashboardTemplate',
                                data));
                    });
                } else {
                    $(document).find('#dailyReport').append(`
                                                <tr>
                                                    <td colspan="4" class="text-center fw-bold text-muted">No Data Available</td>
                                                </tr>`);
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
