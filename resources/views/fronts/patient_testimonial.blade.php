<!-- Testimonial -->
@if($frontPatientTestimonials->count() > 0)
    <section class="section-area section-sp3 testimonial-wraper">
        <div class="container">
            <div class="heading-bx text-center">
                <h6 class="title-ext text-secondary">{{__('messages.web.testimonial')}}</h6>
                <h2 class="title m-b0">{{__('messages.web.see_what_are_the_patients')}}
                    <br>{{__('messages.web.saying_about_us')}}</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 text-center">
                    <div class="thumb-wraper">
                        <img class="bg-img" src="{{asset('assets/front/images/testimonials/shape.png')}}"
                             alt="">
                        <ul>
                            @foreach($frontPatientTestimonials as $frontPatientTestimonial)
                                <li data-member="{{ $loop->index +1 }}" class="{{($loop->first)?'active':''}}">
                                    <a href="javascript:void(0);"><img
                                                src="{{ $frontPatientTestimonial->front_patient_profile }}"
                                                alt=""/></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="swiper-container testimonial-slide">
                        <div class="swiper-wrapper">
                            @foreach($frontPatientTestimonials as $frontPatientTestimonial)
                                <div class="swiper-slide" data-rel="{{ $loop->index +1 }}">
                                    <div class="testimonial-bx">
                                        <div class="testimonial-content">
                                            <p>{{ $frontPatientTestimonial->short_description }}</p>
                                        </div>
                                        <div class="client-info">
                                            <h5 class="name">{{ $frontPatientTestimonial->name }}</h5>
                                            <p>patient</p>
                                        </div>
                                        <div class="quote-icon">
                                            <i class="fas fa-quote-left"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev test-btn-prev"><i class="las la-arrow-left"></i></div>
                        <div class="swiper-button-next test-btn-next"><i class="las la-arrow-right"></i></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
        <img class="pt-img1 animate1" src="{{asset('assets/front/images/shap/plus-orange.png')}}" alt="">
        <img class="pt-img2 animate2" src="{{asset('assets/front/images/shap/square-blue.png')}}" alt="">
        <img class="pt-img3 animate3" src="{{asset('assets/front/images/shap/circle-dots.png')}}" alt="">
        <img class="pt-img4 animate4" src="{{asset('assets/front/images/shap/circle-orange-2.png')}}" alt="">
    </section>
@endif
