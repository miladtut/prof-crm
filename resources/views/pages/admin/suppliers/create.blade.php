@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Supplier
        </div>
        <div class="card-body">

            <form class="form" action="{{route('admin.suppliers.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. basic Info:</h3>
                    <div class="mb-15 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">supplier Name:</label>
                            <div class="col-lg-6">
                                <input type="text" required class="form-control" value="{{old('supplier_name')}}" name="supplier_name">
                                <span class="form-text text-muted">Please enter supplier name</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">contact person Name:</label>
                            <div class="col-lg-6">
                                <input type="text" required class="form-control" name="contact_person_name">
                                <span class="form-text text-muted">Please enter contact person name</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Phone:</label>
                            <div class="col-lg-2">
                                <select name="phone_key" required class="form-control select2" >
                                    @include('layout.partials.extras.selectable.phone_keys')
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" required class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Country</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <select name="country" required class="form-control select2">
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
                                    <input type="file" name="logo_img" class="custom-file-input" id="validatedCustomFile" accept="image/x-png,image/jpeg">
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    <div class="text-muted">(5mb jpg,jpeg,png only)</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">supplier documents : </label>
                            <div></div>
                            <div class="col-lg-6">
                                <div class="custom-file">
                                    <input type="file" name="doc[]" class="custom-file-input" id="validatedCustomFile" multiple required>
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Account Info:</h3>
                    <div class="mb-3 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email:</label>
                            <div class="col-lg-6">
                                <input name="email" type="email" required class="form-control" placeholder="Enter required email"/>
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
