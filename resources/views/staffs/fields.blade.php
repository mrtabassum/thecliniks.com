<div class="row gx-10 mb-5">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('first_name', __('messages.staff.first_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('first_name', isset($staff) ? $staff->first_name : null, ['class' => 'form-control form-control-solid', 'placeholder' => 'First Name', 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('last_name', __('messages.staff.last_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('last_name', isset($staff) ? $staff->last_name : null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Last Name', 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('email', __('messages.staff.email').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::email('email', isset($staff) ? $staff->email : null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Email', 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('contact', __('messages.staff.contact_no').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            {{ Form::tel('contact', isset($staff) ? $staff->contact : null, ['class' => 'form-control form-control-solid', 
                'placeholder' => 'Contact No','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
            {{ Form::hidden('region_code',!empty($staff) ? $staff->region_code : null,['id'=>'prefix_code']) }}
            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
            <span id="error-msg" class="hide"></span>
        </div>
    </div>
    <div class="col-md-6 mb-5">
        <div class="fv-row" data-kt-password-meter="true">
            <div class="mb-1">
                {{ Form::label('password',__('messages.staff.password').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">{{isset($staff) ? null : '*' }}</span>
                <span data-bs-toggle="tooltip"
                      title="Use 8 or more characters with a mix of letters, numbers & symbols."><i
                            class="fa fa-question-circle"></i></span>
                <div class="position-relative mb-3">
                    <input class="form-control form-control-lg form-control-solid"
                           type="password" placeholder="Password" name="password" autocomplete="off">
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
                {{ Form::label('confirmPassword',__('messages.staff.confirm_password').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">{{isset($staff) ? null : '*' }}</span>
                <span data-bs-toggle="tooltip"
                      title="Use 8 or more characters with a mix of letters, numbers & symbols."><i
                            class="fa fa-question-circle"></i></span>
                <div class="position-relative mb-3">
                    <input class="form-control form-control-lg form-control-solid"
                           type="password" placeholder="Confirm Password" name="password_confirmation"
                           autocomplete="off">
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
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('role', __('messages.staff.role').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('role', $roles, isset($staff) ? $staff->roles->first()->id : null, ['class' => 'form-select form-select-solid form-select-lg fw-bold','required','data-control'=>'select2','placeholder' => 'Select role']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('gender', __('messages.staff.gender').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="form-check form-check-custom form-check-solid is-valid">
                <div class="align-items-baseline">
            <label class="form-label fs-6 fw-bolder text-gray-700 mr-3">{{ __('messages.staff.male') }}</label>&nbsp;&nbsp;
            <input class="form-check-input" checked type="radio" name="gender" value="1"
                   {{ !empty($staff) && $staff->gender === 1 ? 'checked' : '' }} required>
            <label class="form-label fs-6 fw-bolder text-gray-700 mx-3">{{ __('messages.staff.female') }}</label>
            <input class="form-check-input" type="radio" name="gender" value="2"
                   {{ !empty($staff) && $staff->gender === 2 ? 'checked' : '' }} required>
                </div>
        </span>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="justify-content-center">
            <label class="col-form-label fw-bold fs-6">
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
            {{ $styleCss }}="background-image: url({{ !empty($staff->profile_image) ? $staff->profile_image : asset('web/media/avatars/male.png') }})">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change profile">
            <i class="bi bi-pencil-fill fs-7">
                <input type="file" name="profile" accept=".png, .jpg, .jpeg">
            </i>
            <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
            <input type="hidden" name="avatar_remove">
            </label>
        </div>
        <div class="form-text">{{__('messages.doctor.allowed_img')}}</div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('staff.index') }}" type="reset"
           class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
    </div>
</div>

