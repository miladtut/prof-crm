{{-- Advance Table Widget 2 --}}

<div class="card card-custom {{ @$class }}">
    {{-- Header --}}
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">Top Materials</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Checkout materials with highest inquiries</span>
        </h3>

    </div>

    {{-- Body --}}
    <div class="card-body pt-3 pb-0">
        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-borderless table-vertical-center">
                <thead>
                <tr>
                    <th class="p-0" style="width: 50px"></th>
                    <th class="p-0" style="min-width: 200px"></th>
                    <th class="p-0" style="min-width: 100px"></th>

                </tr>
                </thead>
                <tbody>
                @php($top5 = \App\Models\Material::withCount('inquiry')->having('inquiry_count','>',0)->orderBy('inquiry_count','DESC')->take(5)->get())
                @foreach($top5 as $item)
                    <tr>
                        <td class="pl-0 py-4">
                            <div class="symbol symbol-50 symbol-light mr-1">
                                <span class="symbol-label">
                                    {{$item->id}}
                                </span>
                            </div>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                {{$item->name}}
                            </a>
                            <div>
                            <span class="text-muted font-weight-bold">
                                {{''}}
                            </span>
                            </div>
                        </td>
                        <td class="text-right">
                        <span class="text-muted font-weight-bold">
                             {{$item->inquiry()->count()}} Inquiries
                        </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
