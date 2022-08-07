<div class="row gx-10 mb-5">
    <div class="col-md-6 mb-5">
        {{ Form::label('firstName',__('messages.patient.first_name').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
        {{ Form::text('first_name',!empty($patient->user) ? $patient->user->first_name : null,['class' => 'form-control form-control-solid','placeholder' => 'First Name','required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('lastName',__('messages.patient.last_name').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
        {{ Form::text('last_name',!empty($patient->user) ? $patient->user->last_name : null,['class' => 'form-control form-control-solid','placeholder' => 'Last Name','required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('patientUniqueId',__('messages.patient.patient_unique_id').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
        {{ Form::text('patient_unique_id',isset($data['patientUniqueId']) ? $data['patientUniqueId'] : null,['class' => 'form-control form-control-solid','required','maxLength' => '8','readonly']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('email',__('messages.patient.email').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
        {{ Form::email('email',!empty($patient->user) ? $patient->user->email : null,['class' => 'form-control form-control-solid','placeholder' => 'Email','required']) }}
    </div>
    @if(empty($patient))
        <div class="col-md-6 mb-5">
            <div class="fv-row" data-kt-password-meter="true">
                <div class="mb-1">
                    {{ Form::label('password',__('messages.patient.password').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                    <span data-bs-toggle="tooltip"
                          title="Use 8 or more characters with a mix of letters, numbers & symbols."><i
                                class="fa fa-question-circle"></i></span>
                    <div class="position-relative mb-3">
                        <input class="form-control form-control-lg form-control-solid"
                               type="password" placeholder="Password" name="password" autocomplete="off" required>
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
                    {{ Form::label('confirmPassword',__('messages.patient.confirm_password').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                    <span data-bs-toggle="tooltip"
                          title="Use 8 or more characters with a mix of letters, numbers & symbols."><i
                                class="fa fa-question-circle"></i></span>
                    <div class="position-relative mb-3">
                        <input class="form-control form-control-lg form-control-solid"
                               type="password" placeholder="Password" name="password_confirmation" autocomplete="off"
                               required>
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
    @endif
    <div class="col-md-6 mb-5">
        {{ Form::label('contactNo',__('messages.patient.contact_no').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <br>
        {{ Form::tel('contact',!empty($patient->user) ? $patient->user->contact : null,['class' => 'form-control form-control-solid','placeholder' => 'Contact No','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
        {{ Form::hidden('region_code',!empty($patient->user) ? $patient->user->region_code : null,['id'=>'prefix_code']) }}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('gender',__('messages.patient.gender').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <span class="form-check form-check-custom form-check-solid is-valid">
            <div class="align-items-baseline">
            <label class="form-label fs-6 fw-bolder text-gray-700 mr-3">{{ __('messages.patient.male') }}</label>&nbsp;&nbsp;
            <input class="form-check-input" checked type="radio" name="gender" value="1"
                   {{ !empty($patient->user) && $patient->user->gender === 1 ? 'checked' : '' }} >
            <label class="form-label fs-6 fw-bolder text-gray-700 mx-3">{{ __('messages.patient.female') }}</label>
            <input class="form-check-input" type="radio" name="gender" value="2"
                   {{ !empty($patient->user) && $patient->user->gender === 2 ? 'checked' : '' }} >
                </div>
        </span>
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('dob',__('messages.patient.dob').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('dob',!empty($patient->user) ? $patient->user->dob : null,['class' => 'form-control form-control-solid','id' => 'dob', 'placeholder' => 'DOB']) }}
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label fs-6 fw-bolder text-gray-700 mb-2">{{ __('messages.patient.blood_group').':' }}</label>
        {{ Form::select('blood_group', $data['bloodGroupList'] ,!empty($patient->user) ? $patient->user->blood_group : null, ['placeholder' => 'Select Blood Group','class' => 'form-select form-select-solid form-select-lg fw-bold', 'aria-label'=>"Select a Blood Group",'data-control'=>'select2']) }}
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="justify-content-center">
            <label class="col-form-label fw-bolder fs-6">
                <span>{{__('messages.patient.profile')}}: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this profile will be 150X150"
                   data-bs-original-title="Phone number must be active"
                   aria-label="Phone number must be active"></i>
            </label>
        </div>
        @php $styleCss = 'style'; @endphp
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px" id="bgImage"
            {{ $styleCss }}="
            background-image: url({{ !empty($patient->profile) ? $patient->profile : asset('web/media/avatars/male.png') }}
            )">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change profile">
            <i class="bi bi-pencil-fill fs-7">
                <input type="file" name="profile" accept=".png, .jpg, .jpeg">
            </i>
            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" id="profilePicture">
            <input type="hidden" name="avatar_remove">
        </label>
        </div>
        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
    </div>
    <div class="fw-bolder fs-3 rotate collapsible mb-7 mt-5" data-bs-toggle="collapse"
         href="#kt_modal_add_customer_billing_info" role="button" aria-expanded="false"
         aria-controls="kt_customer_view_details">{{ __('messages.patient.address_information') }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('address1',__('messages.patient.address1').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('address1',!empty($patient->address) ? $patient->address->address1 : null,['class' => 'form-control form-control-solid','placeholder' => 'Address 1']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('address2',__('messages.patient.address2').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('address2',!empty($patient->address) ? $patient->address->address2 : null,['class' => 'form-control form-control-solid','placeholder' => 'Address 2']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('country_id',__('messages.country.country').':',['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-2']) }}
        {{ Form::select('country_id', $data['countries'] ,null, ['id' => 'countryId','data-placeholder' => 'Select Country','class' => 'form-select form-select-solid form-select-lg fw-bold', 'aria-label'=>"Select a Country",
        'data-control'=>'select2']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('state_id',__('messages.state.state').':',['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-2']) }}
        {{ Form::select('state_id', [], null, ['id' => 'stateId','class' => 'form-select form-select-solid form-select-lg fw-bold',
'data-placeholder' => 'Select State','aria-label'=>"Select State",'data-control'=>'select2']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('city_id',__('messages.city.city').':',['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-2']) }}
        {{ Form::select('city_id', [], null, ['id' => 'cityId','class' => 'form-select form-select-solid form-select-lg fw-bold', 'data-placeholder' => 'Select City','aria-label'=>"Select City",'data-control'=>'select2']) }}
    </div>
    <div class="col-md-6 fv-row mb-7">
        {{ Form::label('postalCode',__('messages.patient.postal_code').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-2']) }}
        {{ Form::text('postal_code',!empty($patient->address) ? $patient->address->postal_code : null,['class' => 'form-control form-control-solid','placeholder' => 'Postal Code']) }}
    </div>
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2 my-1']) }}
        <a href="{{route('patients.index')}}" type="reset"
           class="btn btn-light btn-active-light-primary my-1">{{__('messages.common.discard')}}</a>
    </div>
</div>
