@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Send price for Inquiry # {{$pilot->inquiry->id}}
        </div>
        <div class="card-body">

            <form class="form" action="{{route('admin.inquiry.pilot.edit',[$pilot->id,@$mode])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Quantity:</label>
                            <div class="col-lg-3">
                                <input name="qty" type="number" value="{{$pilot->qty}}" class="form-control" placeholder="Enter required material quantity"/>
                                <span class="form-text text-muted">Please Enter Number Only</span>
                            </div>
                            <label class="col-lg-1 col-form-label text-right">Unit:</label>
                            <div class="col-lg-2">
                                <select name="qty_unit" class="form-control form-control-solid">
                                    @include('layout.partials.extras.selectable._units',['unit'=>$pilot->qty_unit])
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Price:</label>
                            <div class="col-lg-3">
                                <input name="price" value="{{$pilot->price}}" type="number" class="form-control" placeholder="Enter required price"/>
                                <span class="form-text text-muted">Please Enter Number Only</span>
                            </div>
                            <label class="col-lg-1 col-form-label text-right">Currency:</label>
                            <div class="col-lg-2">
                                <select name="currency_id" class="form-control form-control-solid">
                                    @include('layout.partials.extras.selectable._currencies',['cur'=>$pilot->currency_id])
                                </select>
                            </div>
                            <label class="col-lg-1 col-form-label text-right">price unit:</label>
                            <div class="col-lg-2">
                                <select name="price_unit" class="form-control select2" required>
                                    @includeIf('layout.partials.extras.selectable._units',['unit'=>$pilot->price_unit])
                                </select>
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
