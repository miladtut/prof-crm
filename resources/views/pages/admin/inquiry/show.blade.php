@extends('layout.default')
@section('content')

    <div class="row">
        <div class="col-lg-4 section-left">
            @include('pages.widgets.admin.inquiry_details', ['class' => 'gutter-b'])
            @include('pages.widgets.admin.status_logs', ['class' => 'gutter-b'])
        </div>
        <div class="col-lg-8 section-right">
            {{$extra->run()}}
        </div>
    </div>
    @include('layout.partials.extras.modals.status')
    @include('layout.partials.extras.modals.payment')
    @include('layout.partials.extras.modals.preview')
@endsection
