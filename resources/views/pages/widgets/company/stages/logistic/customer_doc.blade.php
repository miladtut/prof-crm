@include('components.style')

<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php $text = 'sending customer documents'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}" style="height: 150px">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3> {{config('app.name')}} is waiting the documents needed for import licence upload now: </h3>
                    <h3 class="row">
                        <?php $i = 0;?>
                        @foreach($data->files()->where('type','customerdoc')->get() as $doc)
                            <?php $i++; ?>
                            <a class="col-6" href="{{route('company.download',['path'=>$doc->name])}}"><i class="fa fa-paperclip text-primary"></i>{{setName($doc->name,'customer_document'.$i)}}</a>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
    </div>
@else
    <?php $text = 'sending customer documents'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3> {{config('app.name')}} is waiting the documents needed for import licence upload now: </h3>
                    <div class=" pt-3 pb-0 text-center" style="height: 100px">
                        <a class="btn btn-success mt-4" href="{{route('company.inquiry.customer-document.create',$data->id)}}">upload</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

