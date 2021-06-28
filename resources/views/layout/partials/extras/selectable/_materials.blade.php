<select name="material_id" required class="form-control kt-select2 select2" id="material">
<option value="">Choose Material</option>
@foreach(\App\Models\Material::all() as $material)
    @if($material->suppliers()->count() > 0)
        @foreach($material->suppliers as $sup)
            <option value="{{$material->id}}" {{$material->id == @$material_id && $sup->id == $sup_id ? 'selected':''}} data-supplier="{{@$sup->id}}">
                {{$material->name}} - {{@$sup->supplier_name}}
            </option>
        @endforeach
    @else
        <option value="{{$material->id}}">
            {{$material->name}}
        </option>
    @endif
@endforeach
    <option value="0">Other</option>
</select>
<input id="supplier" type="hidden" name="supplier_id" value="{{@$sup_id}}">

