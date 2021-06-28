@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            request sample
        </div>
        <div class="card-body">

            <form class="form" action="{{route('company-quotation-approve',$quotation->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Material Info:</h3>

                    <div class="mb-3 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Quantity:</label>
                            <div class="col-lg-3">
                                <input name="qty" value="{{old('qty')}}" type="number" class="form-control" placeholder="Enter required material quantity" required/>
                                <span class="form-text text-muted">Please Enter Number Only</span>
                            </div>
                            <label class="col-lg-1 col-form-label text-right">Unit:</label>
                            <div class="col-lg-2">
                                <select name="qty_unit" class="form-control form-control-solid" required>
                                    @include('layout.partials.extras.selectable._units')
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="mb-15 ml-17">

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">COA file : <br> <small>(required)</small><br><small>upload the approved coa</small></label>
                            <div></div>
                            <div class="col-lg-6">
                                <div class="custom-file">
                                    <input type="file" value="{{old('coa_attachment')}}" name="coa_attachment" class="custom-file-input" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>

                <div class="mb-3 ml-17">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">
                            Shipping instructions:
                            <p class="text-muted">(optional)</p>
                        </label>
                        <div class="col-lg-6">
                            <input name="shipping_instructions" value="{{old('shipping_instructions')}}" type="text" class="form-control" placeholder="minimum Quantity accepted and shipping instructions"/>
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
