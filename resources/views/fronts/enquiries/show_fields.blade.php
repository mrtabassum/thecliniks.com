<div class="col-12">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.web.name') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold fs-6 text-gray-800">{{$enquiry->name}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.web.email') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold fs-6 text-gray-800">{{$enquiry->email}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.web.phone') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold fs-6 text-gray-800">{{!empty($enquiry->phone) &&  !empty($enquiry->region_code) ? '+'.$enquiry->region_code.' '.$enquiry->phone : __('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.web.subject') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold fs-6 text-gray-800">{{$enquiry->subject}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.web.message') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold fs-6 text-gray-800">{{$enquiry->message}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.registered_on') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800 me-2 " data-bs-toggle="tooltip"
                                      data-bs-placement="right"
                                      title="{{\Carbon\Carbon::parse($enquiry->created_at)->format('jS M Y')}}">{{$enquiry->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.last_updated') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800 me-2" data-bs-toggle="tooltip"
                                      data-bs-placement="right"
                                      title="{{\Carbon\Carbon::parse($enquiry->updated_at)->format('jS M Y')}}">{{$enquiry->updated_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
