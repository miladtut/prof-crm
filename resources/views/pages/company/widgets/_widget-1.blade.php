{{-- Mixed Widget 1 --}}

<div class="card card-custom bg-gray-100 {{ @$class }}">
    {{-- Header --}}
    <div class="card-header border-0 bg-danger py-5">
        <h3 class="card-title font-weight-bolder text-white">Status</h3>
    </div>
    {{-- Body --}}
    <div class="card-body p-0 position-relative overflow-hidden">
        {{-- Chart --}}
        <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger" style="height: 200px"></div>

        {{-- Stats --}}
        <div class="card-spacer mt-n25">
            {{-- Row --}}
            <div class="row m-0">
                <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                    <h1>{{auth()->user()->inquiries()->count()}}</h1>
                    <a href="#" class="text-dark font-weight-bold font-size-h6">
                        All Inquiries
                    </a>
                </div>
                <div class="col bg-white px-6 py-8 rounded-xl mb-7">
                    <h1>{{auth()->user()->inquiries()->where('status','>=',11)->count()}}</h1>
                    <h3 class="text-dark font-weight-bold">
                        PO Sent
                    </h3>
                </div>
            </div>
            {{-- Row --}}
            <div class="row m-0">
                <div class="col bg-white px-6 py-8 rounded-xl mr-7">
                    <h1>{{auth()->user()->inquiries()->where('status_name','declined')->count()}}</h1>
                    <h3 class="text-dark font-weight-bold">
                        Declined
                    </h3>
                </div>
                <div class="col bg-white px-6 py-8 rounded-xl">
                    <h1>{{auth()->user()->inquiries()->where('status_name','closed')->count()}}</h1>
                    <h3 class="text-dark font-weight-bold">
                        Closed
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
