@include('components.style')
<?php $class = 'gutter-b';?>
@if($status == 'waiting')
    <?php $text = 'sending po to supplier'; ?>
    <?php $status_class = 'secondary'; ?>
    <?php $txt_class= 'secondary'; ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body" >
                    <h3>Please, Create The PO That Will Be Sent To Supplier:</h3>
                    <div class=" pt-3 pb-0 text-center" style="height: 100px">
                        <a class="btn btn-success mt-4" href="{{route('admin.inquiry.spo.create',$data->id)}}">Create PO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if($status == 'sent')
    <?php $text = 'PO Sent To Supplier'; ?>
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
{{--                        <span class="card-label font-weight-bolder text-dark">Quotation For Inquiry # {{$data->id}}</span>--}}
{{--                        <span class="card-label mt-3 font-weight-bold font-size-sm">Price : <span class="text-muted">{{$data->quotation->price}} {{$data->quotation->currency->currency_name}}</span></span>--}}
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
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Payment Terms</span>
                                    <div>
                                        <span class="text-muted font-weight-bold text-hover-primary">{{$data->s_po->payment_term->payment_name}}</span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Delivery
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->s_po->delivery}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Created At
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->s_po->created_at}}
                            </span>
                                </td>

                            </tr>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Place Of Delivery</span>
                                    <div>
                                        <span class="text-muted font-weight-bold text-hover-primary">{{$data->s_po->place_of_delivery}}</span>
                                    </div>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Mode Of Supply
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->s_po->shipping_term->shipping_name}}
                            </span>
                                </td>
                                <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                Updated At
                            </span>
                                    <span class="text-muted font-weight-bold">
                                {{$data->s_po->updated_at}}
                            </span>
                                </td>

                            </tr>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                        Material Qty
                                    </span>
                                    <div>
                                        <span class="text-muted font-weight-bold">
                                            {{$data->s_po->material_qty}} {{$data->s_po->material_qty_unit}}
                                        </span>
                                    </div>

                                </td>
                                <td >
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                        Price Per Unit
                                    </span>
                                    <div>
                                        <span class="text-muted font-weight-bold">
                                            {{$data->s_po->material_price_per_unit}} USD
                                        </span>
                                    </div>
                                </td>
                                <td >
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                        Total Price
                                    </span>
                                    <div>
                                        <span class="text-muted font-weight-bold">
                                            {{$data->s_po->material_total_price}} USD
                                        </span>
                                    </div>
                                </td>

                            </tr>
                            <tr>

                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                        Working Standard Qty
                                    </span>
                                    <div>
                                        <span class="text-muted font-weight-bold">
                                            {{$data->s_po->working_standard_qty}} {{$data->s_po->working_standard_qty_unit}}
                                        </span>
                                    </div>

                                </td>
                                <td >
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                        Price Per Unit
                                    </span>
                                    <div>
                                        <span class="text-muted font-weight-bold">
                                            {{$data->s_po->working_standard_price_per_unit}} USD
                                        </span>
                                    </div>
                                </td>
                                <td >
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                        Total Price
                                    </span>
                                    <div>
                                        <span class="text-muted font-weight-bold">
                                            {{$data->s_po->working_standard_total_price}} USD
                                        </span>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                       PO Total Price
                                    </span>
                                    <div>
                                        <span class="text-muted font-weight-bold">
                                            {{$data->s_po->po_total_price}} USD
                                        </span>
                                    </div>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">

                        <a class="btn btn-primary" href="{{route('admin.inquiry.spo.create',[$data->id,'update'])}}"><i class="fa fa-edit"></i>Edit</a>
                        <a class="btn btn-success" href="{{route('print-po',$data->id)}}" target="_blank"><i class="fa fa-print"></i>Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
