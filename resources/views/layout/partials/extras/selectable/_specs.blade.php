@foreach(\App\Models\Spec::all() as $spec)
    <option value="{{$spec->id}}" {{@$spec_id == $spec->id ? 'selected':''}}>{{$spec->name}}</option>
@endforeach
