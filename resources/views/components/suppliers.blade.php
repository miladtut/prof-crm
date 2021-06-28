
@if(isset($suppliers))
    <div class="bg-light-danger p-5" style="border-radius: 10px">
        <div class="text-danger p-3 mb-5">Please Choose Supplier</div>
        <div class="radio-inline p-3" style="border: 1px solid #f27474">
            @foreach($suppliers as $supplier)
                <label class="radio radio-primary">
                    <input name="supplier_id" required type="radio" value="{{$supplier->id}}">
                    <span></span>
                    <b>{{$supplier->supplier_name}}</b>
                </label>
            @endforeach
        </div>

    </div>
@endif
