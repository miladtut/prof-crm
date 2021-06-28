{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Companies
                    <div class="text-muted pt-2 font-size-sm">here you will find all Companies</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{route('admin.companies.create')}}" class="btn btn-success font-weight-bolder">
                    New Company
                </a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">
            <!--begin::Search Form-->
            <form action="{{route('admin.companies')}}">
                <div class="mt-2 mb-5 mt-lg-5 mb-lg-10">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-xl-3 mt-2">
                            <select name="account_type" class="btn btn-light-danger form-control">
                                <option value="">All</option>
                                <option value="regular">regular</option>
                                <option value="logistic">logistic</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-xl-3 mt-2">
                            <select name="register_type" class="btn btn-light-danger form-control">
                                <option value="">All</option>
                                <option value="website">website</option>
                                <option value="profect">profect</option>
                            </select>
                        </div>

                        <div class="col-lg-2 col-xl-2 mt-2">
                            <label class="checkbox">
                                <input type="checkbox" name="blocked">
                                <span></span> :Blocked
                            </label>
                        </div>

                        <div class="col-lg-4 col-xl-3 mt-2">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 ">Created:</label>
                                <input class="form-control" type="date" name="created_from">
                            </div>
                        </div>

                        <div class="col-lg-4 col-xl-3 mt-2">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0">To:</label>
                                <input class="form-control" type="date" name="created_to">
                            </div>
                        </div>

                        <div class="col-lg-4 col-xl-3 mt-2">
                            <input type="submit" class="btn btn-primary px-6 font-weight-bold" value="Filter">


                            <input type="reset" class="btn btn-secondary px-6 font-weight-bold" value="Reset">


                        </div>

                    </div>
                </div>
            </form>
            <!--end::Search Form-->



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
