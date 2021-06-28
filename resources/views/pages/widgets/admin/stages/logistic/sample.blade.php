@include('components.style')

<?php
$class = 'gutter-b';
$text = 'sample';
?>






<?php $class = 'gutter-b';?>

@if($data->sample->qty)
@if($status == 'waiting')
    <?php $text = 'waiting sample'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} And Waiting Delivery</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <div class="text-center pt-3">
                        <a class="btn btn-light-primary" href="{{route('admin.inquiry.status.update',[$data->id,'requested'])}}">mark requested</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'requested')
    <?php $text = 'waiting sample'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} And Waiting Delivery</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <div class="text-center pt-3">
                        <a class="btn btn-light-primary" href="{{route('admin.inquiry.status.update',[$data->id,'processing'])}}">mark processing</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'processing')
    <?php $text = 'waiting sample'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} And Waiting Delivery</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <div class="text-center pt-3">
                        <a class="btn btn-light-info" href="{{route('admin.inquiry.status.update',[$data->id,'shipped'])}}">mark shipped</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'shipped')
    <?php $text = 'waiting sample'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} And Waiting Delivery</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <div class="text-center pt-3">
                        <span class="btn btn-light-warning">waiting receive</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'received')
    <?php $text = 'sample received'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}}</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <div class="text-center pt-3">
                        <span class="btn btn-light-success"><i class="fa fa-check"></i>received</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'approved')
    <?php $text = 'sample received'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}}</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <div class="text-center pt-3">
                        {{--                        <a class="btn btn-light-primary"><i class="fa fa-edit"></i>Edit</a>--}}
                        <a class="btn btn-light-success"><i class="fa fa-check"></i>Approved</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'rejected')
    <?php $text = 'sample rejected'; ?>
    <?php $status_class = 'danger'; ?>
    <?php $txt_class= 'danger'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}}</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <div class="text-center pt-3">
                        {{--                        <a class="btn btn-light-primary"><i class="fa fa-edit"></i>Edit</a>--}}
                        <a class="btn btn-light-danger" href="{{route('admin.inquiry.sample.modify',$data->id)}}"><i class="fa fa-times"></i>rejected</a>
                    </div>
                    <div class="text-center pt-3">
                        @if($data->files()->where('type','rejection_report')->count()>0)
                            @foreach($data->files()->where('type','rejection_report')->get() as $doc)
                                rejection report : <a href="{{route('admin.download',['path'=>$doc->name])}}">
                                    <i class="fa fa-paperclip text-danger"></i>
                                    {{setName($doc->name,'rejection report')}}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endif


