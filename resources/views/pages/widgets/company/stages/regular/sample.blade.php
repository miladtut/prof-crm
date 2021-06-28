@include('components.style')
<?php $class = 'gutter-b';?>
@if($data->sample->qty)
@if($status == 'waiting')
    <?php
    $text = 'waiting sample';
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
                    <h3>Your Request {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} has been sent to profect</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'shipped')
    <?php
    $text = 'waiting sample';
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
                    <h3>The Request {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} Arrived To Your Office</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <h4 class="text-muted">Please confirm That you received it</h4>
                    <div class="pt-3 text-center">
                        <a class="btn btn-light-primary" href="{{route('company-sample-receive',$data->sample->id)}}"><i class="fa fa-check"></i>Received</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'received')
    <?php
    $text = 'sample received';
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
                    <h3>The Request {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} Arrived To Your Office</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <h4 class="text-muted">Please Approve The Sent Sample, So We Can Process with The Pilot</h4>
                    <div class="pt-3 text-center">
                        <a class="btn btn-light-success" href="{{route('company-sample-approve',$data->sample->id)}}"><i class="fa fa-check"></i>Approve</a>
                        <a class="btn btn-light-danger reject-sample" href="javascript:;" data-href="{{route('company-sample-reject',$data->sample->id)}}"><i class="fa fa-times"></i>reject</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'approved')
    <?php
    $text = 'sample received';
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
                    <h3>The Request {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} Arrived To Your Office</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <h4 class="text-muted">Please Approve The Sent Sample, So We Can Process with The Pilot</h4>
                    <div class="pt-3 text-center">
                        <a class="btn btn-light-success" href=""><i class="fa fa-check"></i>Approved</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($status == 'rejected')
    <?php
    $text = 'sample rejected';
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
                    <h3>The Request {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} Arrived To Your Office</h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                    <h4 class="text-muted">Please Approve The Sent Sample, So We Can Process with The Pilot</h4>
                    <div class="pt-3 text-center">
                        <a class="btn btn-light-danger" href=""><i class="fa fa-times"></i>Rejected</a>
                    </div>
                    <div class="text-center pt-3">
                        @if($data->files()->where('type','rejection_report')->count()>0)
                            @foreach($data->files()->where('type','rejection_report')->get() as $doc)
                                rejection report : <a href="{{route('company.download',['path'=>$doc->name])}}">
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
@else
    <?php
    $text = 'waiting sample';
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
                    <h3>Your Request {{$data->sample->qty.$data->sample->qty_unit}} Sample Of {{$data->material_name}} is : <span class="text-primary">{{$status}}</span></h3>
                    <p>{{$data->sample->shipping_instructions}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@else
@endif

