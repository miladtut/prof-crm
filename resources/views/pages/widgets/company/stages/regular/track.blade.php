@include('components.style')



<?php $class = 'gutter-b';?>

@if($status == 'sent')
    <?php
    $text = 'track no';
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
                    <h3 >
                        Tracking Number Of Original Document is :
                    </h3>
                    <h3>
                        <span class="text-primary">{{$data->tracking_number_of_original_documents}}</span>
                    </h3>
                </div>
            </div>
        </div>
    </div>
@endif
