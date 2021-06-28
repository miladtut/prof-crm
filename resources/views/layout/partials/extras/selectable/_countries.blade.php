@foreach(\App\Models\Country::all() as $country)
    <option value="{{$country->id}}" {{@$coun_id == $country->id?'selected':''}}>{{$country->name}}</option>
@endforeach
