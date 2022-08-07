'use strict';

$(document).ready(function () {
    $('#shortDescription').on('keyup', function () {
        $('#shortDescription').attr('maxlength', 111);
    });
});
