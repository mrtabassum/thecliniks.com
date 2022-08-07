/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/assets/js/reviews/review.js ***!
  \***********************************************/


$(document).on('click', '.addReviewBtn', function () {
  var doctorId = $(this).data('id');
  $('#doctorId').val(doctorId);
});
$(document).ready(function () {
  var star_rating_width = $('.fill-ratings span').width();
  $('.star-ratings').width(star_rating_width);
});
$(document).on('submit', '#addReviewForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('patients.reviews.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addReviewModal').modal('hide');
        setTimeout(function () {
          location.reload();
        }, 1200);
      }
    },
    error: function error(_error) {
      displayErrorMessage(_error.responseJSON.message);
    }
  });
});
$(document).on('click', '.editReviewBtn', function () {
  var reviewId = $(this).data('id');
  $.ajax({
    url: route('patients.reviews.edit', reviewId),
    type: 'GET',
    success: function success(result) {
      $('#editReviewModal').modal('show').appendTo('body');
      $('#editDoctorId').val(result.data.doctor_id);
      $('#editReviewId').val(result.data.id);
      $('#editReview').val(result.data.review);
      $('#editRating-' + result.data.rating).attr('checked', true);
    },
    error: function error(_error2) {
      displayErrorMessage(_error2.responseJSON.message);
    }
  });
});
$(document).on('submit', '#editReviewForm', function (e) {
  e.preventDefault();
  var reviewId = $('#editReviewId').val();
  $.ajax({
    url: route('patients.reviews.update', reviewId),
    type: 'PUT',
    data: $(this).serialize(),
    success: function success(result) {
      displaySuccessMessage(result.message);
      $('#editReviewModal').modal('hide');
      setTimeout(function () {
        location.reload();
      }, 1200);
    },
    error: function error(_error3) {
      displayErrorMessage(_error3.responseJSON.message);
    }
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
/******/ })()
;