<div class="row gx-10 mb-5">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('name', __('messages.front_patient_testimonial.name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('name', !empty($frontPatientTestimonial) ? $frontPatientTestimonial->name : null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Name', 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('designation', __('messages.front_patient_testimonial.designation').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('designation', !empty($frontPatientTestimonial) ? $frontPatientTestimonial->designation : null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Designation', 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('short_description', __('messages.front_patient_testimonial.short_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('short_description', !empty($frontPatientTestimonial) ? $frontPatientTestimonial->short_description : null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Short Description', 'required', 'id' => 'shortDescription', 'rows'=> 5, 'maxlength' => '111']) }}
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="justify-content-center">
            <label class="form-label fs-6 fw-bolder required text-gray-700 mr-3">{{ __('messages.front_patient_testimonial.profile').':' }}</label><span
                    data-bs-toggle="tooltip" title="Best resolution for this profile will be 100x100"> <i
                        class="fa fa-question-circle"></i></span>
        </div>
        @php $styleCss = 'style'; @endphp
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px"
            {{ $styleCss }}="background-image: url('{{ $frontPatientTestimonial->front_patient_profile }}')">
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
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('front-patient-testimonials.index') }}" type="reset"
           class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
    </div>
</div>

