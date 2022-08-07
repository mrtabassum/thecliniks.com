'use strict';

$(document).ready(function () {
    $('#date').flatpickr({
        disableMobile: true
    });
    $('#editDate').flatpickr({
        disableMobile: true
    });
});

$(document).on('submit','#saveForm',function (e) {
    e.preventDefault();
    $('#btnSubmit').attr('disabled', true);
    $('#saveForm')[0].submit();
});
