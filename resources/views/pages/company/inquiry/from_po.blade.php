@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Inquiry
        </div>
        <div class="card-body">

            <form class="form" action="{{route('company.from-po')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Material Info:</h3>


                    <div class="mb-15 ml-17">

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Upload purchasing order (po)</label>
                            <div></div>
                            <div class="col-lg-6">
                                <div class="custom-file">
                                    <input type="file" name="doc[]" value="{{old('doc')}}" class="custom-file-input" multiple id="validatedCustomFile">
                                    <label class="custom-file-label selected" for="validatedCustomFile">Choose file...</label>
                                    <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
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
