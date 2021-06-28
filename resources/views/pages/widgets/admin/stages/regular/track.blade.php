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
                    <h3 >Tracking Number Of Original Document is :
                        <span class="text-primary">{{$data->tracking_number_of_original_documents}}</span>
                    </h3>
                </div>
            </div>
        </div>
    </div>


@else
    <?php
    $text = 'track no';
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
                    <h3>please enter tracking number of original document</h3>
                    <form action="{{route('admin.track.send',$data->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="tracking_no" class="form-control" placeholder="enter tracking number for original document" required>
                            <div class="text-muted">number only</div>
                        </div>

                        <div class="form">
                            <input type="submit" class="btn btn-success" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endif
