'use strict';

$(document).ready(function () {
    $('#frontAppointmentDate').datepicker({
        format: 'yyyy-mm-dd',
        startDate: new Date(),
        todayHighlight: true
    });
});
