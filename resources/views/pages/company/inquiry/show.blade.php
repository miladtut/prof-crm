@extends('layout.default')
@section('content')
    @if(@$data->status_name == 'declined')
    <div class="disabled" style="top: 65px;width: calc(100vw - 300px);height:calc(100vh - 60px);z-index: 1000000;background-color: rgba(0,0,0,0.1);position: fixed">
        <div class="text-center" style="color: darkred;font-weight: bolder;font-size: xx-large;margin-top:calc(50vh - 35px)">Declined Inquiry</div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-4 section-left">
            @include('pages.widgets.company.inquiry_details', ['class' => 'gutter-b'])
            @include('pages.widgets.company.status_logs', ['class' => 'gutter-b'])
        </div>
        <div class="col-lg-8 section-right">
            {{$extra->run()}}
        </div>
    </div>
    @include('layout.partials.extras.modals.reject')
    @include('layout.partials.extras.modals.preview')
@endsection
