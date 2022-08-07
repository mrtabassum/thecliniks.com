@include('flash::message')
@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ (isset($sectionName) && $sectionName == 'general') ? 'active' : ''}}"
                       href="{{ route('setting.index',['section' => 'general']) }}">{{ __('messages.setting.general') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ (isset($sectionName) && $sectionName == 'contact_information') ? 'active' : ''}}"
                       href="{{ route('setting.index',['section' => 'contact_information']) }}">{{ __('messages.setting.contact_information') }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
