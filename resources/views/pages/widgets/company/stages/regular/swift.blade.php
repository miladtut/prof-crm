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
                    <h3>
                        your Uploaded Swift file is:
                        @foreach($data->files()->where('type','swift')->get() as $file)
                        <a href="{{route('company.download',['path'=>$file->name])}}">
                            <i class="fa fa-paperclip text-primary"></i>
                            {{setName($file->name,'swift file')}}
                        </a>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
    </div>
@else
    @if($data->paid == 0 & in_array($data->quotation->payment->payment_name,['L/C at sight','T/T Advance','Cash In Advance']))
    <div class="row my-t">
        <div class="col-3 v-bar">
{{--            @include('components.t-line-header')--}}
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Please Upload The  (swift file) , Or Contact {{config('app.name')}} For Payment ,To Close This Inquiry:</h3>
                    <form action="{{route('company.swift.send',$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="doc[]" class="custom-file-input" id="validatedCustomFile" multiple required>
                                <label class="custom-file-label" for="validatedCustomFile">please upload swift file</label>
                                <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                            </div>

                        </div>
                        <div class="form">
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif
