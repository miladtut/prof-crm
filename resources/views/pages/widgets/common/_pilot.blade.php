<div class="card card-custom {{ @$class }}">
    <div class="card-body pt-10 pb-10 text-center">
        @if(auth()->check())
            @if($data->pilot_status == 'approved')
                <h3>The Price of {{$data->pilot_qty}} {{$data->pilot_qty_unit}} Of {{$data->material_name}} is : {{$data->pilot_price}}</h3>
                <div class="btn btn-light-success"><i class="fa fa-check"></i>Approved</div>
            @elseif($data->pilot_status == 'rejected')
                <h3>The Price of {{$data->pilot_qty}} {{$data->pilot_qty_unit}} Of {{$data->material_name}} is : {{$data->pilot_price}}</h3>
                <div class="btn btn-light-danger"><i class="fa fa-times"></i>rejected</div>
            @else
                @if($data->status_name == 'pilot_price_sent')
                    <h3>The Price of {{$data->pilot_qty}} {{$data->pilot_qty_unit}} Of {{$data->material_name}} is : {{$data->pilot_price}}</h3>
                    <form>
                        <button type="submit" formaction="" class="btn btn-light-success"><i class="fa fa-check"></i> Approve</button>
                        <button type="submit" formaction="" class="btn btn-light-danger"><i class="fa fa-times"></i> reject</button>
                    </form>
                @else
                    <h3>Your pilot Request Of {{$data->pilot_qty}} {{$data->pilot_qty_unit}} Of {{$data->material_name}} Has Been Sent To Profect </h3>
                    <h4 class="text-muted">profect will send you this pilot price very soon</h4>
                @endif
            @endif
        @elseif(auth('admin')->check())
            @if($data->pilot_status == 'approved')
            @elseif($data->pilot_status == 'rejected')
            @else
                <h3>Company Requested {{$data->pilot_qty}} {{$data->pilot_qty_unit}} Of {{$data->material_name}} </h3>
                <form action="">
                    <input type="hidden" name="inquiry_id" value="{{$data->id}}">
                    <input class="btn btn-success" type="submit" value="Send Pilot Price">
                </form>
            @endif
        @else
        @endif
    </div>
</div>
