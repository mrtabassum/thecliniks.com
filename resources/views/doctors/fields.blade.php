<div class="row gx-10 mb-5">
    <div class="col-md-6 mb-5">
        {{ Form::label('First Name',__('messages.doctor.first_name').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('first_name', null,['class' => 'form-control form-control-solid','placeholder' => 'First Name','required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Last Name',__('messages.doctor.last_name').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('last_name', null,['class' => 'form-control form-control-solid','placeholder' => 'Last Name','required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Email',__('messages.user.email').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::email('email', null,['class' => 'form-control form-control-solid','placeholder' => 'Email']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Contact',__('messages.user.contact_number').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::tel('contact', null,['class' => 'form-control form-control-solid','placeholder' => 'Contact Number','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
        {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
    <div class="col-md-6 mb-5">
        <div class="fv-row" data-kt-password-meter="true">
            <div class="mb-1">
                {{ Form::label('password',__('messages.staff.password').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                <span data-bs-toggle="tooltip"
                      title="Use 8 or more characters with a mix of letters, numbers & symbols."><i
                            class="fa fa-question-circle"></i></span>
                <div class="position-relative mb-3">
                    {{ Form::password('password', ['class' => 'form-control form-control-lg form-control-solid','autocomplete'=>"off", 'placeholder'=>'Password', 'required']) }}
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                          data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-5">
        <div class="fv-row" data-kt-password-meter="true">
            <div class="mb-1">
                {{ Form::label('Confirm Password',__('messages.user.confirm_password').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                <span data-bs-toggle="tooltip"
                      title="Use 8 or more characters with a mix of letters, numbers & symbols."><i
                            class="fa fa-question-circle"></i></span>
                <div class="position-relative mb-3">
                    {{ Form::password('password_confirmation', ['class' => 'form-control form-control-lg form-control-solid','autocomplete'=>"off", 'placeholder'=>'Confirm Password', 'required']) }}
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                          data-kt-password-meter-control="visibility">
                    <i class="bi bi-eye-slash fs-2"></i>
                    <i class="bi bi-eye fs-2 d-none"></i>
                </span>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('DOB',__('messages.doctor.dob').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('dob', null,['class' => 'form-control form-control-solid','placeholder' => 'DOB', 'id'=>'dob']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Specialization',__('messages.doctor.specialization').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('specializations[]',$specializations, null,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'multiple', 'data-placeholder' => 'Select Specializations']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Experience',__('messages.doctor.experience').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::number('experience', null,['class' => 'form-control form-control-solid','placeholder' => 'Experience In Year','step'=>'any']) }}
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3 required">{{__('messages.doctor.select_gender')}}
            :</label>
        <span class="form-check form-check-custom form-check-solid is-valid">
            <div class="align-items-baseline">
                <label class="form-label fs-6 fw-bolder text-gray-700 mr-3">{{__('messages.doctor.male')}}</label>&nbsp;&nbsp;
                <input class="form-check-input" tabindex="10" type="radio" checked name="gender" value="1">
                <label class="form-label fs-6 fw-bolder text-gray-700 mx-3">{{__('messages.doctor.female')}}</label>
                <input class="form-check-input" tabindex="11" type="radio" name="gender" value="2">
                </div>
            </span>
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label fw-bolder fs-6 text-gray-700 mb-2">{{ __('messages.patient.blood_group').':' }}</label>
        {{ Form::select('blood_group', $bloodGroup , null, ['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2",'placeholder' => 'Select Blood Group']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('twitter',__('messages.doctor.twitter').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('twitter_url', null,['class' => 'form-control form-control-solid','placeholder' => 'Twitter URL', 'id' => 'twitterUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('linkedin',__('messages.doctor.linkedin').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('linkedin_url', null,['class' => 'form-control form-control-solid','placeholder' => 'Linkedin URL', 'id' => 'linkedinUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('instagram',__('messages.doctor.instagram').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('instagram_url', null,['class' => 'form-control form-control-solid','placeholder' => 'Instagram URL', 'id' => 'instagramUrl']) }}
    </div>
    <div class="col-lg-6">
        <div class="justify-content-center">
            <label class="col-form-label fw-bolder fs-6">
                <span>{{__('messages.doctor.profile')}}: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this profile will be 150X150"
                   data-bs-original-title="Phone number must be active"
                   aria-label="Phone number must be active"></i>
            </label>
        </div>
        @php $styleCss = 'style'; @endphp
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center"
            {{ $styleCss }}="background-image: url({{asset('web/media/avatars/male.png')}})"></div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change profile">
            <i class="bi bi-pencil-fill fs-7"></i>
            <input type="file" tabindex="13" name="profile" id="profilePicture" accept=".png, .jpg, .jpeg">
            <input type="hidden" name="avatar_remove">
        </label>
    </div>
    <div class="form-text">{{__('messages.doctor.allowed_img')}}</div>
</div>
<div class="col-md-6 mb-5">
    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('messages.doctor.status')}}:</label>
    <div class="col-lg-8 d-flex align-items-center">
        <div class="form-check form-check-solid form-switch fv-row">
            <input tabindex="12" name="status" value="0" class="form-check-input w-45px h-30px" type="checkbox"
                   id="allowmarketing" checked="checked">
            <label class="form-check-label" for="allowmarketing"></label>
        </div>
    </div>
</div>
<div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
     href="#kt_modal_add_customer_billing_info" role="button" aria-expanded="false"
     aria-controls="kt_customer_view_details">
    {{__('messages.doctor.address_information')}}
</div>
<div class="row gx-10 mb-5">
    <div class="col-md-6 mb-5">
        {{ Form::label('Address1',__('messages.doctor.address1').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('address1', null,['class' => 'form-control form-control-solid','placeholder' => 'Address 1']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Address2',__('messages.doctor.address2').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('address2', null,['class' => 'form-control form-control-solid','placeholder' => 'Address 2']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('Country',__('messages.doctor.country').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('country_id', $country, null,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id'=>'countryId','placeholder' => 'Select Country']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('State',__('messages.doctor.state').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('state_id', [], null,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id'=> 'stateId','placeholder' => 'Select State']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('City',__('messages.doctor.city').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('city_id', [], null,['class' => 'form-control form-control-solid form-select', 'data-control'=>'select2', 'id'=> 'cityId','placeholder' => 'Select City']) }}
    </div>
    <div class="d-flex col-md-6 flex-column fv-row">
        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('messages.doctor.postal_code')}}:</label>
        {{ Form::text('postal_code',null,['class' => 'form-control form-control-solid','placeholder' => 'Postal Code']) }}
    </div>
</div>
<div class="d-flex">
    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
    <a href="{{route('doctors.index')}}" type="reset"
       class="btn btn-light btn-active-light-primary me-2">{{__('messages.common.discard')}}</a>
</div>
