@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Inquiry
        </div>
        <div class="card-body">

            <form class="form" action="{{route('admin.inquiry.customer-document.create',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">upload documents:</label>
                        <div class="col-lg-6">
                            <div class="custom-file">
                                <input type="file" name="doc[]" value="{{old('doc')}}" class="custom-file-input" id="validatedCustomFile" multiple="" required="">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">
                            please check the documents you have uploaded
                            <p class="text-muted"> choose at least 1 document</p>
                        </label>
                        <div class="col-6 col-form-label">
                            <div class="checkbox-list">
                                @foreach(\App\Models\Customerdoc::all() as $doc)
                                <label class="checkbox">
                                    <input type="checkbox"  name="cdocs[]" value="{{$doc->id}}"/>
                                    <span></span>
                                   {{$doc->name}}
                                </label>
                                @endforeach
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
