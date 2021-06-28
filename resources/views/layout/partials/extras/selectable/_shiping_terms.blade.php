@foreach(\App\Models\ShippingTerm::all() as $term)
    <option value="{{$term->id}}" {{@$ship_term == $term->id?'selected':''}}>{{$term->shipping_name}}</option>
@endforeach
