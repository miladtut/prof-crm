{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="col-lg-6 col-xxl-4">
            @include('pages.company.widgets._widget-1', ['class' => 'card-stretch gutter-b'])
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            @include('pages.company.widgets._widget-6', ['class' => 'card-stretch gutter-b'])
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
