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
                    <h3>Company Received draft shipping files:</h3>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="doc[]" class="custom-file-input" id="validatedCustomFile" multiple required>
                                <label class="custom-file-label" for="validatedCustomFile">please upload draft shipping document</label>
                                <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                            </div>

                        </div>
                        <div class="form-group">
                            <h3 class="text-right">
                                @foreach($data->files()->where('type','draft')->get() as $file)
                                <a href="{{route('admin.download',['path'=>$file->name])}}">
                                    <i class="fa fa-paperclip text-primary"></i>
                                    {{setName($file->name,'profect_draft')}}
                                </a>
                                @endforeach

                            </h3>
                        </div>
                        <div class="form">
                            <input formaction="{{route('admin.draft.send',[$data->id,'update'])}}" type="submit" class="btn btn-primary" value="Edit">
                            @if($data->draft_status == 'approved')
                                <span class="btn btn-light-success"><i class="fa fa-check"></i>approved</span>
                            @elseif($data->draft_status == 'rejected')
                                <input formaction="{{route('admin.draft.send',[$data->id,'modify'])}}" type="submit" class="btn btn-danger" value="Modify">
                            @endif
                        </div>
                    </form>
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
                    <h3>Please Upload The  draft shipping files Document, To be sent To Customer:</h3>
                    <form action="{{route('admin.draft.send',$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="doc[]" class="custom-file-input" id="validatedCustomFile" multiple required>
                                <label class="custom-file-label" for="validatedCustomFile">please upload draft shipping document</label>
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
