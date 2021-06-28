@extends('layout.default')
@section('content')
    <div class="row">
        @foreach(\App\Models\Supplier::all() as $partner)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::User-->
                        <div class="d-flex align-items-end mb-7">
                            <!--begin::Pic-->
                            <div class="d-flex align-items-center">
                                <!--begin::Pic-->
                                <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                    <div class="symbol symbol-circle symbol-lg-75">
                                        <img src="{{asset('uploads/'.$partner->logo_img)}}" alt="image">
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin::Title-->
                                <div class="d-flex flex-column">
                                    <a href="javascript:;" class="show_doc">{{$partner->supplier_name}}</a>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::User-->
                        <!--begin::Desc-->
                        <div class="mb-7 doc_container" style="display: none">
                            @foreach($partner->files()->get() as $file)
                                <div>
                                    {{str_replace('documents/','',$file->name)}}
                                    <a href="{{route('company.download',['path'=>$file->name])}}" class="fa fa-download"></a>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <!--end::Desc-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
        @endforeach
    </div>
@stop
@section('scripts')
    <script>
        $('.show_doc').click(function () {
            $(this).parent().parent().parent().parent().find('.doc_container').show()
        })
    </script>
@endsection
