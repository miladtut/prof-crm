@foreach(\App\Models\Country::all() as $country)
<option value="{{$country->phone_key}}" {{@$phone_key == $country->phone_key?'selected':''}}>{{$country->phone_key}}</option>
@endforeach
