'use strict';

$(document).ready(function () {
    let totalPermissionsCount = totalPermissions - 1;
    let checkAllLength = $('.permission:checked').length;
    if (isEdit == true) {
        if (checkAllLength === totalPermissionsCount) {
            $('#checkAllPermission').prop('checked', true);
        } else {
            $('#checkAllPermission').prop('checked', false);
        }
    }
});

$(document).on('click', '#checkAllPermission', function () {
    if ($('#checkAllPermission').is(':checked')) {
        $('.permission').each(function () {
            $(this).prop('checked', true);
        });
    } else {
        $('.permission').each(function () {
            $(this).prop('checked', false);
        });
    }
});

$(document).on('click', '.permission', function () {
    let checkAllLength = $('.permission:checked').length;
    let totalPermissionsCount = totalPermissions - 1;
    if (checkAllLength === totalPermissionsCount) {
        $('#checkAllPermission').prop('checked', true);
    } else {
        $('#checkAllPermission').prop('checked', false);
    }
});
