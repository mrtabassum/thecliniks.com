<div class="row gx-10 mb-5">

    <div class="col-lg-4 mb-7">
        <div class="justify-content-center">
            <label class="col-form-label fw-bold fs-6">
                <span>About Image 1: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this profile will be 325X325"></i>
            </label>
        </div>
        @php $styleCss = 'style'; @endphp
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px" id="bgImage"
            {{ $styleCss }}="background-image: url({{ !empty($cmsData['about_image_1']) ? $cmsData['about_image_1'] : asset('web/media/avatars/male.png') }})">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change icon">
            <i class="bi bi-pencil-fill fs-7">
                <input type="file" name="about_image_1" accept=".png, .jpg, .jpeg">
            </i>
        </label>
    </div>
    <div class="form-text">{{ __('messages.doctor.allowed_img') }}</div>
    </div>

    <div class="col-lg-4 mb-7">
        <div class="justify-content-center">
            <label class="col-form-label fw-bold fs-6">
                <span>About Image 2: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this profile will be 254X254"></i>
            </label>
        </div>
        @php $styleCss = 'style'; @endphp
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px" id="bgImage"
            {{ $styleCss }}="background-image: url({{ !empty($cmsData['about_image_2']) ? $cmsData['about_image_2'] : asset('web/media/avatars/male.png') }})">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change icon">
            <i class="bi bi-pencil-fill fs-7">
                <input type="file" name="about_image_2" accept=" .png, .jpg, .jpeg">
            </i>
        </label>
    </div>
    <div class="form-text">{{ __('messages.doctor.allowed_img') }}</div>
    </div>

    <div class="col-lg-4 mb-7">
        <div class="justify-content-center">
            <label class="col-form-label fw-bold fs-6">
                <span>About Image 3: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this profile will be 185X185"></i>
            </label>
        </div>
        @php $styleCss = 'style'; @endphp
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px" id="bgImage"
            {{ $styleCss }}="background-image: url({{ !empty($cmsData['about_image_3']) ? $cmsData['about_image_3'] : asset('web/media/avatars/male.png') }})">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change icon">
            <i class="bi bi-pencil-fill fs-7">
                <input type="file" name="about_image_3" accept=".png, .jpg, .jpeg">
            </i>
        </label>
    </div>
<div class="form-text">{{ __('messages.doctor.allowed_img') }}</div>
</div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('about_title', __('messages.web.about_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('about_title', $cmsData['about_title'], ['class' => 'form-control form-control-solid', 'placeholder' => 'About Title', 'required', 'id' => 'aboutTitleId']) }}
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('about_experience', __('messages.web.about_experience').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('about_experience', $cmsData['about_experience'], ['class' => 'form-control form-control-solid', 'placeholder' => 'Experience in year', 'required','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'id' => 'aboutExperienceId']) }}
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('about_short_description', __('messages.web.about_short_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::textarea('about_short_description', $cmsData['about_short_description'], ['class' => 'form-control form-control-solid', 'placeholder' => 'About Short Description','id' => 'shortDescription', 'required', 'rows'=> 5]) }}
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('term_condition', __('messages.cms.terms_conditions').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        <div id="termConditionId" class="editor-height"></div>
        {{ Form::hidden('terms_conditions', null, ['id' => 'termData']) }}
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('privacy_policy', __('messages.cms.privacy_policy').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        <div id="privacyPolicyId" class="editor-height"></div>
        {{ Form::hidden('privacy_policy', null, ['id' => 'privacyData']) }}
    </div>
</div>
<div class="d-flex">
    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
</div>
</div>

