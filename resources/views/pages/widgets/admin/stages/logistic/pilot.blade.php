@include('components.style')

<?php
$class = 'gutter-b';
?>

<?php $class = 'gutter-b';?>

@if($status == 'waiting')
    <?php $text = 'waiting order quantity price'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->pilot->qty}} {{$data->pilot->qty_unit}} Of {{$data->material_name}}</h3>
                    <div class="mt-3 text-center">
                        <a class="btn btn-success" href="{{route('admin.inquiry.pilot.edit',$data->pilot->id)}}">Send order Price</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if($status == 'sent')
    <?php $text = 'order quantity price sent'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->pilot->qty}} {{$data->pilot->qty_unit}} Of {{$data->material_name}}</h3>
                    <h3>With Price : {{$data->pilot->price}}{{$data->pilot->currency->currency_name}}/{{$data->pilot->price_unit}}</h3>
                    <div class="pt-3 text-center">
                        <a class="btn btn-light-primary" href="{{route('admin.inquiry.pilot.edit',[$data->pilot->id,'update'])}}"><i class="fa fa-edit"></i>Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if($status == 'approved')
    <?php $text = 'order quantity price sent'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->pilot->qty}} {{$data->pilot->qty_unit}} Of {{$data->material_name}}</h3>
                    <h3>With Price : {{$data->pilot->price}}{{$data->pilot->currency->currency_name}}/{{$data->pilot->price_unit}}</h3>
                    <div class="pt-3 text-center">
                        <a class="btn btn-light-primary" href="{{route('admin.inquiry.pilot.edit',[$data->pilot->id,'update'])}}"><i class="fa fa-edit"></i>Edit</a>
                        <span class="btn btn-light-success"><i class="fa fa-check"></i>Approved</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if($status == 'rejected')
    <?php $text = 'order quantity price modify request'; ?>
    <?php $status_class = 'danger'; ?>
    <?php $txt_class= 'danger'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Requested {{$data->pilot->qty}} {{$data->pilot->qty_unit}} Of {{$data->material_name}}</h3>
                    <h3>With Price : {{$data->pilot->price}}{{$data->pilot->currency->currency_name}}/{{$data->pilot->price_unit}}</h3>
                    <div class="pt-3 text-center">
                        <a class="btn btn-light-primary" href="{{route('admin.inquiry.pilot.edit',[$data->pilot->id,'update'])}}"><i class="fa fa-edit"></i>Edit</a>
                        <a class="btn btn-light-danger" href="{{route('admin.inquiry.pilot.edit',[$data->pilot->id,'modify'])}}"><i class="fa fa-times"></i>Modify</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
