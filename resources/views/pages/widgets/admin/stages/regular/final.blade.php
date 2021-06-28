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
                    <h3>Company Received The  Final shipping files :</h3>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="doc[]" class="custom-file-input" id="validatedCustomFile" multiple required>
                                <label class="custom-file-label" for="validatedCustomFile">please upload draft shippin document</label>
                                <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                            </div>

                        </div>
                        <div class="form-group">
                            <h3 class="text-right">
                                @foreach($data->files()->where('type','final')->get() as $file)
                                <a href="{{route('admin.download',['path'=>$file->name])}}">
                                    <i class="fa fa-paperclip text-primary"></i>
                                    {{setName($file->name,'profect_final')}}
                                </a>
                                @endforeach

                            </h3>
                        </div>
                        <div class="form">
                            <input formaction="{{route('admin.final.send',[$data->id,'update'])}}" type="submit" class="btn btn-primary" value="Edit">
                            @if($data->final_status == 'approved')
                                <span class="btn btn-light-success"><i class="fa fa-check"></i>Approved</span>
                            @elseif($data->final_status == 'rejected')
                                <input formaction="{{route('admin.final.send',[$data->id,'modify'])}}" type="submit" class="btn btn-danger" value="Modify">
                            @endif
                        </div>
                    </form>
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
                    <h3>Please Upload The  final shipping files Document, To Send Them To Customer:</h3>
                    <form action="{{route('admin.final.send',$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="doc[]" class="custom-file-input" id="validatedCustomFile" multiple required>
                                <label class="custom-file-label" for="validatedCustomFile">please upload final shippin document</label>
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
