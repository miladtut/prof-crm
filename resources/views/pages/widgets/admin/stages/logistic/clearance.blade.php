@include('components.style')

<?php $class = 'gutter-b';?>
@if($status == 'sent')
    <?php $text = 'customer clearance documents sent'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-20 pb-20 text-center">
                    <h3>Customer clearance documents are ready:</h3>
                    <h3>
                        @foreach($data->files()->where('type','clearance')->get() as $file)
                        <a href="{{route('admin.download',['path'=>$file->name])}}">
                            <i class="fa fa-paperclip text-primary"></i>
                            {{setName($file->name,'clearance_doc')}}
                        </a>
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
    ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    @if($data->status_name == 'waiting payment')
        <div class="row my-t">
            <div class="col-3 v-bar">
                @include('components.t-line-header')
            </div>
            <div class="col-9">
                <div class="card card-custom {{ @$class }}">
                    <div class="card-body pt-20 pb-20 text-center">
                        <h3>now wait for payment:</h3>
                        <h4 class="text-muted">please followup with customer to ensure payment</h4>
                        <div class="row mt-3">
                            <div class="col-12">
                                <form action="{{route('admin.change-status',$data->id)}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-row">
                                            <select class="form-control" name="status_name">
                                                <option value="waiting payment" {{selectIf($data,'waiting payment')}}>waiting payment</option>
                                                <option value="sending customer clearance documents" {{selectIf($data,'sending customer clearance documents')}}>sending customer clearance documents</option>
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
                    <div class="card-body pt-20 pb-20 text-center">
                        <h3>now wait for customer clearance document:</h3>
                        <h4 class="text-muted">please followup with customer to ensure uploading documents</h4>
                        <div class="row mt-3">
                            <div class="col-12">
                                <form action="{{route('admin.change-status',$data->id)}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-row">
                                            <select class="form-control" name="status_name">
                                                <option value="waiting payment" {{selectIf($data,'waiting payment')}}>waiting payment</option>
                                                <option value="sending customer clearance documents" {{selectIf($data,'sending customer clearance documents')}}>sending customer clearance documents</option>
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
    @endif
@endif

