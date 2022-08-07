<div class="modal fade" id="addReviewModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">{{__('messages.review.add_review')}}</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000,                                   4.000000)"
                               fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16"
                                      height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2"
                                      rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
            @php $style = 'style'; @endphp
            <div class="modal-body scroll-y mx-5 mx-xl-15 mb-6">
                {{ Form::open(['id' => 'addReviewForm']) }}
                <div class="alert alert-danger d-none" id="addReviewErrorsBox"></div>
                <input type="hidden" id="doctorId" value="" name="doctor_id">
                <div>
                    <div class="fv-row mb-2">
                        <label class="form-label fs-6 fw-bolder text-gray-700 required"
                               for="review">{{ __('messages.review.review') }}:</label>
                        <textarea class="form-control form-control-solid mb-lg-0" maxlength="121" id="review"
                                  name="review" placeholder="Review"></textarea>
                    </div>
                    <div class="rating justify-content-center">
                        <!--begin::Reset rating-->
                        <label class="btn btn-light fw-bolder btn-sm rating-label me-3 d-none" for="kt_rating_input_0">
                            Reset
                        </label>
                        <input class="rating-input d-none" name="rating" value="0" checked type="radio"
                               id="kt_rating_input_0"/>
                        <!--end::Reset rating-->

                        <!--begin::Star 1-->
                        <label class="rating-label" for="kt_rating_input_1">
                            <span class="svg-icon svg-icon-1 fs-6 w-40px h-40px">
                                @include('reviews.rating_star')
                            </span>
                        </label>
                        <input class="rating-input" name="rating" value="1" type="radio" id="kt_rating_input_1"/>
                        <!--end::Star 1-->

                        <!--begin::Star 2-->
                        <label class="rating-label" for="kt_rating_input_2">
                            <span class="svg-icon svg-icon-1">
                                 @include('reviews.rating_star')
                            </span>                        
                        </label>
                        <input class="rating-input" name="rating" value="2" type="radio" id="kt_rating_input_2"/>
                        <!--end::Star 2-->

                        <!--begin::Star 3-->
                        <label class="rating-label" for="kt_rating_input_3">
                            <span class="svg-icon svg-icon-1">
                                 @include('reviews.rating_star')
                            </span>                        
                        </label>
                        <input class="rating-input" name="rating" value="3" type="radio" id="kt_rating_input_3"/>
                        <!--end::Star 3-->

                        <!--begin::Star 4-->
                        <label class="rating-label" for="kt_rating_input_4">
                            <span class="svg-icon svg-icon-1">
                                 @include('reviews.rating_star')
                            </span>                        
                        </label>
                        <input class="rating-input" name="rating" value="4" type="radio" id="kt_rating_input_4"/>
                        <!--end::Star 4-->

                        <!--begin::Star 5-->
                        <label class="rating-label" for="kt_rating_input_5">
                            <span class="svg-icon svg-icon-1">
                                 @include('reviews.rating_star')
                            </span>                        
                        </label>
                        <input class="rating-input" name="rating" value="5" type="radio" id="kt_rating_input_5"/>
                        <!--end::Star 5-->
                    </div>
                </div>

                <div class="pt-3">
                    <div class="d-flex">
                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
                        {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-light btn-active-light-primary','data-bs-dismiss'=>'modal']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
