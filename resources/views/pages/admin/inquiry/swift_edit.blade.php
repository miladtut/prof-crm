@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Swift file Edit
        </div>
        <div class="card-body">

            <form class="form" action="{{route('admin.swift.edit',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">upload documents:</label>
                        <div class="col-lg-6">
                            <div class="custom-file">
                                <input type="file" name="doc[]" value="{{old('doc')}}" class="custom-file-input" id="validatedCustomFile" multiple="" required="">
                                <label class="custom-file-label" for="validatedCustomFile">
                                    Choose files..
                                </label>
                                <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <a onclick="window.history.back()" class="btn btn-secondary">Cancel</a>
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
