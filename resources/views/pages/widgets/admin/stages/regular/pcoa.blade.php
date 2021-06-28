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
                    <h3>Company Received  PCOA Document:</h3>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="doc[]" class="custom-file-input" id="validatedCustomFile" multiple required>
                                <label class="custom-file-label" for="validatedCustomFile">please upload pcoa document</label>
                                <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                            </div>

                        </div>
                        <div class="form-group">
                            <h3 class="text-right">
                                @foreach($data->files()->where('type','pcoa')->get() as $file)
                                <a href="{{route('admin.download',['path'=>$file->name])}}">
                                    <i class="fa fa-paperclip text-primary"></i>
                                    {{setName($file->name,'profect_pcoa')}}
                                </a>
                                @endforeach

                            </h3>
                        </div>
                        <div class="form">
                            <input formaction="{{route('admin.pcoa.send',[$data->id,'update'])}}" type="submit" class="btn btn-primary" value="Edit">
                            @if($data->pcoa_status == 'approved')
                                <span class="btn btn-light-success"><i class="fa fa-check"></i>approved</span>
                            @elseif($data->pcoa_status == 'rejected')
                                <input formaction="{{route('admin.pcoa.send',[$data->id,'modify'])}}" type="submit" class="btn btn-danger" value="Modify">
                            @endif
                        </div>
                    </form>
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
                    <h3>Please Upload The  PCOA Document, To Send Them To Customer:</h3>
                    <form action="{{route('admin.pcoa.send',$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="doc[]" class="custom-file-input" id="validatedCustomFile" multiple required>
                                <label class="custom-file-label" for="validatedCustomFile">please upload pcoa document</label>
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
