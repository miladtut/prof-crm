@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Create quotation
        </div>
        <div class="card-body">
            @if(isset($mode) && $mode != null)
                <?php $po = $inquiry->s_po; ?>
                <form class="form" action="{{route('admin.inquiry.spo.create',[$inquiry->id,$mode])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6"></h3>
                    <div class="mb-15 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Payment Term:</label>
                            <div class="col-lg-3">
                                <select name="payment_term_id" class="form-control select2" required>
                                    @include('layout.partials.extras.selectable._payment_method',['pay_term'=>$po->payment_term_id])
                                </select>
                                <small class="text-muted">Pleas Choose Payment Term</small>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Delivery:</label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" name="delivery" value="{{$po->delivery}}" required placeholder="choose delivery date for this po">
                                <small class="text-muted">Pleas Choose Delivery Date</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Place Of Delivery:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" value="{{$po->place_of_delivery}}" name="place_of_delivery" required placeholder="inter the place of delivery">
                                <small class="text-muted">Pleas inter the place of delivery</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Mode Of Supply:</label>
                            <div class="col-lg-3">
                                <select name="shipping_term_id" class="form-control select2" required>
                                    @include('layout.partials.extras.selectable._shiping_terms',['ship_term'=>$po->shipping_term_id])
                                </select>
                                <small class="text-muted">Pleas Choose Mode Of Supply</small>
                            </div>

                        </div>
                    </div>

                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">Product:</h3>
                    <div class="mb-15 ml-17">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Material Name</label>
                            <div class=" col-lg-6 col-md-9 col-sm-12">
                                @include('layout.partials.extras.selectable._materials',['material_id'=>$po->material_id,'sup_id'=>$po->supplier_id])
                                <small>Please Choose Material</small>
                                <div class="suppliers">

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Material Quantity:</label>
                            <div class="col-lg-2">
                                <input type="number" value="{{$po->material_qty}}" min="1" class="form-control" name="material_qty" required placeholder="123">
                                <small class="text-muted">Pleas inter number only</small>
                            </div>
                            <label class="col-lg-1 col-form-label text-right">Unit:</label>
                            <div class="col-lg-3">
                                <select name="material_qty_unit" class="form-control select2" required>
                                    @include('layout.partials.extras.selectable._units',['unit'=>$po->material_qty_unit])
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Price per Unit (USD):</label>
                            <div class="col-lg-3">
                                <input type="number" value="{{$po->material_price_per_unit}}" min="0" class="form-control" name="material_price_per_unit" required placeholder="material price">
                                <small class="text-muted">Pleas inter number only</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">working standard Quantity:</label>
                            <div class="col-lg-2">
                                <input type="number" value="{{$po->working_standard_qty}}" min="0" class="form-control" name="working_standard_qty" required placeholder="123">
                                <small class="text-muted">Pleas inter number only</small>
                            </div>
                            <label class="col-lg-1 col-form-label text-right">Unit:</label>
                            <div class="col-lg-3">
                                <select name="working_standard_qty_unit" class="form-control select2" required>
                                    @include('layout.partials.extras.selectable._units',['unit'=>$po->working_standard_qty_unit])
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Price per Unit (USD):</label>
                            <div class="col-lg-3">
                                <input type="number" value="{{$po->working_standard_price_per_unit}}" min="0" class="form-control" name="working_standard_price_per_unit" required placeholder="working standard price">
                                <small class="text-muted">Pleas inter number only</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Points Text:</label>
                            <div class="col-lg-6">
                                <textarea name="txt_points" id="kt-ckeditor-3">{!! $po->txt_points !!}</textarea>
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
            @else
                <form class="form" action="{{route('admin.inquiry.spo.create',$inquiry->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h3 class="font-size-lg text-dark font-weight-bold mb-6"></h3>
                        <div class="mb-15 ml-17">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Payment Term:</label>
                                <div class="col-lg-3">
                                    <select name="payment_term_id" class="form-control select2" required>
                                        @include('layout.partials.extras.selectable._payment_method')
                                    </select>
                                    <small class="text-muted">Pleas Choose Payment Term</small>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Delivery:</label>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control" value="{{old('delivery')}}" name="delivery" required placeholder="choose delivery date for this po">
                                    <small class="text-muted">Pleas Choose Delivery Date</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Place Of Delivery:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" value="{{old('place_of_delivery')}}" name="place_of_delivery" required placeholder="inter the place of delivery">
                                    <small class="text-muted">Pleas inter the place of delivery</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Mode Of Supply:</label>
                                <div class="col-lg-3">
                                    <select name="shipping_term_id" class="form-control select2" required>
                                        @include('layout.partials.extras.selectable._shiping_terms')
                                    </select>
                                    <small class="text-muted">Pleas Choose Mode Of Supply</small>
                                </div>

                            </div>
                        </div>

                        <h3 class="font-size-lg text-dark font-weight-bold mb-6">Product:</h3>
                        <div class="mb-15 ml-17">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12">Material Name</label>
                                <div class=" col-lg-6 col-md-9 col-sm-12">
                                    @include('layout.partials.extras.selectable._materials',['material_id'=>null])
                                    <small>Please Choose Material</small>
                                    <div class="suppliers">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Material Quantity:</label>
                                <div class="col-lg-2">
                                    <input type="number" min="1" value="{{old('material_qty')}}" class="form-control" name="material_qty" required placeholder="123">
                                    <small class="text-muted">Pleas inter number only</small>
                                </div>
                                <label class="col-lg-1 col-form-label text-right">Unit:</label>
                                <div class="col-lg-3">
                                    <select name="material_qty_unit" class="form-control select2" required>
                                        @include('layout.partials.extras.selectable._units')
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Price per Unit (USD):</label>
                                <div class="col-lg-3">
                                    <input type="number" min="0" class="form-control" value="{{old('material_price_per_unit')}}" name="material_price_per_unit" required placeholder="material price">
                                    <small class="text-muted">Pleas inter number only</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">working standard Quantity:</label>
                                <div class="col-lg-2">
                                    <input type="number" min="0" class="form-control" value="{{old('working_standard_qty')}}" name="working_standard_qty" required placeholder="123">
                                    <small class="text-muted">Pleas inter number only</small>
                                </div>
                                <label class="col-lg-1 col-form-label text-right">Unit:</label>
                                <div class="col-lg-3">
                                    <select name="working_standard_qty_unit" class="form-control select2" required>
                                        @include('layout.partials.extras.selectable._units')
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Price per Unit (USD):</label>
                                <div class="col-lg-3">
                                    <input type="number" value="{{old('working_standard_price_per_unit')}}" min="0" class="form-control" name="working_standard_price_per_unit" required placeholder="working standard price">
                                    <small class="text-muted">Pleas inter number only</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Points Text:</label>
                                <div class="col-lg-6">
                                    <textarea name="txt_points" id="kt-ckeditor-3">{{old('txt_points')}}</textarea>
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
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script src="{{asset('js/pages/crud/forms/editors/ckeditor-classic.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        {{--$(document).on('change','.material',function() {--}}
        {{--    var material = $(this).val();--}}
        {{--    var url = "{{route('admin.material.get.suppliers','#')}}";--}}
        {{--    url = url.replace('#',material)--}}
        {{--    $('.suppliers').load(url);--}}
        {{--    $('.suppliers-container').show()--}}
        {{--});--}}


        jQuery(document).ready(function() {
            KTCkeditor.init();
        });

    </script>
@endsection
