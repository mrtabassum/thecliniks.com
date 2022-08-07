'use strict';

$(window).on('load', function () {
    prepareAppointmentReport();
});

$(document).on('click', '#monthData', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('patientData.dashboard'),
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
                                'image': value.profile,
                                'name': value.user.full_name,
                                'email': value.user.email,
                                'patientId': value.patient_unique_id,
                                'registered': moment.parseZone(
                                    value.user.created_at).
                                    format('Do MMM Y hh:mm A'),
                                'appointment_count': value.appointments_count,
                                'route': route('patients.show', value.id),
                            }];
                        $(document).
                            find('#monthlyReport').
                            append(
                                prepareTemplateRender('#adminDashboardTemplate',
                                    data));
                    });
                } else {
                    $(document).find('#monthlyReport').append(`<tr class="text-center">
                                                    <td colspan="5" class="text-muted fw-bold">No Data Available</td>
                                                </tr>`);
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

let amount = [];
let month = [];
let totalAmount = 0;
$.each(appointmentData, function (key, value) {
    month.push(key);
    amount.push(value);
    totalAmount += value;
});

$(document).ready(function (){
    $('.totalEarning').text(totalAmount);
});

let chartType = 'bar';

window.prepareAppointmentReport = function () {
    $('#appointmentChartId').remove();
    $('.appointmentChart').append('<div id="appointmentChartId" style="height: 350px" class="card-rounded-bottom"></div>');
    let e = document.getElementById('appointmentChartId'),
        t = (parseInt(KTUtil.css(e, 'height')), KTUtil.getCssVariableValue(
            '--bs-gray-500')),
        a = KTUtil.getCssVariableValue('--bs-gray-200');
    e && new ApexCharts(e, {
        series: [
            {
                name: 'Amount',
                type: chartType,
                stacked: !0,
                data: amount,
            }],
        chart: {
            fontFamily: 'inherit',
            stacked: !0,
            type: chartType,
            height: 350,
            toolbar: { show: !1 },
        },
        plotOptions: {
            bar: {
                stacked: !0,
                horizontal: !1,
                borderRadius: 4,
                columnWidth: ['12%'],
            },
        },
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        stroke: {
            curve: 'smooth',
            show: !0,
            width: 2,
            colors: ['transparent'],
        },
        xaxis: {
            categories: month,
            axisBorder: { show: !1 },
            axisTicks: { show: !1 },
            labels: { style: { colors: t, fontSize: '12px' } },
        },
        yaxis: {
            labels: { style: { colors: t, fontSize: '12px' } },
        },
        fill: { opacity: 1 },
        states: {
            normal: { filter: { type: 'none', value: 0 } },
            hover: { filter: { type: 'none', value: 0 } },
            active: {
                allowMultipleDataPointsSelection: !1,
                filter: { type: 'none', value: 0 },
            },
        },
        tooltip: {
            style: { fontSize: '12px' },
            y: {
                formatter: function (e) {
                    return currencyIcon+ ' ' + e;
                },
            },
        },
        grid: {
            borderColor: a,
            strokeDashArray: 4,
            yaxis: { lines: { show: !0 } },
            padding: { top: 0, right: 0, bottom: 0, left: 0 },
        },
    }).render();
};

$(document).on('click','#changeChart',function (){
    if(chartType == 'bar'){
        chartType = 'area';
        $('.chart').removeClass('fa-chart-area');
        $('.chart').addClass('fa-chart-bar');
        prepareAppointmentReport();
    }else{
        chartType = 'bar';
        $('.chart').addClass('fa-chart-area');
        $('.chart').removeClass('fa-chart-bar');
        prepareAppointmentReport();
    }
});

$(document).on('change','#serviceId , #doctorId, #serviceCategoryId',function (e){
    e.preventDefault();
    let serviceId = $('#serviceId').val();
    let serviceCategoryId = $('#serviceCategoryId').val();
    let doctorId = $('#doctorId').val();
    $('.totalEarning').text('')
    $.ajax({
        url: route('admin.dashboard'),
        type: 'GET',
        data: {
            serviceId : serviceId,
            serviceCategoryId : serviceCategoryId,
            doctorId : doctorId,
        },
        success: function (result) {
            if (result.success) {
                month = [];
                amount = [];
                totalAmount = 0;
                $.each(result.data, function (key, value) {
                    month.push(key);
                    amount.push(value);
                    totalAmount += value;
                });
                $('.totalEarning').text(totalAmount);
                prepareAppointmentReport();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('click','#resetBtn',function (){
    $('#serviceId').val('').trigger('change');
    $('#doctorId').val('').trigger('change');
    $('#serviceCategoryId').val('').trigger('change');
});

$(document).on('click', '#weekData', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('patientData.dashboard'),
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
                                'image': value.profile,
                                'name': value.user.full_name,
                                'email': value.user.email,
                                'patientId': value.patient_unique_id,
                                'registered': moment.parseZone(
                                    value.user.created_at).
                                    format('Do MMM Y hh:mm A'),
                                'appointment_count': value.appointments_count,
                                'route': route('patients.show', value.id),
                            }];
                        $(document).
                            find('#weeklyReport').
                            append(
                                prepareTemplateRender('#adminDashboardTemplate',
                                    data));
                    });
                } else {
                    $(document).find('#weeklyReport').append(`<tr class="text-center">
                                                    <td colspan="5" class="text-muted fw-bold">No Data Available</td>
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
        url: route('patientData.dashboard'),
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
                                'image': value.profile,
                                'name': value.user.full_name,
                                'email': value.user.email,
                                'patientId': value.patient_unique_id,
                                'registered': moment.parseZone(
                                    value.user.created_at).
                                    format('Do MMM Y hh:mm A'),
                                'appointment_count': value.appointments_count,
                                'route': route('patients.show', value.id),
                            }];
                        $(document).find('#dailyReport').
                            append(
                                prepareTemplateRender('#adminDashboardTemplate',
                                    data));

                    });
                } else {
                    $(document).find('#dailyReport').append(`
                    <tr class="text-center">
                        <td colspan="5" class="text-muted fw-bold">No Data Available</td>
                    </tr>`);
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
