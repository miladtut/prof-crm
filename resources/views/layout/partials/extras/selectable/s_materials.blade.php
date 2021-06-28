<?php
    $materials = \App\Models\Material::query()->has('suppliers')->get();
?>

<option value="">Choose Material</option>
@foreach($materials as $material)
    <option value="{{$material->id}}">{{$material->name}}</option>
@endforeach
