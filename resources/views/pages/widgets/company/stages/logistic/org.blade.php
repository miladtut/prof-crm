@include('components.style')

<?php
$class = 'gutter-b';
?>




<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php $text = 'waiting original document'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-20 pb-20 text-center">
                    <h3>
                        the original documents are ready check it now:
                        @foreach($data->files()->where('type','org')->get() as $file)
                        <a href="{{route('company.download',['path'=>$file->name])}}">
                            <i class="fa fa-paperclip text-primary"></i>
                            {{setName($file->name,'original_document')}}
                        </a>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
    </div>
@else
    <?php

    $text = 'waiting original document';
    ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>
                        we are preparing the original documents
                    </h3>
                    <h4 class="text-muted">{{config('app.name')}} will send you this document very soon...</h4>
                </div>
            </div>
        </div>
    </div>
@endif
