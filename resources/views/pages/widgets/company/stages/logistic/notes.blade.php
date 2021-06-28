@include('components.style')

<?php
$class = 'gutter-b';
?>




<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php $text = 'delivery notes uploaded'; ?>
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
                        the delivery notes are ready check it now:
                        @foreach($data->files()->where('type','notes')->get() as $file)
                        <a href="{{route('company.download',['path'=>$file->name])}}">
                            <i class="fa fa-paperclip text-primary"></i>
                            {{setName($file->name,'delivery_notes')}}
                        </a>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
    </div>
@else
    
@endif
