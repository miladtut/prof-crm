@include('components.style')

<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php $text = 'sending po'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Received Your PI And Uploaded Purchasing Order (PO):</h3>
                    <h3>
                        @foreach($data->files()->where('type','po')->get() as $file)
                            <a href="{{route('admin.download',['path'=>$file->name])}}">
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
    <?php $text = 'sending po'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>Company Received Your PI And Uploading Purchasing Order (PO):</h3>
                </div>
            </div>
        </div>
    </div>
@endif

