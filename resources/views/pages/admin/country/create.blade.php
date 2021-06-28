@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Country
        </div>
        <div class="card-body">

            <form class="form" action="{{route('admin.countries.save')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Basic Info:</h3>
                    <div class="mb-15 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Country Name:</label>


                            <div class="col-lg-3 offset-1">
                                <input name="name" type="text" value="{{old('name')}}" class="form-control" placeholder="Please Enter country name" required/>
                                <span class="form-text text-muted">Please Enter country name</span>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Phone Key:</label>


                            <div class="col-lg-3 offset-1">
                                <input name="phone_key" value="{{old('phone_key')}}" type="text" class="form-control" placeholder="Please Enter country Phone Key" required>
                                <span class="form-text text-muted">Please Enter country Phone Key</span>

                            </div>
                        </div>

                    </div>


                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <a class="btn btn-secondary" onclick="window.history.back()">Cancel</a>
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
