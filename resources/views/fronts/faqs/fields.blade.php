<div class="row gx-10 mb-5">
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('question', __('messages.faq.question').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('question', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Question', 'required']) }}
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('answer', __('messages.faq.answer').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('answer', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Answer', 'required', 'rows'=> 5, 'maxLength' => '1000']) }}
        </div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('faqs.index') }}" type="reset"
           class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
    </div>
</div>

