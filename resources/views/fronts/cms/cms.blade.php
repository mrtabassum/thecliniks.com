@extends('layouts.app')
@section('title')
    {{ __('messages.cms.cms') }}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid mb-10 mb-lg-0">
                    <div class="row">
                        <div class="col-12">
                            @include('layouts.errors')
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-12">
                            {{ Form::open(['route' => 'cms.update', 'id' => 'addCMSForm','files' => true]) }}
                            <div class="card-body p-9">
                                @include('fronts.cms.fields')
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        let termConditionData = `{{$cmsData['terms_conditions']}}`;
        let privacyPolicyData = `{{$cmsData['privacy_policy']}}`;
    </script>
    <script src="{{mix('assets/js/fronts/cms/create.js')}}"></script>
@endsection

