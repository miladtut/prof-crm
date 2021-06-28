@extends('layout.default')
@section('content')
    <div class="row">
        @foreach(\App\Models\Partner::all() as $partner)
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
                                        <img src="{{asset('uploads/'.$partner->logo)}}" alt="image">
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin::Title-->
                                <div class="d-flex flex-column">
                                    <a href="{{$partner->url}}" class="text-dark font-weight-bold text-hover-primary mb-0">{{$partner->name}}</a>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <p class="mb-7">{{$partner->description}}</p>

                        <a href="{{route('admin.profect.partners.delete',$partner->id)}}" class="btn btn-block btn-sm btn-light-danger font-weight-bolder text-uppercase py-4">delete</a>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->

            </div>
        @endforeach
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <form action="{{route('admin.profect.partners.add')}}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                            <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('media/users/blank.png')}})">
                                                <div class="image-input-wrapper" style="background-image: url({{asset('media/users/blank.png')}})"></div>

                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg"/>
                                                    <input type="hidden" name="logo_remove"/>
                                                </label>

                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>

                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                      <i class="ki ki-bold-close icon-xs text-muted"></i>
                                     </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column">
                                        <input type="text" class="form-control" name="name" placeholder="name">
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Title-->
                            </div>
                            <input type="text" class="form-control" name="url" placeholder="link">
                            <textarea class="mb-7 mt-7 form-control" name="description" placeholder="description"></textarea>

                            <input type="submit" class="btn btn-block btn-sm btn-light-success font-weight-bolder text-uppercase py-4" value="Save">
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </form>
            </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });


        var avatar4 = new KTImageInput('kt_image_4');

        avatar4.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('change', function(imageInput) {
            swal.fire({
                title: 'Image successfully changed !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });
    </script>
@endsection
