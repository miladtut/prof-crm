{{-- Advance Table Widget 2 --}}

<div class="card card-custom {{ @$class }}">
    {{-- Header --}}
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">Latest Inquiries</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">checkout latest 5 inquiries</span>
        </h3>
    </div>

    {{-- Body --}}
    <div class="card-body pt-3 pb-0">
        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-borderless table-vertical-center">
                <thead>
                    <tr>
                        <th class="p-0" style="width: 50px">id</th>
                        <th class="p-0" style="min-width: 200px">material</th>
                        <th class="p-0" style="min-width: 125px">qty</th>
                        <th class="p-0" style="min-width: 110px">price</th>
                        <th class="p-0" style="min-width: 150px">creation date</th>
                        <th class="p-0" style="min-width: 150px">status</th>
                        <th class="p-0" style="min-width: 150px">action</th>
                    </tr>
                </thead>
                <tbody>
                @php($inquiries = auth()->user()->inquiries()->latest()->limit(5)->get())
                    @foreach($inquiries as $inquiry)
                    <tr>
                        <td class="pl-0 py-4">
                            <div class="symbol symbol-50 symbol-light mr-1">
                                <span class="symbol-label">
                                    {{mb_substr($inquiry->company_name, 0, 3, "UTF-8").'-'.($inquiry->id**2)}}
                                </span>
                            </div>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$inquiry->material_name}}</a>
                            <div>
                                <span class="font-weight-bolder">spec:</span>
                                <a class="text-muted font-weight-bold text-hover-primary" href="#">{{$inquiry->spec_name}}</a>
                            </div>
                        </td>
                        <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                @if($inquiry->qty)
                                    {{$inquiry->qty}} {{$inquiry->qty_unit}}
                                @elseif($inquiry->s_po)
                                    {{$inquiry->s_po->qty}}{{$inquiry->s_po->qty_unit}}
                                @else
                                    {{'___'}}
                                @endif
                            </span>
                        </td>
                        <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                @if($inquiry->pilot)
                                    {{$inquiry->pilot->price.' '.$inquiry->pilot->currency->currency_name}}
                                @else
                                    {{'Not Sent'}}
                                @endif
                            </span>
                        </td>
                        <td >
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                            {{$inquiry->created_at}}
                            </span>
                        </td>
                        <td >
                            @if(preg_match('#waiting#',$inquiry->status_name))
                                <span class="label label-lg label-light-warning label-inline">{{$inquiry->status_name}}</span>
                            @elseif(preg_match('#closed#',$inquiry->status_name))
                                <span class="label label-lg label-light-success label-inline">{{$inquiry->status_name}}</span>
                            @elseif(preg_match('#declined#',$inquiry->status_name) | preg_match('#rejected#',$inquiry->status_name))
                                <span class="label label-lg label-light-danger label-inline">{{$inquiry->status_name}}</span>
                            @else
                                <span class="label label-lg label-light-primary label-inline">{{$inquiry->status_name}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('company-inquiry-show',$inquiry->id)}}" class="btn btn-info btn-sm">
                                View Inquiry
                            </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
