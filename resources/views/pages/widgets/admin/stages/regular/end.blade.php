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
    $text = 'closed';
    $status_class = 'secondary';
    $txt_class= 'secondary';
    ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body" >
                    <h3 class="text-center">This Inquiry Is Waiting Payment To Be Marked as Closed</h3>
                    <div class=" pt-3 pb-0 text-center text-muted">
                        <i class="fa fa-hourglass-half icon-4x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
