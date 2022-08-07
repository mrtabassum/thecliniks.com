'use strict';

$(document).on('submit', '#enquiryForm', function (e) {
    e.preventDefault();
    let btnLoader = $(this).find('button[type="submit"]');
    setBtnLoader(btnLoader);
    $.ajax({
        url: route('enquiries.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                toastr.success(result.message);
                $('#enquiryForm')[0].reset();
                setTimeout(function (){
                    location.reload();
                },1200);
            }
        },
        error: function (error) {
            toastr.error(error.responseJSON.message);
        },
        complete: function (){
            setBtnLoader(btnLoader);
        }
    });
});
