@include('components.style')
<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php
    if ($data->final_status == 'rejected'){
        $text = 'final shipping file rejected';
        $status_class = 'danger';
        $txt_class= 'danger';
    }else{
        $text = 'final shipping file sent';
        $status_class = 'success';
        $txt_class= 'success';
    }
    ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>the final shipping documents is ready check it now:</h3>
                    <h3>
                        @foreach($data->files()->where('type','final')->get() as $file)
                            <a href="{{route('company.download',['path'=>$file->name])}}"><i class="fa fa-paperclip text-primary"></i>{{setName($file->name,'profect_final')}}</a>
                        @endforeach
                    </h3>
                    @if($data->final_status == 'approved')
                        <div>
                            <span class="btn btn-light-success"><i class="fa fa-check"></i>approved</span>
                        </div>
                    @elseif($data->final_status == 'rejected')
                        <div>
                            <span class="btn btn-light-danger"><i class="fa fa-times"></i>Modify Requested</span>
                        </div>
                    @else

                        <div>
                            <a class="btn btn-light-success" href="{{route('company.final.approve',$data->id)}}">approve</a>
                            <a class="btn btn-light-danger reject" href="javascript:;" data-href="{{route('company.final.reject',$data->id)}}">Modify</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    <?php
    $text = 'waiting final shipping file';
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
                    <h3>the final shipping documents will be sent soon:</h3>
                    <h4 class="text-muted">{{config('app.name')}} will send this document very soon...</h4>
                </div>
            </div>
        </div>
    </div>
@endif
