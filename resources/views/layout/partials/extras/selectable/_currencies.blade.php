<option value="">Select Currency</option>
@foreach(\App\Models\Currency::all() as $currency)

    <option value="{{$currency->id}}" {{@$cur == $currency->id?'selected':''}}>{{$currency->currency_name}}</option>
@endforeach
