@include('components.style')
<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php
    $text = 'customer clearance document sent';
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
                    <h3>Your Uploaded customer clearance documents:</h3>
                    <h3 class="text-center">
                        <?php $i=0?>
                        @foreach($data->files()->where('type','clearance')->get() as $doc)
                                <?php $i++?>
                            <a href="{{route('company.download',['path'=>$doc->name])}}"><i class="fa fa-paperclip text-primary"></i>{{setName($doc->name,'clearance_doc'.$i)}}</a>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
    </div>

@else
    <?php
    if ($data->status_name == 'waiting payment'){
        $text = 'waiting payment';
    }else{
        $text = 'sending customer clearance document';
    }
    $status_class = 'secondary';
    $txt_class= 'secondary';
    ?>
    @if($data->status_name == 'waiting payment')
        <div class="row my-t">
            <div class="col-3 v-bar">
                @include('components.t-line-header')
            </div>
            <div class="col-9">
                <div class="card card-custom {{ @$class }}">
                    <div class="card-body pt-10 pb-10 text-center">
                        <h3>waiting payment</h3>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row my-t">
            <div class="col-3 v-bar">
                @include('components.t-line-header')
            </div>
            <div class="col-9">
                <div class="card card-custom {{ @$class }}">
                    <div class="card-body pt-10 pb-10 text-center">
                        <h3>Please Upload Your customer clearance Documents:</h3>
                        <div class="mt-3">
                            <form action="{{route('company.clearance.send',$data->id)}}" method="post" enctype="multipart/form-data">
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

@endif
