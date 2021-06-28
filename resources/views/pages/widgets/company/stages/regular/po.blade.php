@include('components.style')
<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php
    $text = 'sending po';
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
                    <h3>Your Uploaded Purchasing Order (PO):</h3>
                    <h3 class="text-center">
                        @foreach($data->files()->where('type','po')->get() as $file)
                        <a href="{{route('company.download',['path'=>$file->name])}}">
                            <i class="fa fa-paperclip text-primary"></i>
                            {{setName($file->name,'profect_po')}}
                        </a>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
    </div>

@else
    <?php
    $text = 'sending po';
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
                    <h3>Please Upload Purchasing Order:</h3>
                    <div class="mt-3">
                        <form action="{{route('company.po.send',$data->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="doc[]" class="custom-file-input" id="validatedCustomFile" multiple required>
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
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
    </div>

@endif
