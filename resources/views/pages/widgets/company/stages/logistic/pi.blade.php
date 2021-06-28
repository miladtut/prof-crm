@include('components.style')
<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php
    $text = 'waiting pi';
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
                    <h3>The PI Document Is Ready For This Inquiry:</h3>
                    <h3 class="text-center">
                        @foreach($data->files()->where('type','pi')->get() as $file)
                            <a href="{{route('company.download',['path'=>$file->name])}}">
                                <i class="fa fa-paperclip text-primary"></i>
                                {{setName($file->name,'profect_pi')}}
                            </a>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
    </div>

@else
    <?php
    $text = 'waiting pi';
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
                    <h3>The PI Will Be Sent Shortly</h3>
                    <h4 class="text-muted">Profect Will send Documents Very Soon...</h4>
                </div>
            </div>
        </div>
    </div>

@endif
