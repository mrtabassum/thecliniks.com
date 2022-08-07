'use strict';


$(document).on('click','.addReviewBtn',function (){
    let doctorId = $(this).data('id');
    $('#doctorId').val(doctorId);
});

$(document).ready(function() {
    let star_rating_width = $('.fill-ratings span').width();
    $('.star-ratings').width(star_rating_width);
});

$(document).on('submit','#addReviewForm',function (e){
    e.preventDefault();
    $.ajax({
        url: route('patients.reviews.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success){
                displaySuccessMessage(result.message);
                $('#addReviewModal').modal('hide');
                setTimeout(function () {
                    location.reload();
                }, 1200);
            }
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message);
        },
    });
});

$(document).on('click', '.editReviewBtn', function () {
    let reviewId = $(this).data('id');
    $.ajax({
        url: route('patients.reviews.edit', reviewId),
        type: 'GET',
        success: function (result) {
            $('#editReviewModal').modal('show').appendTo('body');
            $('#editDoctorId').val(result.data.doctor_id);
            $('#editReviewId').val(result.data.id);
            $('#editReview').val(result.data.review);
            $('#editRating-' + result.data.rating).
                attr('checked', true);
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message);
        },
    });
});

$(document).on('submit', '#editReviewForm', function (e) {
    e.preventDefault();
    let reviewId = $('#editReviewId').val();
    $.ajax({
        url: route('patients.reviews.update', reviewId),
        type: 'PUT',
        data: $(this).serialize(),
        success: function (result) {
            displaySuccessMessage(result.message);
            $('#editReviewModal').modal('hide');
            setTimeout(function () {
                location.reload();
            }, 1200);
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message);
        },
    });
});

$(document).on('click', '.addReviewBtn', function () {
    $('#addReviewModal').modal('show').appendTo('body');
});

$('#addReviewModal').on('hidden.bs.modal', function () {
    $('#doctorId').val('');
    resetModalForm('#addReviewForm');
});

$('#editReviewModal').on('hidden.bs.modal', function () {
    $('#editDoctorId').val('');
    resetModalForm('#editReviewForm');
});
