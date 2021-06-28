
@include('components.style')
<?php
    $class = 'gutter-b';
?>


@if($status == 'waiting')
    <?php $text = 'waiting quotation'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body" >
                    <h3>The Inquiry Has Been Successfully Received</h3>
                    <div class=" pt-3 pb-0 text-center" style="height: 300px">
                        <a class="btn btn-success mt-30" href="{{route('admin.inquiry.quotation.create',$data->id)}}">Create Quotation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif




@if($status == 'sent')
    <?php $text = 'Quotation Has Been Submitted'; ?>
    <?php $status_class = 'success'; ?>
    <?php $txt_class= 'success'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                {{-- Header --}}
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Quotation For Inquiry # {{mb_substr($data->company_name, 0, 3, "UTF-8").'-'.($data->id**2)}}</span>
                        <span class="card-label mt-3 font-weight-bold font-size-sm">Price : <span class="text-muted">{{$data->quotation->price}}{{$data->quotation->currency->currency_name}}/{{$data->quotation->unit}}</span></span>
                    </h3>

                </div>

                {{-- Body --}}
                <div class="card-body pt-3 pb-0">
                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                            <thead>
                            <tr>

                                <th class="p-0" style="min-width: 200px"></th>
                                <th class="p-0" style="min-width: 100px"></th>
                                <th class="p-0" style="min-width: 100px"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Specification</span>
                                    <div>
                                        <span class="text-muted font-weight-bold text-hover-primary">{{$data->quotation->spec->name}}</span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                validity
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->validity}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Lead Time
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->lead_time}}
                            </span>
                                </td>

                            </tr>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">payment term</span>
                                    <div>
                                        <span class="text-muted font-weight-bold text-hover-primary">{{$data->quotation->payment->payment_name}}</span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Shipping Term
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->shipping->shipping_name}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Origin
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->origin->name}}
                            </span>
                                </td>

                            </tr>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Documents</span>
                                    <div>
                            <span class="text-muted font-weight-bold text-hover-primary">
                                @foreach($data->quotation->documents as $doc)
                                    {{$doc->name . ','}}
                                @endforeach
                            </span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Created At
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->created_at}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Updated At
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->updated_at}}
                            </span>
                                </td>

                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">

                            <a class="btn btn-light-primary" href="{{route('admin.inquiry.quotation.create',[$data->id,'update'])}}"><i class="fa fa-edit"></i>Edit</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



@if($status == 'approved')
    <?php
    $text = 'Quotation Has Been Submitted';
    $status_class = 'success';
    $txt_class= 'success';
    ?>
    <div class="row my-t">
        <div class="col-3 v-bar" >
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                {{-- Header --}}
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Quotation For Inquiry # {{mb_substr($data->company_name, 0, 3, "UTF-8").'-'.($data->id**2)}}</span>
                        <span class="card-label mt-3 font-weight-bold font-size-sm">Price : <span class="text-muted">{{$data->quotation->price}}{{$data->quotation->currency->currency_name}}/{{$data->quotation->unit}}</span></span>
                    </h3>

                </div>

                {{-- Body --}}
                <div class="card-body pt-3 pb-0">
                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                            <thead>
                            <tr>

                                <th class="p-0" style="min-width: 200px"></th>
                                <th class="p-0" style="min-width: 100px"></th>
                                <th class="p-0" style="min-width: 100px"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Specification</span>
                                    <div>
                                        <span class="text-muted font-weight-bold text-hover-primary">{{$data->quotation->spec->name}}</span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                validity
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->validity}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Lead Time
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->lead_time}}
                            </span>
                                </td>

                            </tr>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">payment term</span>
                                    <div>
                                        <span class="text-muted font-weight-bold text-hover-primary">{{$data->quotation->payment->payment_name}}</span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Shipping Term
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->shipping->shipping_name}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Origin
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->origin->name}}
                            </span>
                                </td>

                            </tr>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Documents</span>
                                    <div>
                            <span class="text-muted font-weight-bold text-hover-primary">
                                @foreach($data->quotation->documents as $doc)
                                    {{$doc->name . ','}}
                                @endforeach
                            </span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Created At
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->created_at}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Updated At
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->updated_at}}
                            </span>
                                </td>

                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">

                            <a class="btn btn-light-primary" href="{{route('admin.inquiry.quotation.create',[$data->id,'update'])}}"><i class="fa fa-edit"></i>Edit</a>
                            <span class="btn btn-light-success"><i class="fa fa-check"></i>Approved</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if($status == 'rejected')
    <?php $text = 'quotation request modification'; ?>
    <?php $status_class = 'danger'; ?>
    <?php $txt_class= 'danger'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar" >
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                {{-- Header --}}
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Quotation For Inquiry # {{mb_substr($data->company_name, 0, 3, "UTF-8").'-'.($data->id**2)}}</span>
                        <span class="card-label mt-3 font-weight-bold font-size-sm">Price : <span class="text-muted">{{$data->quotation->price}}{{$data->quotation->currency->currency_name}}/{{$data->quotation->unit}}</span></span>
                    </h3>

                </div>

                {{-- Body --}}
                <div class="card-body pt-3 pb-0">
                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                            <thead>
                            <tr>

                                <th class="p-0" style="min-width: 200px"></th>
                                <th class="p-0" style="min-width: 100px"></th>
                                <th class="p-0" style="min-width: 100px"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Specification</span>
                                    <div>
                                        <span class="text-muted font-weight-bold text-hover-primary">{{$data->quotation->spec->name}}</span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                validity
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->validity}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Lead Time
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->lead_time}}
                            </span>
                                </td>

                            </tr>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">payment term</span>
                                    <div>
                                        <span class="text-muted font-weight-bold text-hover-primary">{{$data->quotation->payment->payment_name}}</span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Shipping Term
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->shipping->shipping_name}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Origin
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->origin->name}}
                            </span>
                                </td>

                            </tr>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Documents</span>
                                    <div>
                            <span class="text-muted font-weight-bold text-hover-primary">
                                @foreach($data->quotation->documents as $doc)
                                    {{$doc->name . ','}}
                                @endforeach
                            </span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Created At
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->created_at}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Updated At
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->quotation->updated_at}}
                            </span>
                                </td>

                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <a class="btn btn-primary" href="{{route('admin.inquiry.quotation.create',[$data->id,'update'])}}">Edit</a>
                            <a class="btn btn-light-danger" href="{{route('admin.inquiry.quotation.create',[$data->id,'modify'])}}"><i class="fa fa-times"></i>Modify</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
