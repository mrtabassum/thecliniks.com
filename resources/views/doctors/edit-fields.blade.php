<div class="row mb-5">
    <div class="col-md-6 mb-5">
        {{ Form::label('First Name',__('messages.doctor.first_name').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('first_name', $user->first_name,['class' => 'form-control form-control-solid','placeholder' => 'First Name','required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Last Name',__('messages.doctor.last_name').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('last_name', $user->last_name,['class' => 'form-control form-control-solid','placeholder' => 'Last Name','required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Email',__('messages.user.email').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::email('email', $user->email,['class' => 'form-control form-control-solid','placeholder' => 'Email']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Contact', __('messages.user.contact_number').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <br>
        {{ Form::text('contact', $user->contact, ['class' => 'form-control form-control-solid', 'placeholder' => 'Contact Number','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
        {{ Form::hidden('region_code',!empty($user->user) ? $user->user->region_code : null,['id'=>'prefix_code']) }}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('DOB',__('messages.doctor.dob').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('dob', $user->dob,['class' => 'form-control form-control-solid','placeholder' => 'DOB', 'id'=>'dob']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Specialization',__('messages.doctor.specialization').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('specializations[]',$data['specializations'], $data['doctorSpecializations'],['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'multiple']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Experience', __('messages.doctor.experience').':', ['class' => 'form-label  fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('experience', $doctor->experience, ['class' => 'form-control form-control-solid', 'placeholder' => 'Experience In Year','step'=>'any']) }}
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3 required">{{__('messages.doctor.select_gender')}}
            :</label>
        <span class="form-check form-check-custom form-check-solid is-valid">
            <div class="align-items-baseline">
                <label class="form-label fs-6 fw-bolder text-gray-700 mr-3">{{__('messages.doctor.male')}}</label>&nbsp;&nbsp;
                <input name="gender" class="form-check-input" tabindex="10" type="radio" name="gender"
                       value="1"  {{ !empty($user->gender) && $user->gender === 1 ? 'checked' : '' }}>
                <label class="form-label fs-6 fw-bolder text-gray-700 mx-3">{{__('messages.doctor.female')}}</label>
                <input name="gender" class="form-check-input" tabindex="11" type="radio" name="gender"
                       value="2" {{ !empty($user->gender) && $user->gender === 2 ? 'checked' : ''}}>
                </div>
            </span>
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label fw-bolder fs-6 text-gray-700 mb-2">{{ __('messages.patient.blood_group').':' }}</label>
        {{ Form::select('blood_group', $bloodGroup , $user->blood_group, ['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2",'placeholder' => 'Select Blood Group']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('twitter',__('messages.doctor.twitter').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('twitter_url', !empty($doctor->twitter_url) ? $doctor->twitter_url : null,['class' => 'form-control form-control-solid','placeholder' => 'Twitter URL','id' => 'twitterUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('linkedin',__('messages.doctor.linkedin').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('linkedin_url', !empty($doctor->linkedin_url) ? $doctor->linkedin_url : null,['class' => 'form-control form-control-solid','placeholder' => 'Linkedin URL', 'id' => 'linkedinUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('instagram',__('messages.doctor.instagram').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('instagram_url', !empty($doctor->instagram_url) ? $doctor->instagram_url : null,['class' => 'form-control form-control-solid','placeholder' => 'Instagram URL', 'id' => 'instagramUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
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
        <div class="image-input image-input-outline" data-kt-image-input="true"
        {{ $styleCss }}="background-image: url('{{ asset('web/media/avatars/male.png') }}')">
        <div class="image-input-wrapper w-125px h-125px" id="bgImage"
        {{ $styleCss }}="background-image: url('{{ $user->profile_image }}')">
    </div>
    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
           data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
           data-bs-original-title="Change profile">
        <i class="bi bi-pencil-fill fs-7">
            <input type="file" name="profile" value="{{ asset('web/media/avatars/male.png') }}"
                       accept=".png, .jpg, .jpeg">
            </i>
            <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
            <input type="hidden" name="avatar_remove">
        </label>
    </div>
    <div class="form-text">{{__('messages.doctor.allowed_img')}}.</div>
</div>
<div class="col-md-6 mb-5">
    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('messages.doctor.status')}}:</label>
    <div class="col-lg-8 d-flex align-items-center">
        <div class="form-check form-check-solid form-switch fv-row">
            <input name="status" class="form-check-input w-45px h-30px checkBoxClass"
                   type="checkbox" {{$user->status == 1 ? 'checked' : ''}}>
            <label class="form-check-label" for="allowmarketing"></label>
        </div>
    </div>
</div>
<div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
     href="#kt_modal_add_customer_billing_info" role="button" aria-expanded="false"
     aria-controls="kt_customer_view_details">{{__('messages.doctor.address_information')}}
</div>
<div class="row gx-10 mb-5">
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('Address 1', __('messages.doctor.address1').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('address1', isset($user->address->address1) ? $user->address->address1 : '', ['class' => 'form-control form-control-solid', 'placeholder' => 'Address 1']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('Address 2', __('messages.doctor.address2').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('address2', isset($user->address->address2) ? $user->address->address2 : '', ['class' => 'form-control form-control-solid', 'placeholder' => 'Address 2']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('Country',__('messages.doctor.country').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('country_id', $countries, isset($user->address->country_id) ? $user->address->country_id:null,
['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id'=>'countryId','placeholder' => 'Select Country']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('State',__('messages.doctor.state').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('state_id', (isset($state) && $state!=null) ? $state:[], isset($user->address->state_id) ? $user->address->state_id:null, ['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id'=> 'stateId','placeholder' => 'Select State']) }}
    </div>
    <div class="d-flex col-md-6 flex-column mb-7 fv-row">
        {{ Form::label('City',__('messages.doctor.city').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('city_id', (isset($cities) && $cities!=null) ? $cities:[], isset($user->address->city_id) ? $user->address->city_id:null, ['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id'=> 'cityId','placeholder' => 'Select City']) }}
    </div>
    <div class="col-md-6 fv-row">
        {{ Form::label('Postal Code', __('messages.doctor.postal_code').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('postal_code', isset($user->address->postal_code) ? $user->address->postal_code : '', ['class' => 'form-control form-control-solid', 'placeholder' => 'Postal Code']) }}
    </div>
</div>
<div class="d-flex flex-stack align-items-sm-center align-items-start flex-sm-row flex-column">
    <div class="fw-bolder fs-3 rotate collapsible" data-bs-toggle="collapse"
         href="#kt_modal_add_customer_billing_info"
         role="button" aria-expanded="false"
         aria-controls="kt_customer_view_details">{{ __('messages.doctor.qualification_information') }}
    </div>
    <a class="btn btn-primary float-end mt-sm-0 mt-2" id="addQualification">{{__('messages.doctor.add_qualification')}}</a>
</div>
<input type="hidden" name="deletedQualifications" value="" id="deletedQualifications">
<div class="row showQualification w-100">
    <div class="d-flex col-md-4 flex-column mb-7 fv-row">
        {{ Form::label('Degree', __('messages.doctor.degree').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('degree', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Degree', 'id'=>'degree']) }}
    </div>
    <div class="d-flex col-md-4 flex-column mb-7 fv-row">
        {{ Form::label('university', __('messages.doctor.university').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('university', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'University', 'id'=>'university']) }}
    </div>
    <div class="d-flex col-md-4 flex-column mb-7 fv-row">
        <label class="fs-6 fw-bold mb-2 required">{{__('messages.doctor.year')}}:</label>
        {{ Form::select('year', $years,!empty($qualifications->year) ? $qualifications->year : null, ['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id'=> 'year', 'placeholder' => 'Select Year']) }}
    </div>
    <div class="d-flex col-md-4">
        <button type="button" class="btn btn-primary me-3"
                id="saveQualification">{{__('messages.common.save')}}</button>
        <button type="button" class="btn btn-light btn-active-light-primary"
                id="cancelQualification">{{__('messages.common.discard')}}</button>
    </div>
</div><br>
<div class="table-responsive-sm w-100">
    <table class="table table-row-dashed table-row-gray-300 gy-7" id="doctorQualificationTbl">
        <thead>
        <tr class="fw-bolder fs-6 text-gray-800">
            <th>{{Str::upper(__('messages.doctor.sr_no'))}}</th>
            <th>{{ Str::upper(__('messages.doctor.degree'))}}</th>
            <th>{{ Str::upper(__('messages.doctor.collage_university'))}}</th>
            <th>{{ Str::upper(__('messages.doctor.year'))}}</th>
            <th class="text-center">{{ Str::upper(__('messages.common.action'))}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($qualifications as $index => $qualification)
            <tr>
                <td id="qualificationId">{{$index+1}}</td>
                <td id="degreeTd">{{$qualification->degree}}</td>
                <td id="universityTd">{{$qualification->university}}</td>
                <td id="yearTd">{{$qualification->year}}</td>
                <td class="text-center whitespace-nowrap">
                    <a data-id="{{$index+1}}" data-primary-id="{{$qualification->id}}" title="Edit"
                       class="btn edit-btn-qualification btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                        <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                              fill="#000000" fill-rule="nonzero"
                              transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"/>
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                              fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        </svg></span>
                    </a>
                    <a data-id="{{$qualification->id}}" title="Delete"
                       class="delete-btn-qualification btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                              fill="#000000" fill-rule="nonzero"/>
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                              fill="#000000" opacity="0.3"/></g></svg></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex">
    <button type="submit" class="btn btn-primary">{{__('messages.common.save')}}</button>&nbsp;&nbsp;&nbsp;
    <a href="{{route('doctors.index')}}" type="reset"
       class="btn btn-light btn-active-light-primary me-2">{{__('messages.common.discard')}}</a>
</div>
