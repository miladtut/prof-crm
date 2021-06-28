@include('components.style')
<?php $class = 'gutter-b';?>

@if($status == 'sent')
    <?php
    $text = 'closed';
    $status_class = 'success';
    $txt_class= 'success';
    ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body pt-10 pb-10 text-center">
                    <h3 >This Inquiry Has Been Successfully Closed :</h3>
                    <div class="">
                        <i class="fa fa-check icon-4x bg-success p-3 text-white" style="border-radius: 50%"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($data->status >= 18)
    <?php
    $text = $data->status_name;
    $status_class = 'secondary';
    $txt_class= 'secondary';
    ?>
    <div class="row my-t">
        <div class="col-3 v-bar">
            @include('components.t-line-header')
        </div>
        <div class="col-9">
            <div class="card card-custom {{ @$class }}">
                <div class="card-body" >
                    <h3 class="text-center">change status</h3>
                    <div class="row mt-3">
                        <div class="col-12">
                            <form action="{{route('admin.change-status',$data->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="form-row">
                                        <select class="form-control" name="status_name">
                                            @if($data->files()->where('type','notes')->count() < 1)
                                                <option value="clearance from EDA" {{selectIf($data,'clearance from EDA')}}>clearance from EDA done</option>
                                                <option value="delivery notes uploaded" {{selectIf($data,'delivery notes uploaded')}}>delivery notes uploaded</option>
                                            @endif
                                            <option value="under custom clearance from the port" {{selectIf($data,'under custom clearance from the port')}}>under custom clearance from the port</option>
                                            <option value="clearance from the port done" {{selectIf($data,'clearance from the port done')}}>clearance from the port done</option>
                                            <option value="delivery to warehouse" {{selectIf($data,'delivery to warehouse')}}>delivery to warehouse</option>
                                            <option value="invoice release & collection done" {{selectIf($data,'invoice release & collection done')}}>invoice release & collection done</option>
                                            @if($data->paid == 1)
                                                <option value="inquiry closed successfully" {{selectIf($data,'inquiry closed successfully')}}>inquiry closed successfully</option>
                                            @endif
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
