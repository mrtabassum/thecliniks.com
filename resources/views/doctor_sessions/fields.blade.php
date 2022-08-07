@php($weekDays = App\Models\ClinicSchedule::WEEKDAY_FULL_NAME)
@php($gaps = App\Models\DoctorSession::GAPS)
@php($sessionMeetingTime = App\Models\DoctorSession::SESSION_MEETING_TIME)
@php($clinicSchedule = App\Models\ClinicSchedule::all())
<div class="row gx-10 mb-9">
    <div class="col-12">
        <div class="maincard-section p-0">
            <div class="row">
                @if(isset($doctorSession))
                    <div class="ms-3 pb-2 d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                <img src="{{$doctorSession->doctor->user->profile_image}}"
                                     class="object-cover w-100"
                                     alt=""/>
                            </div>
                        </div>
                        <span class="fs-3 fw-bolder me-3"
                              data-kt-calendar="event_name">{{$doctorSession->doctor->user->full_name}}</span>
                    </div>
                @endif
                @if(Auth::user()->hasRole('doctor'))
                    <input type="hidden" name="doctor_id" value="{{ Auth::user()->doctor->id }}"/>
                @elseif(!isset($sessionWeekDays))
                    <div class="{{ isset($doctorSession) ? 'col-xl-6' : 'col-xl-4' }} col-sm-6">
                        <div class="my-4">
                            {{ Form::label('doctor_id',__('messages.doctor.doctor').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 align-self-center ms-3']) }}
                            <div class="ms-3">
                                {{ Form::select('doctor_id', $doctorsList, null,['class' => 'form-control form-control-solid form-select w-100', 'data-control'=>'select2','placeholder' => 'Select Doctor','required']) }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="{{ isset($doctorSession) ? 'col-xl-6' : 'col-xl-4' }} col-sm-6">
                    <div class="my-4">
                        {{ Form::label('session_gap',__('messages.doctor_session.session_gap').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 align-self-center ms-3']) }}
                        <div class="ms-3">
                            {{ Form::select('session_gap', $gaps,isset($sessionWeekDays)  ? null : $gaps[array_key_first($gaps)],
    ['class' => 'form-control form-control-solid form-select','data-width' => '100%', 'data-control'=>'select2','id' => 'selGap', 'placeholder' => 'Select schedule gap','required']) }}
                        </div>
                    </div>
                </div>
                <div class="{{ isset($doctorSession) ? 'col-xl-6' : 'col-xl-4' }} col-sm-6">
                    <div class="my-4">
                        {{ Form::label('session_meeting_time',__('messages.doctor_session.session_meeting_time').':' ,['class' => 'form-label required fs-6 fw-bolder text-gray-700 align-self-center ms-3']) }}
                        <div class="ms-3">
                            {{ Form::select('session_meeting_time', $sessionMeetingTime, isset($sessionWeekDays)  ? null : $sessionMeetingTime[array_key_first($sessionMeetingTime)],
    ['class' => 'form-control form-control-solid form-select','data-width' => '100%', 'data-control'=>'select2' ,'placeholder' => 'Select meeting time','required']) }}
                        </div>
                    </div>
                </div>
            </div>
            @foreach(App\Models\ClinicSchedule::WEEKDAY as $day => $shortWeekDay)
                @php($isValid = isset($sessionWeekDays) && $sessionWeekDays->where('day_of_week',$day)->count() != 0)
                @php($clinicScheduleDay = $clinicSchedule->where('day_of_week',$day)->first())
                <div class="weekly-content" data-day="{{$day}}">
                    <div class="d-flex w-100 align-items-center position-relative">
                        <div class="d-flex flex-md-row flex-column w-100 weekly-row">
                            <div class="form-check form-check-custom form-check-solid mb-0 checkbox-content d-flex align-items-center">
                                <input id="chkShortWeekDay_{{$shortWeekDay}}" class="form-check-input" type="checkbox"
                                       value="{{$day}}" name="checked_week_days[]"
                                       @if(isset($sessionWeekDays))
                                       @if($isValid)
                                       checked="checked"
                                       @else
                                       disabled
                                       @endif
                                       @elseif(!$loop->last && $clinicScheduleDay)
                                       checked="checked"
                                       @else
                                       disabled
                                        @endif>
                                <label class="form-check-label" for="chkShortWeekDay_{{$shortWeekDay}}">
                                    <span class="fs-5 fw-bold d-md-block d-none">{{$shortWeekDay}}</span>
                                </label>
                            </div>
                            @if(isset($sessionWeekDays))
                                @if(!$isValid)
                                    <div class="unavailable-time">{{ __('messages.doctor_session.unavailable') }}</div>
                                @endif
                            @elseif($loop->last || !$clinicScheduleDay)
                                <div class="unavailable-time">{{ __('messages.doctor_session.unavailable') }}</div>
                            @endif
                            <div class="session-times">
                                @if($clinicScheduleDay)
                                    @php($slots = getSlotByGap($clinicScheduleDay->start_time,$clinicScheduleDay->end_time))
                                    @if(isset($sessionWeekDays) && $sessionWeekDays->count())
                                        @foreach($sessionWeekDays->where('day_of_week',$day) as $weekDaySlot)
                                            @include('doctor_sessions.slot',['slot' => $slots,'day' => $day,'weekDaySlot' => $weekDaySlot])
                                        @endforeach
                                    @else
                                        @if(!$loop->last)
                                            @if(!isset($sessionWeekDays) || $isValid)
                                                @include('doctor_sessions.slot',['slot' => $slots,'day' => $day])
                                            @endif
                                        @else
                                            <div class="session-time"></div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                        @if($clinicScheduleDay)
                            <div class="weekly-icon position-absolute end-0 d-flex">
                                <a href="javascript:void(0)" class="add-session-time" data-bs-toggle="tooltip"
                                   title="Add">
                                    <img class="me-4"
                                         src="{{ Auth::user()->dark_mode ?asset('assets/image/dark-plus.svg'):asset('assets/image/plus.svg')}}"
                                         alt=""/>
                                </a>
                                <div>
                                    <a href="javascript:void(0)" class="" data-kt-menu-trigger="click"
                                       data-kt-menu-attach="parent"
                                       data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom"
                                       data-bs-toggle="tooltip" title="Copy">
                                        <img src="{{ Auth::user()->dark_mode?asset('assets/image/dark-copy.svg'):asset('assets/image/copy.svg')}}"
                                             alt=""/>
                                    </a>
                                    <div class="copy-card menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg menu-state-primary"
                                         data-kt-menu="true">
                                        <div class="menu-item">
                                            <div class="menu-content">
                                                @foreach($weekDays as $weekDayKey => $weekDay)
                                                    @if($day != $weekDayKey && $clinicSchedule->where('day_of_week',$weekDayKey)->count())
                                                        <div class="form-check form-check-custom form-check-solid copy-label">
                                                            <label class="form-check-label w-100 ms-0"
                                                                   for="chkCopyDay_{{$shortWeekDay}}_{{$weekDay}}">
                                                                {{$weekDay}}
                                                            </label>
                                                            <input class="form-check-input copy-check-input"
                                                                   id="chkCopyDay_{{$shortWeekDay}}_{{$weekDay}}"
                                                                   type="checkbox" value="{{$weekDayKey}}"/>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <button type="button" data-copy-day="{{$day}}"
                                                        class="btn btn-primary copy-btn">{{ __('messages.doctor_session.copy') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div>
    @if($clinicSchedule->count() == 0)
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2','disabled']) }}
    @else
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
    @endif
    @if(!getLogInUser()->hasRole('doctor'))
        <a href="{{url()->previous()}}" type="reset"
           class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
    @endif
</div>
