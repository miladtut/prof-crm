<style>
    .details{
        min-inline-size: fit-content!important;
        padding-right: 0.5rem;
        padding-left: 0.5rem;
    }
</style>
<div class="card card-custom {{ @$class }}">
    <?php
        $coa = $data->files()->where('type','coa')->first();
    ?>
    {{-- Header --}}
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">Inquiry # {{mb_substr($data->company_name, 0, 3, "UTF-8").'-'.($data->id**2)}}</span>
            <span class="card-label font-weight-bolder text-dark">For <a href="">{{$data->company_name}}</a></span>
            <span class="text-muted mt-3 font-weight-bold ">{{$data->type}}</span>
        </h3>

    </div>
    <div class="card-header border-0 pt-5 row">

            <div class="col-xl-6 mt-2">
                <span class="btn btn-light-info details">{{$data->status_name}}</span>
            </div>
            <div class="col-xl-6 mt-2">
                @if($data->paid == 0)
                    <span class="btn btn-secondary details">Not Paid</span>
                @else
                    <span class="btn btn-light-success details">Paid</span>
                @endif
            </div>

    </div>

    {{-- Body --}}
    <div class="card-body pt-3 pb-0">
        {{-- Table --}}
        <div class="table-responsive">
            <div class="row">
                <div class="col-12">
                    @if($data->material)
                        <span>
                            {{$data->material->name}} {{@$data->supplier->supplier_name}}
                        </span>
                    @endif
                </div>
            </div>
            <table class="table table-borderless table-vertical-center">
                <thead>
                <tr>

                    <th class="p-0" ></th>
                    <th class="p-0" ></th>
                </tr>
                </thead>
                <tbody>
                @if($data->status_logs()->first()->status == 'sending po')
                @else
                <tr>

                    <td class="pl-0 ">
                        <div>
                            <span class="text-muted font-weight-bold text-hover-primary" href="#">spec</span>
                        </div>
                    </td>
                    <td class="pl-0 text-left">
                            <b>
                                {{strtoupper($data->spec_name)}}
                            </b>
                    </td>
                </tr>
                <tr>

                    <td class="pl-0 ">
                        <div>
                            <span class="text-muted font-weight-bold text-hover-primary" href="#">Quantity</span>
                        </div>
                    </td>
                    <td class="pl-0 text-left">
                            <b>
                                {{$data->qty}}  {{strtoupper($data->qty_unit)}}
                            </b>
                    </td>
                </tr>
                <tr>

                    <td class="pl-0">
                        <div>
                            <span class="text-muted font-weight-bold text-hover-primary" href="#">Project Status</span>
                        </div>
                    </td>
                    <td class="pl-0 text-left">
                            <b>
                                {{strtoupper($data->project_status)}}
                            </b>
                    </td>
                </tr>

                <tr>

                    <td class="pl-0">
                        <div>
                            <span class="text-muted font-weight-bold text-hover-primary" href="#">End Market</span>
                        </div>
                    </td>
                    <td class="pl-0 text-left">
                        <b>
                            {{strtoupper($data->country_name)}}
                        </b>
                    </td>
                </tr>

                <tr>

                    <td class="pl-0">
                        <div>
                            <span class="text-muted font-weight-bold text-hover-primary" href="#">COA file</span>
                        </div>
                    </td>
                    <td class="pl-0 text-left">
                        <b>
                            @if($coa)
                                <a href="{{route('company.download',['path'=>$coa->name])}}" ><i class="fa fa-paperclip text-primary"></i> {{strtoupper(setName($coa->name,'COA Document'))}}</a>
                            @endif
                        </b>
                    </td>

                </tr>


                <tr>

                    <td class="pl-0">
                        <div>
                            <span class="text-muted font-weight-bold text-hover-primary" href="#">Documents</span>
                        </div>
                    </td>
                    <td class="pl-0 text-left">

                            @foreach($data->documents as $doc)
                            <b>
                                {{$doc->name.','}}
                            </b>
                            @endforeach

                    </td>

                </tr>
                @endif
                <tr>

                    <td class="pl-0">
                        <div>
                            <span class="text-muted font-weight-bold text-hover-primary" href="#">Created at</span>
                        </div>
                    </td>
                    <td class="pl-0 text-left">
                        <b>
                            {{$data->created_at}}
                        </b>
                    </td>

                </tr>

                <tr>

                    <td class="pl-0">
                        <div>
                            <span class="text-muted font-weight-bold text-hover-primary" href="#">Updated at</span>
                        </div>
                    </td>
                    <td class="pl-0 text-left">
                        <b>
                            {{$data->updated_at}}
                        </b>
                    </td>

                </tr>



                </tbody>
            </table>
        </div>
    </div>
</div>
