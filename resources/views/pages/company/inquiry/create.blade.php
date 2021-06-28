@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Inquiry
        </div>
        <div class="card-body">

            <form class="form" action="{{route('company-inquiry-create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Material Info:</h3>
                    <div class="mb-15 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Material Name:</label>
                            <div class="col-lg-6">

                                    @include('layout.partials.extras.selectable._materials')

                                <span class="form-text text-muted">Please enter material name Or choose from suggestions list</span>
                            </div>
                        </div>
                        <div class="form-group row" id="o_mat">


                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Specifications:</label>
                            <div class="col-lg-3">
                                <select name="spec_id" class="form-control select2" required>
                                    @include('layout.partials.extras.selectable._specs')
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">COA file : <br> <small>(optional)</small></label>
                            <div></div>
                            <div class="col-lg-6">
                                <div class="custom-file">
                                    <input type="file" value="{{old('coa_attachment')}}" name="coa_attachment" class="custom-file-input" id="validatedCustomFile">
                                    <label class="custom-file-label selected" for="validatedCustomFile">Choose file...</label>
                                    <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Inquiry Info:</h3>
                    <div class="mb-3 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Quantity:</label>
                            <div class="col-lg-3">
                                <input name="qty" value="{{old('qty')}}" type="number" class="form-control" required placeholder="Enter required material quantity"/>
                                <span class="form-text text-muted">Please Enter required material quantity</span>
                            </div>
                            <label class="col-lg-1 col-form-label text-right">Unit:</label>
                            <div class="col-lg-2">
                                <select name="qty_unit" class="form-control form-control-solid" required>
                                    @include('layout.partials.extras.selectable._units1')
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-lg-3 col-form-label">Documents:</label>
                            <div class="col-lg-6">
                                <div class="checkbox-inline">
                                    @foreach(\App\Models\Document::all() as $document)
                                        <label class="checkbox">
                                            <input name="document[]" type="checkbox" value="{{$document->id}}"/>
                                            <span></span>
                                            {{$document->name}}
                                        </label>
                                    @endforeach

                                        @includeIf('layout.partials.extras.forms.ext_doc')


                                </div>
                            </div>
                        </div>






                        <div class="form-group row align-items-center">
                            <label class="col-lg-3 col-form-label">Project Status:</label>
                            <div class="col-lg-6">
                                <div class="radio-inline">
                                    <label class="radio radio-success">
                                        <input type="radio" name="project_status" value="commercial"/>
                                        <span></span>
                                        commercial
                                    </label>
                                    <label class="radio radio-success">
                                        <input type="radio" name="project_status" value="R&D" checked="checked" />
                                        <span></span>
                                        R&D
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">End Market</label>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <select name="end_market_id" required class="form-control form-control-solid">
                                        @include('layout.partials.extras.selectable._countries')
                                    </select>
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
