<!-- Footer ==== -->
@php $styleCss = 'style'; @endphp
<footer class="footer" {{ $styleCss }}="background-image:url({{'assets/front/images/background/footer.jpg'}});">
<!-- Footer Top -->
<div class="footer-top">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="widget widget_info">
                    <div class="footer-logo d-none">
                        <a href="{{ url('/') }}"><img src="{{asset('assets/image/infycare-logo.png')}}" alt=""></a>
                    </div>
                    <div class="ft-contact">
                        <div class="contact-bx">
                            <div class="icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="contact-number">
                                <span>{{ __('messages.web.contact_us') }}</span>
                                <h4 class="number"><a
                                            href="tel:+{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}">+{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}</a>
                                </h4>
                                <h4 class="number"><a
                                            href="mailto:{{getSettingValue('email')}}">{{ getSettingValue('email') }}</a>
                                </h4>
                            </div>
                        </div>
                        
                        <div class="row">
                                    <img class="about-thumb1" src="{{ asset('assets/front/images/paymentImage/paymethods.png') }}" alt="">
                            </div> 
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-12">
                <div class="widget footer_widget ml-50">
                    <h3 class="footer-title">{{ __('messages.web.quick_links') }}</h3>
                    <ul>

                         <li>
                            <a href="{{ route('medicalAboutUs') }}"
                               class="{{ Request::is('medicalLabc') ? 'text-primary' : '' }}"><span>{{ __('messages.web.lab_c') }}</span></a>
                        </li>

                        <li>
                            <a href="{{ route('medicalAboutUs') }}"
                               class="{{ Request::is('medical-about-us*') ? 'text-primary' : '' }}"><span>{{ __('messages.web.about_us') }}</span></a>
                        </li>

                        <li><a href="{{ route('medicalContact') }}"
                               class="{{ Request::is('medical-contact*') ? 'text-primary' : '' }}"><span>{{ __('messages.web.contact_us') }}</span></a>
                        </li>
                        <li><a href="{{ route('front.faqs') }}"
                               class="{{ Request::is('front-faqs*') ? 'text-primary' : '' }}"><span>{{ __('messages.web.faqs') }}</span></a>
                        </li>
                        <li>
                            <a href="{{ route('terms.conditions') }}"
                               class="{{ Request::is('terms-conditions*') ? 'text-primary' : '' }}"><span>{{ __('messages.terms_conditions') }}</span></a>
                        </li>
                        <li><a href="{{ route('privacy.policy') }}"
                               class="{{ Request::is('privacy-policy*') ? 'text-primary' : '' }}"><span>{{ __('messages.privacy_policy') }}</span></a>
                        </li>
                    </ul>
                </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="widget widget_form">
                        <h3 class="footer-title">{{ __('messages.web.subscribe') }}</h3>
                        {{ Form::open(['id'=>'subscribeForm', 'route'=> 'subscribe.store' , 'class' => 'subscribe-form subscription-form mb-30']) }}
                        <div class="ajax-message"></div>
                        <div class="input-group">
                            {{ Form::email('email',null, ['class' => 'form-control','id'=>'email', 'placeholder' => 'Enter Your Email', 'required']) }}
                        </div>
                        {{ Form::button(__('messages.web.subscribe'),['type'=>'submit','class' => 'btn btn-secondary shadow w-100']) }}
                        {{ Form::close() }}
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- footer bottom -->
<div class="container">
    <div class="footer-bottom">
        <div class="row">
            <div class="col-12 text-center">
                <p class="copyright-text">{{__('messages.web.all_rights_reserved')}} © {{ date('Y') }} <a
                            class="text-secondary">{{ getAppName() }}</a></p>
            </div>
        </div>
    </div>
</div>
<!-- footer-shape -->
<img class="pt-img1 animate-wave" src="{{asset('assets/front/images/shap/wave-blue.png')}}" alt="">
<img class="pt-img2 animate1" src="{{asset('assets/front/images/shap/circle-dots.png')}}" alt="">
<img class="pt-img3 animate-rotate" src="{{asset('assets/front/images/shap/plus-blue.png')}}" alt="">
<img class="pt-img4 animate-wave" src="{{asset('assets/front/images/shap/wave-blue.png')}}" alt="">
</footer>
<!-- Footer END ==== -->
