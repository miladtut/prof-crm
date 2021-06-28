@include('components.style')


<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php
    if ($data->pcoa_status == 'rejected'){
        $text = 'pcoa modification requested';
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
    <?php
        $text = $data->status_name
    ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>

    @if($text != 'waiting for preshipment COA')
        <div class="row my-t">
            <div class="col-3 v-bar">
                @include('components.t-line-header')
            </div>
            <div class="col-9">
                <div class="card card-custom {{ @$class }}">
                    <div class="card-body pt-10 pb-10 text-center">
                        <h3>we have received the customer documents ,wait for the import approval</h3>
                        <h4 class="text-muted">{{config('app.name')}} will send you the document very soon</h4>
                        <div class="row mt-3">
                            <div class="col-12">
                                <form action="{{route('admin.change-status',$data->id)}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-row">
{{--                                            <option value="continue complete document" {{selectIf($data,'continue complete document')}}>continue complete document</option>--}}
                                            <select class="form-control" name="status_name">
                                                <option value="import approval submitted" {{selectIf($data,'import approval submitted')}}>import approval submitted</option>
                                                <option value="import approval completing" {{selectIf($data,'import approval completing')}}>import approval completing</option>
                                                <option value="import approval done" {{selectIf($data,'import approval done')}}>import approval done </option>

                                                <option value="waiting for preshipment COA" {{selectIf($data,'waiting for preshipment COA')}}>waiting for preshipment COA</option>
                                            </select>
                                        </div>
                                        <div class="form-row mt-3 text-center">
                                            <input type="submit" class="form-control btn btn-primary" value="change">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
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
@endif
