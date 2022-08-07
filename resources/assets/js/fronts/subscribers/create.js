'use strict';

$(document).on('submit', '#subscribeForm', function (e) {
    e.preventDefault();
    // let btnLoader = $(this).find('button[type="submit"]');
    // setBtnLoader(btnLoader);
    $.ajax({
        url: route('subscribe.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                toastr.success(result.message);
                $('#subscribeForm')[0].reset();
                setTimeout(function () {
                    location.reload();
                },1200);
            }
        },
        error: function (error) {
            toastr.error(error.responseJSON.message);
            $('#subscribeForm')[0].reset();
        },
        complete: function (){
            // setBtnLoader(btnLoader);
        }
    });
});
