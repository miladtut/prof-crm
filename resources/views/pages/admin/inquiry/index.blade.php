{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    {{request('type')?request('type'):'all'}} Inquiries
                </h3>
            </div>
        </div>

        <div class="card-body">

            <!--begin::Search Form-->
            <div class="mt-2 mb-5 mt-lg-5 mb-lg-10">
                <form action="{{route('admin.inquiries')}}">
                    <input type="hidden" name="type" value="{{request('type')}}">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-xl-3 mt-2">
                            @include('layout.partials.extras.selectable.statuses')
                        </div>

                        <div class="col-lg-4 col-xl-3 mt-2">
                            <div class="d-flex align-items-center">
                                <label>from:</label>
                                <input type="date" class="form-control" name="from" value="{{old('from')}}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-xl-3 mt-2">
                            <div class="d-flex align-items-center">
                                <label>to:</label>
                                <input type="date" class="form-control" name="to" value="{{old('to')}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-3 mt-2">
                            <div class="d-flex align-items-center">
                                <select name="material" class="form-control">
                                    @include('layout.partials.extras.selectable._materials1')
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xl-3 mt-2 ">
                            <input type="submit"  class="btn btn-primary px-6 font-weight-bold" value="Filter">
                            <button type="reset" class="btn btn-secondary px-6 font-weight-bold">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Search Form-->
            {{$dataTable->table()}}




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

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
   {{$dataTable->scripts()}}
@endsection
