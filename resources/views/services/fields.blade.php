<div class="row gx-10 mb-5">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('name', __('messages.common.name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('name', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Name']) }}
        </div>
    </div>
    @php $styleCss = 'style'; @endphp
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('category_id',__('messages.service.category').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            <div class="input-group flex-nowrap">
                {{ Form::select('category_id',$data['serviceCategories'], null,['class' => 'form-control form-control-solid form-select w-100%',
            'placeholder' => 'Select Category','data-control'=>'select2','id'=>'serviceCategory']) }}
                <div class="input-group-append plus-icon-height d-flex w-45px"
                {{ $styleCss }}="height: 42px!important;margin-left: 3px;" id="createServiceCategory">
                <div class="input-group-text form-control form-control-solid">
                    <a href="#" class="btn btn-icon" data-toggle="modal"
                       data-target="#createServiceCategoryModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="mb-5">
            {{ Form::label('charges', __('messages.service.charges').':', ['class' => 'form-label fs-6 required fw-bolder text-gray-700 mb-3']) }}
            <div class="input-group">
                {{ Form::text('charges', null, ['class' => 'form-control form-control-solid price-input', 'placeholder' => 'Charges','step'=>'any','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                <div class="input-group-text border-0">
                    <a class="fw-bolder text-gray-500">{{ getCurrencyIcon() }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        {{ Form::label('doctors', __('messages.doctors').':', ['class' => 'form-label fs-6 required fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('doctors[]',$data['doctors'],(isset($selectedDoctor)) ? $selectedDoctor : null,['class' => 'form-control form-control-solid form-select', 'data-placeholder' => 'Select Doctors', 'data-control'=>'select2','multiple']) }}
    </div>
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('short_description', __('messages.service.short_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Maximum 60 character allow"></i>
            {{ Form::textarea('short_description', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Short Description', 'required', 'rows'=> 5,'maxlength'=> 60]) }}
        </div>
    </div>

    <div class="col-lg-6 mb-7">
        <div class="justify-content-center">
            <label class="col-form-label fw-bold fs-6 required">
                <span>{{__('messages.front_service.icon')}}: </span>
            </label>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this profile will be 130X130"></i>
            </div>
            @php $styleCss = 'style'; @endphp
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <div class="image-input-wrapper w-125px h-125px" id="bgImage"
                {{ $styleCss }}="background-image: url({{ !empty($service->icon) ? $service->icon : asset('web/media/avatars/male.png') }})">
            </div>
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                   data-bs-original-title="Change icon">
                <i class="bi bi-pencil-fill fs-7">
                    <input type="file" name="icon" accept=".svg, .png, .jpg, .jpeg">
                </i>
            </label>
            </div>
        <div class="form-text">Allowed file types: svg, png, jpg, jpeg.</div>
    </div>
    
    <div class="mb-5 col-lg-6">
        {{ Form::label('status', __('messages.doctor.status').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        @if(!empty($service))
            <div class="col-lg-8 d-flex align-items-center">
                <div class="form-check form-check-solid form-switch fv-row">
                    <input type="checkbox" name="status" value="1" class="form-check-input w-45px h-30px"
                           id="allowmarketing" {{ $service->status == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="allowmarketing"></label>
                </div>
            </div>
        @else
            <div class="col-lg-8 d-flex align-items-center">
                <div class="form-check form-check-solid form-switch fv-row">
                    <input type="checkbox" name="status" value="1" class="form-check-input w-45px h-30px"
                           id="allowmarketing" checked>
                    <label class="form-check-label" for="allowmarketing"></label>
                </div>
            </div>
        @endif
    </div>
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2 my-1']) }}
        <a href="{{route('services.index')}}" type="reset"
           class="btn btn-light btn-active-light-primary my-1">{{__('messages.common.discard')}}</a>
    </div>
</div>
