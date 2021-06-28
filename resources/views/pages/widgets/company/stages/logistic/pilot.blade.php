@include('components.style')
<?php $class = 'gutter-b';?>

@if($status == 'waiting')
    <?php
    $text = 'waiting order quantity price';
    $status_class = 'secondary';
    $txt_class= 'secondary';
    ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Your order quantity Request Of {{$data->pilot->qty}} {{$data->pilot->qty_unit}} Of {{$data->material_name}} Has Been Sent To Profect</h3>
                    <h4 class="text-muted">Profect Will Send This Pilot Price Very Soon...</h4>
                </div>
            </div>
        </div>
    </div>
@endif


@if($status == 'sent')
    <?php
    $text = 'order quantity price sent';
    $status_class = 'success';
    $txt_class= 'success';
    ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>The Price Of {{$data->pilot->qty}} {{$data->pilot->qty_unit}} Of {{$data->material_name}} is : {{$data->pilot->price}}{{$data->pilot->currency->currency_name}}/{{$data->pilot->price_unit}}</h3>
                    <div class="pt-3 text-center">
                        <a class="btn btn-light-success" href="{{route('company-pilot-approve',$data->pilot->id)}}"><i class="fa fa-check"></i>Approve</a>
                        <a class="btn btn-light-danger reject" data-href="{{route('company-pilot-reject',$data->pilot->id)}}" href="javascript:;"><i class="fa fa-times"></i>Modify</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if($status == 'approved')
    <?php
    $text = 'order quantity price sent';
    $status_class = 'success';
    $txt_class= 'success';
    ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>The Price Of {{$data->pilot->qty}} {{$data->pilot->qty_unit}} Of {{$data->material_name}} is : {{$data->pilot->price}}{{$data->pilot->currency->currency_name}}/{{$data->pilot->price_unit}}</h3>
                    <div class="pt-3 text-center">
                        <span class="btn btn-light-success"><i class="fa fa-check"></i>Approved</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if($status == 'rejected')
    <?php
    $text = 'order quantity price modify request';
    $status_class = 'danger';
    $txt_class= 'danger';
    ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>The Price Of {{$data->pilot->qty}} {{$data->pilot->qty_unit}} Of {{$data->material_name}} is : {{$data->pilot->price}}{{$data->pilot->currency->currency_name}}/{{$data->pilot->price_unit}}</h3>
                    <div class="pt-3 text-center">
                        <span class="btn btn-light-danger"><i class="fa fa-times"></i>Modify Requested</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
