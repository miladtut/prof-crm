
<option value="">Choose Material</option>
@foreach(\App\Models\Material::all() as $material)

        <option value="{{$material->id}}">
            {{$material->name}}
        </option>

@endforeach



