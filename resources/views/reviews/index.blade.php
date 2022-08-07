@extends('layouts.app')
@section('title')
    {{ __('messages.reviews') }}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @php $style = 'style'; @endphp
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
                @forelse($doctors as $doctor)
                    <div class="col-md-6 col-xxl-4 ribbon ribbon-top ribbon-vertical">
                        @if($doctor->reviews->avg('rating') != 0)
                            <div class="ribbon-label bg-primary align-items-center">
                                <div class="star-ratings">
                                    <div class="avg-review-star-div">
                                        @php
                                            $rating = $doctor->reviews->avg('rating');
                                        @endphp
                                        @foreach(range(1, 5) as $i)
                                            @if($rating > 0)
                                                @if($rating > 0.5)
                                                    <i class="fas fa-star review-star"></i>
                                                @else
                                                    <i class="fas fa-star-half-alt review-star"></i>
                                                @endif
                                            @else
                                                <i class="far fa-star review-star"></i>
                                            @endif
                                            @php $rating--; @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card h-100">
                            <div class="card-body d-flex flex-center flex-column p-9">
                                <div class="symbol symbol-65px symbol-circle mb-5">
                                    <img src="{{ $doctor->user->profile_image }}" alt="image">
                                </div>
                                <span class="fs-4 text-gray-800 fw-bolder mb-0">{{ $doctor->user->full_name }}</span>
                                <div class="fw-bold text-gray-400 mb-6 text-center">
                                    @foreach($doctor->specializations as $specialization)
                                        @if($loop->last)
                                            {{ $specialization->name }}
                                        @else
                                            {{ $specialization->name }},
                                        @endif
                                    @endforeach
                                </div>

                                @forelse($doctor->reviews->where('patient_id', getLogInUser()->patient->id) as $review)
                                    @if(isset($review) && ($review->patient_id == getLogInUser()->patient->id))
                                        <div class="mt-auto">
                                            <div class="fw-bold mb-3 text-center">
                                                {{ $review->review }}
                                            </div>
                                        </div>
                                        <div class="review-star-div">
                                            @php
                                                $rating = $review->rating;
                                            @endphp
                                            @foreach(range(1, 5) as $i)
                                                @if($rating > 0)
                                                    @if($rating > 0.5)
                                                        <i class="fas fa-star review-star"></i>
                                                    @else
                                                        <i class="fas fa-star-half-alt review-star"></i>
                                                    @endif
                                                @else
                                                    <i class="far fa-star review-star"></i>
                                                @endif
                                                @php $rating--; @endphp
                                            @endforeach
                                        </div>
                                        <div>
                                            <button class="btn btn-primary mt-3 editReviewBtn"
                                                    data-id="{{ $review->id }}"
                                                    data-target="#editReviewModal" data-toggle="modal">
                                                <i class="fas fa-edit"></i><span>Edit Review</span>
                                            </button>
                                        </div>
                                    @endif
                                @empty
                                    <div class="mt-auto">
                                        <button class="btn btn-primary addReviewBtn" data-id="{{ $doctor->id }}"
                                                data-target="#addReviewModal" data-toggle="modal">
                                            <i class="fas fa-pen"></i><span>{{ __('messages.review.write_a_review') }}</span>
                                        </button>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card mt-5">
                        <div class="card-body p-5">
                            <div class="card-px text-center pt-20 pb-5"><h2
                                        class="fs-2x fw-bold mb-0">{{ __('messages.review.no_doctors_available_to_give_rating') }}</h2>
                            </div>
                            <div class="text-center px-5"><img
                                        src="{{ asset('backend/images/no-record-available.png') }}" alt=""
                                        class="mw-100 h-200px h-sm-325px"></div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @include('reviews.review_modal')
    @include('reviews.edit_review_modal')
@endsection
@section('page_js')
    <script src="{{ asset('assets/js/reviews/review.js') }}"></script>
@endsection
