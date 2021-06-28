@include('components.style')

<?php
$class = 'gutter-b';
?>




<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php $text = 'supplier document sent'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>please upload the supplier documents, to processed:</h3>
                    <h6>PI, GMP+DML+Relationship letter if available</h6>
                    <form action="{{route('admin.supplier.document.send',[$data->id,'update'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="doc[]" class="custom-file-input" multiple id="validatedCustomFile" required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="text-muted">(5mb pdf, word, png, JPG, JPEG)</div>
                            </div>
                            <div class="form-group">
                                <h3 class="text-right">
                                    @foreach($data->supplier_document()->get() as $doc)
                                    <a href="{{route('admin.download',['path'=>$doc->document])}}">
                                        <i class="fa fa-paperclip text-primary"></i>
                                        {{setName($doc->document,'supplier_doc')}}
                                    </a>
                                    @endforeach
                                </h3>
                            </div>
                        </div>
                        <div class="form">
                            <input type="submit" class="btn btn-primary" value="Edit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <?php $text = 'waiting supplier document'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Please Upload The  Supplier Documents, To Processed:</h3>
                    <h6>PI, GMP+DML+Relationship letter if available</h6>
                    <div class="mt-3">
                        <form action="{{route('admin.supplier.document.send',$data->id)}}" method="post" enctype="multipart/form-data">
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
