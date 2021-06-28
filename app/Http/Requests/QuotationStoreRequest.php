<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price'=>'required',
            'currency_id'=>'required',
            'unit'=>'required',
            'spec_id'=>'required',
            'lead_time'=>'required',
            'validity'=>'required',
            'shipping_term_id'=>'required',
            'payment_term_id'=>'required',
            'origin_id'=>'required',
            'document'=>'max:300'
        ];
    }
}
