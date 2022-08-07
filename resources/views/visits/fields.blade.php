<div class="row gx-10 mb-5">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('visit_date', __('messages.visit.visit_date').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::text('visit_date', isset($visit) ? $visit['visit_date'] : null, ['class' => 'form-control form-control-solid', 'id' => isset($visit) ? 'editDate' : 'date','placeholder' => 'Visit Date']) }}
        </div>
    </div>
    @role('doctor')
    {{ Form::hidden('doctor_id',getLoginUser()->doctor->id) }}
    @else
        <div class="col-lg-6">
            <div class="mb-5">
                {{ Form::label('Doctor',__('messages.doctor.doctor').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                {{ Form::select('doctor_id', $data['doctors'], isset($visit['doctor_id']) ? $visit['doctor_id'] : null,['class' => 'form-select form-select-solid form-select-lg fw-bold', 'data-control'=>'select2', 'id'=>'doctorId','placeholder' => 'Select Doctor']) }}
            </div>
        </div>
        @endrole
        <div class="col-lg-6">
            <div class="mb-5">
                {{ Form::label('Patient',__('messages.appointment.patient').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                {{ Form::select('patient_id', $data['patients'], isset($data['patientUniqueId']) ? $data['patientUniqueId'] : null,['class' => 'form-select form-select-solid form-select-lg fw-bold', 'data-control'=>'select2','placeholder' => 'Select Patient']) }}
            </div>
        </div>
        <div class="col-lg-6 mb-5">
            {{ Form::label('Description',__('messages.appointment.description').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{  Form::textarea('description', null, ['class'=> 'form-control form-control-solid','rows'=> 5,'placeholder'=>'Description' ])}}
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-primary" id="btnSubmit">{{ __('messages.common.save') }}</button>&nbsp;&nbsp;&nbsp;
            <a href="{{ getLogInUser()->hasRole('doctor') ? route('doctors.visits.index') : route('visits.index') }}"
               type="reset"
               class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.discard') }}</a>
        </div>
</div>

