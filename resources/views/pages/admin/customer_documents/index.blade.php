{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Documents
                    <div class="text-muted pt-2 font-size-sm">here you will find all Documents</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{route('admin.cdocuments.create')}}" class="btn btn-success font-weight-bolder">
                    New Document
                </a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">

            {!! $dataTable->table() !!}

        </div>

    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>

@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    {{-- page scripts --}}

{{--    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    {{$dataTable->scripts()}}

@endsection
