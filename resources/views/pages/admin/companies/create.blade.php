@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Company
        </div>
        <div class="card-body">

            <form class="form" action="{{route('admin.companies.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. basic Info:</h3>
                    <div class="mb-15 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">company Name:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" value="{{old('company_name')}}" name="company_name" required>
                                <span class="form-text text-muted">Please enter company name</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">contact person Name:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="contact_person_name" required>
                                <span class="form-text text-muted">Please enter contact person name</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Phone:</label>
                            <div class="col-lg-2">
                                <select name="phone_key" class="form-control select2" required>
                                    @include('layout.partials.extras.selectable.phone_keys')
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Country</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <select name="country" class="form-control select2" required>
                                        @include('layout.partials.extras.selectable._countries')
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">attach logo file : <br> <small>(optional)</small></label>
                            <div></div>
                            <div class="col-lg-6">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="customFile"></label>
                                    <input name="logo_img" type="file" class="custom-file-input" id="customFile" accept="image/x-png,image/jpeg">
                                    <span class="form-text text-muted">( 5MP: Jpg, Jpeg, png )</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Account Info:</h3>
                    <div class="mb-3 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email:</label>
                            <div class="col-lg-6">
                                <input name="email" type="email" class="form-control" placeholder="Enter required email" required/>
                                <span class="form-text text-muted">Please Enter required email</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password:</label>
                            <div class="col-lg-6">
                                <input name="password" type="text" class="form-control" placeholder="Enter required password" required/>
                                <span class="form-text text-muted">Please Enter required password</span>
                            </div>
                        </div>






                        <div class="form-group row align-items-center">
                            <label class="col-lg-3 col-form-label">Account Type:</label>
                            <div class="col-lg-6">
                                <div class="radio-inline">
                                    <label class="radio radio-success">
                                        <input type="radio" name="account_type" value="regular"/>
                                        <span></span>
                                        Regular
                                    </label>
                                    <label class="radio radio-success">
                                        <input type="radio" name="account_type" value="logistic" checked="checked" />
                                        <span></span>
                                        Logistics
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
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
    </script>
@endsection
