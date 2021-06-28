@include('components.style')
<?php $class = 'gutter-b';?>

@if($status == 'sent')
    <?php
    $text = 'closed';
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
                    <h3 >This Inquiry Has Been Successfully Closed :</h3>
                    <div class="">
                        <i class="fa fa-check icon-4x bg-success p-3 text-white" style="border-radius: 50%"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <?php
    if ($data->status >= 18 ){
        $text = $data->status_name;
    }
    ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    @if($data->status >= 18)
        <div class="row my-t">
            <div class="col-3 v-bar">
                @include('components.t-line-header')
            </div>
            <div class="col-9">
                <div class="card card-custom {{ @$class }}">
                    <div class="card-body pt-10 pb-10 text-center">
                        <h3 >{{$data->status_name}}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
