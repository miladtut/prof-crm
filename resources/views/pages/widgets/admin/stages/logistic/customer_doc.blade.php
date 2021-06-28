@include('components.style')

<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php $text = 'customer document sent '; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <div class="row">
                        <div class="col-9">
                            <h3> Customer Documents Are Ready : </h3>
                        </div>
                        <div class="col-3">
                            <a href="{{route('admin.inquiry.customer-document.edit',$data->id)}}" class="btn btn-light-primary"><i class="fa fa-edit">Edit</i></a>
                        </div>
                    </div>

                    <h3 class="pt-5 row">
                        <?php $i = 0;?>
                        @foreach($data->files()->where('type','customerdoc')->get() as $doc)
                            <?php $i++; ?>
                            <a href="{{route('admin.download',['path'=>$doc->name])}}" class="col-6">
                                <i class="fa fa-paperclip text-primary"></i>
                                {{setName($doc->name,'customer_document'.$i)}}
                            </a>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
    </div>
@else
    <?php $text = 'sending customer document'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3>
                        Now Wait For The Customer Documents :
                    </h3>
                    <h6 class="text-muted">
                        please followup with the customer to ensure uploading documents, or
                        <a href="{{route('admin.inquiry.customer-document.create',$data->id)}}">upload here</a>
                    </h6>
                </div>
            </div>
        </div>
    </div>
@endif

