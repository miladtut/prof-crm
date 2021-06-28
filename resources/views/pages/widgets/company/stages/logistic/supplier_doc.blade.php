@include('components.style')

<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php $text = 'waiting supplier document'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}" style="height: 150px">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3> The Supplier Documents Are Ready, check it now: </h3>
                    <h3>
                        @foreach($data->supplier_document()->get() as $doc)
                        <a href="{{route('company.download',['path'=>$doc->document])}}">
                            <i class="fa fa-paperclip text-primary"></i>
                            {{setName($doc->document,'supplier_document')}}
                        </a>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
    </div>
@else
    <?php $text = 'sending PO to supplier'; ?>
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
                        PO is Received, Draft Shipping documents will be sent Shortly:
                    </h3>
                    <h6 class="text-muted">
                        {{config('app.name')}} will send you this document very soon...
                    </h6>
                </div>
            </div>
        </div>
    </div>
@endif

