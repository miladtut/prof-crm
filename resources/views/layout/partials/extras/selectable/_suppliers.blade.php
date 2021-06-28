@foreach(\App\Models\Supplier::all() as $supplier)
    <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
@endforeach
