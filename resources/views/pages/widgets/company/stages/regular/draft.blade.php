@include('components.style')
<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php
    if ($data->draft_status == 'rejected'){
        $text = 'draft shipping file rejected';
        $status_class = 'danger';
        $txt_class= 'danger';
    }else{
        $text = 'draft shipping file sent';
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
                    <h3>the draft documents is ready check it now:</h3>
                    <h3>
                        @foreach($data->files()->where('type','draft')->get() as $file)
                            <a href="{{route('company.download',['path'=>$file->name])}}"><i class="fa fa-paperclip text-primary"></i>{{setName($file->name,'profect_draft')}}</a>
                        @endforeach
                    </h3>
                    @if($data->draft_status == 'approved')
                        <div>
                            <span class="btn btn-light-success"><i class="fa fa-check"></i>Approved</span>
                        </div>
                    @elseif($data->draft_status == 'rejected')
                        <div>
                            <span class="btn btn-light-danger"><i class="fa fa-times"></i>Modify Requested</span>
                        </div>
                    @else

                        <div>
                            <a class="btn btn-light-success" href="{{route('company.draft.approve',$data->id)}}">approve</a>
                            <a class="btn btn-light-danger reject" href="javascript:;" data-href="{{route('company.draft.reject',$data->id)}}">Modify</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    <?php $text = 'waiting draft shipping file'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>we are preparing the draft shipping files for this inquiry:</h3>
                    <h4 class="text-muted">{{config('app.name')}} will send this document very soon...</h4>
                </div>
            </div>
        </div>
    </div>
@endif
