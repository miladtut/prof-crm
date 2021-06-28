@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            @if(@$mode)
                {{$mode}} quotation
            @else
                Create quotation
            @endif
        </div>
        <div class="card-body">
            @if(@$mode == 'update')
                <form class="form" action="{{route('admin.inquiry.quotation.create',[$data->id,'update'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Basic Info:</h3>
                        <div class="mb-15 ml-17">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Price:</label>
                                <div class="col-lg-2">
                                    <select name="currency_id" required class="form-control select2">
                                        @include('layout.partials.extras.selectable._currencies',['cur'=>$data->quotation->currency_id])
                                    </select>
                                </div>

                                <div class="col-lg-3 offset-1">
                                    <input name="price" type="number" required value="{{$data->quotation->price}}" class="form-control" placeholder="Enter Quotation Price"/>
                                    <span class="form-text text-muted">Please Enter number only</span>

                                </div>
                                <div class="col-lg-2">
                                    <select name="unit" class="form-control select2" required>
                                        @includeIf('layout.partials.extras.selectable._units',['unit'=>$data->quotation->unit])
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-lg-3 col-form-label">Documents:</label>
                                <div class="col-lg-6">
                                    <div class="checkbox-inline">
                                        <?php $arr = $data->quotation->documents()->pluck('id')->toArray();?>
                                        @foreach(\App\Models\Document::all() as $document)
                                            <label class="checkbox">
                                                <input name="document[]" type="checkbox" {{in_array($document->id,$arr)?'checked':''}} value="{{$document->id}}"/>
                                                <span></span>
                                                {{$document->name}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Specifications:</label>
                                <div class="col-lg-3">
                                    <select name="spec_id" required class="form-control select2" >
                                        @include('layout.partials.extras.selectable._specs',['spec_id'=>$data->quotation->spec_id])
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Lead Time:</label>
                                <div class="col-lg-3">
                                    <input type="text" required class="form-control" name="lead_time" value="{{$data->quotation->lead_time}}" placeholder="enter lead time for this quotation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Validity:</label>
                                <div class="col-lg-3">
                                    <input type="date" required class="form-control" name="validity" value="{{$data->quotation->validity}}" placeholder="enter this quotation validity">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">origin:</label>
                                <div class="col-lg-3">
                                    <select name="origin_id" required class="form-control select2">
                                        @include('layout.partials.extras.selectable._countries',['coun_id'=>$data->quotation->origin_id])
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Shipping Terms:</label>
                                <div class="col-lg-3">
                                    <select name="shipping_term_id" required class="form-control select2">
                                        @include('layout.partials.extras.selectable._shiping_terms',['ship_term'=>$data->quotation->shipping_term_id])
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Payment Method:</label>
                                <div class="col-lg-3">
                                    <select name="payment_term_id" required class="form-control select2">
                                        @include('layout.partials.extras.selectable._payment_method',['pay_term'=>$data->quotation->payment_term_id])
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
            @elseif(@$mode == 'modify')
                <form class="form" action="{{route('admin.inquiry.quotation.create',[$data->id,'modify'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Basic Info:</h3>
                        <div class="mb-15 ml-17">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Price:</label>
                                <div class="col-lg-2">
                                    <select name="currency_id" required class="form-control select2">
                                        @include('layout.partials.extras.selectable._currencies',['cur'=>$data->quotation->currency_id])
                                    </select>
                                </div>

                                <div class="col-lg-3 offset-1">
                                    <input name="price" type="number" required value="{{$data->quotation->price}}" class="form-control" placeholder="Enter Quotation Price"/>
                                    <span class="form-text text-muted">Please Enter number only</span>

                                </div>
                                <div class="col-lg-2">
                                    <select name="unit"  class="form-control select2" required>
                                        @includeIf('layout.partials.extras.selectable._units',['unit'=>$data->quotation->unit])
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-lg-3 col-form-label">Documents:</label>
                                <div class="col-lg-6">
                                    <div class="checkbox-inline">
                                        <?php $arr = $data->quotation->documents()->pluck('id')->toArray();?>
                                        @foreach(\App\Models\Document::all() as $document)
                                            <label class="checkbox">
                                                <input name="document[]" type="checkbox" {{in_array($document->id,$arr)?'checked':''}} value="{{$document->id}}"/>
                                                <span></span>
                                                {{$document->name}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Specifications:</label>
                                <div class="col-lg-3">
                                    <select name="spec_id" required class="form-control select2" >
                                        @include('layout.partials.extras.selectable._specs',['spec_id'=>$data->quotation->spec_id])
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Lead Time:</label>
                                <div class="col-lg-3">
                                    <input type="text" required class="form-control" min="1" name="lead_time" value="{{$data->quotation->lead_time}}" placeholder="enter lead time for this quotation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Validity:</label>
                                <div class="col-lg-3">
                                    <input type="date" required class="form-control" name="validity" value="{{$data->quotation->validity}}" placeholder="enter this quotation validity">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">origin:</label>
                                <div class="col-lg-3">
                                    <select name="origin_id" required class="form-control select2">
                                        @include('layout.partials.extras.selectable._countries',['coun_id'=>$data->quotation->origin_id])
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Shipping Terms:</label>
                                <div class="col-lg-3">
                                    <select name="shipping_term_id" required class="form-control select2">
                                        @include('layout.partials.extras.selectable._shiping_terms',['ship_term'=>$data->quotation->shipping_term_id])
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Payment Method:</label>
                                <div class="col-lg-3">
                                    <select name="payment_term_id" required class="form-control select2">
                                        @include('layout.partials.extras.selectable._payment_method',['pay_term'=>$data->quotation->payment_term_id])
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
            @else
                <form class="form" action="{{route('admin.inquiry.quotation.create',$data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Basic Info:</h3>
                        <div class="mb-15 ml-17">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Price:</label>
                                <div class="col-lg-2">
                                    <select name="currency_id" required class="form-control select2">
                                        @include('layout.partials.extras.selectable._currencies')
                                    </select>
                                </div>

                                <div class="col-lg-3 offset-1">
                                    <input name="price" value="{{old('price')}}" type="number" required class="form-control" placeholder="Enter Quotation Price"/>
                                    <span class="form-text text-muted">Please Enter number only</span>

                                </div>
                                <div class="col-lg-2">
                                    <select name="unit" class="form-control select2" required>
                                        @includeIf('layout.partials.extras.selectable._units')
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-lg-3 col-form-label">Documents:</label>
                                <div class="col-lg-6">
                                    <div class="checkbox-inline">
                                        <?php $arr = $data->documents()->pluck('id')->toArray();?>
                                        @foreach(\App\Models\Document::all() as $document)
                                            <label class="checkbox">
                                                <input name="document[]" type="checkbox" {{in_array($document->id,$arr)?'checked':''}} value="{{$document->id}}"/>
                                                <span></span>
                                                {{$document->name}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Specifications:</label>
                                <div class="col-lg-3">
                                    <select name="spec_id" required class="form-control form-control-solid" >
                                        @include('layout.partials.extras.selectable._specs')
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Lead Time:</label>
                                <div class="col-lg-3">
                                    <input type="text" value="{{old('lead_time')}}" class="form-control" required min="1" name="lead_time" placeholder="enter lead time for this quotation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Validity:</label>
                                <div class="col-lg-3">
                                    <input type="date" class="form-control" required name="validity" value="{{old('validity')}}" placeholder="enter this quotation validity">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">origin:</label>
                                <div class="col-lg-3">
                                    <select name="origin_id" class="form-control form-control-solid" required>
                                        @include('layout.partials.extras.selectable._countries')
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Shipping Terms:</label>
                                <div class="col-lg-3">
                                    <select name="shipping_term_id" required class="form-control form-control-solid">
                                        @include('layout.partials.extras.selectable._shiping_terms')
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Payment Method:</label>
                                <div class="col-lg-3">
                                    <select name="payment_term_id" required class="form-control form-control-solid">
                                        @include('layout.partials.extras.selectable._payment_method')
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
            @endif

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
