{{-- Mixed Widget 1 --}}

<div class="card card-custom bg-gray-100 {{ @$class }}">
    {{-- Header --}}
    <div class="card-header border-0 bg-primary py-5">
        <h3 class="card-title font-weight-bolder text-white">Customer Stat</h3>
    </div>
    {{-- Body --}}
    <div class="card-body p-0 position-relative overflow-hidden">
        {{-- Chart --}}
        <div id="kt_mixed_widget_2_chart" class="card-rounded-bottom bg-primary" style="height: 200px"></div>

        {{-- Stats --}}
        <div class="card-spacer mt-n25">
            {{-- Row --}}
            <div class="row m-0">
                <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                    <h1>{{\App\Models\Company::all()->count()}}</h1>
                    <a href="#" class="text-dark font-weight-bold font-size-h6">
                        All Customers
                    </a>
                </div>
                <div class="col bg-white px-6 py-8 rounded-xl mb-7">
                    <h1>{{\App\Models\Company::where('created_at','>=',\Carbon\Carbon::now()->subMonth())->count()}}</h1>
                    <h3 class="text-dark font-weight-bold">
                        New Customers
                    </h3>
                </div>
            </div>
            {{-- Row --}}
            <div class="row m-0">
                <div class="col bg-white px-6 py-8 rounded-xl mr-7">
                    <h1>{{\App\Models\Company::where('account_type','logistic')->count()}}</h1>
                    <h3 class="text-dark font-weight-bold">
                        Logistic
                    </h3>
                </div>
                <div class="col bg-white px-6 py-8 rounded-xl">
                    <h1>{{\App\Models\Company::where('account_type','regular')->count()}}</h1>
                    <h3 class="text-dark font-weight-bold">
                        Regular
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
