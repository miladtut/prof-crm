@extends('layout.default')
@section('content')
    @php($data = auth()->user())
    <div class="card">
        <div class="card-header">
            Edit Account
        </div>
        <div class="card-body">

            <form class="form" action="{{route('company-account-edit')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. basic Info:</h3>
                    <div class="mb-15 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">company Name:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="company_name" value="{{$data->company_name}}">
                                <span class="form-text text-muted">Please enter company name</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">contact person Name:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="contact_person_name" value="{{$data->contact_person_name}}">
                                <span class="form-text text-muted">Please enter contact person name</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Phone:</label>
                            <div class="col-lg-2">
                                <select name="phone_key" class="form-control select2" >
                                    @include('layout.partials.extras.selectable.phone_keys',['phone_key'=>$data->phone_key])
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="phone" value="{{$data->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Country</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <select name="country" class="form-control select2">
                                        @include('layout.partials.extras.selectable._countries',['coun_id'=>$data->country])
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">attach logo file : <br> <small>(optional)</small></label>
                            <div></div>
                            <div class="col-lg-6">
                                <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('media/users/blank.png')}})">
                                    <div class="image-input-wrapper" style="background-image: url({{asset('uploads/'.$data->logo_img)}})"></div>

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="logo_img" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="logo_img_remove"/>
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
                    </div>

                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Account Info:</h3>
                    <div class="mb-3 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email:</label>
                            <div class="col-lg-6">
                                <input name="email" type="email" class="form-control" value="{{$data->email}}" placeholder="Enter required email"/>
                                <span class="form-text text-muted">Please Enter required email</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <button class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
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
