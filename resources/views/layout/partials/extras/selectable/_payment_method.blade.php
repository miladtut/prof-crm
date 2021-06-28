@foreach(\App\Models\PaymentTerm::all() as $term)
    <option value="{{$term->id}}" {{@$pay_term == $term->id?'selected':''}}>{{$term->payment_name}}</option>
@endforeach
