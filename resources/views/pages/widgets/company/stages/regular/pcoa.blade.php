@include('components.style')
<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php
    if ($data->pcoa_status == 'rejected'){
        $text = 'pcoa rejected';
        $status_class = 'danger';
        $txt_class= 'danger';
    }else{
        $text = 'pcoa sent';
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

                    <h3>the pcoa documents is ready check it now:</h3>
                    <h3>
                        @foreach($data->files()->where('type','pcoa')->get() as $file)
                            <a href="{{route('company.download',['path'=>$file->name])}}">
                                <i class="fa fa-paperclip text-primary"></i>
                                {{setName($file->name,'profect_pcoa')}}
                            </a>
                        @endforeach
                    </h3>

                    @if($data->pcoa_status == 'approved')
                        <div>
                            <span class="btn btn-light-success"><i class="fa fa-check"></i>Approved</span>
                        </div>
                    @elseif($data->pcoa_status == 'rejected')
                        <div>
                            <span class="btn btn-light-danger"><i class="fa fa-times"></i>Modify Requested</span>
                        </div>
                    @else
                        <div>
                            <a class="btn btn-light-success" href="{{route('company.pcoa.approve',$data->id)}}">approve</a>
                            <a class="btn btn-light-danger reject" href="javascript:;" data-href="{{route('company.pcoa.reject',$data->id)}}">Modify</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@else
    <?php $text = 'waiting pcoa'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>we've received your PO document and working on PCOA & Shipping documents</h3>
                    <h4 class="text-muted">{{config('app.name')}} will send you this document very soon...</h4>
                </div>
            </div>
        </div>
    </div>
@endif
