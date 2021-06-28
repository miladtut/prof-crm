@include('components.style')


<?php $class = 'gutter-b';?>

@if($status == 'sent')
    <?php
    $text = 'swift file';
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
                    <h3 >swift file :</h3>
                    <h3>
                        @foreach($data->files()->where('type','swift')->get() as $file)
                            <a href="{{route('admin.download',['path'=>$file->name])}}">
                                <i class="fa fa-paperclip text-primary"></i>{{setName($file->name,'Swift')}}
                            </a>
                        @endforeach
                    </h3>
                    <a href="{{route('admin.swift.edit',$data->id)}}" class="btn btn-light-primary"><i class="fa fa-edit"></i>Edit</a>
                </div>
            </div>
        </div>
    </div>
@endif
