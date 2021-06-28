<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierPoRequest extends FormRequest
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
            'supplier_id'=>'required',
            'payment_term_id'=>'required',
            'shipping_term_id'=>'required',
            'delivery'=>'required',
            'place_of_delivery'=>'required',
            'txt_points'=>'max:5000',
            'material_id'=>'required',
            'material_qty'=>'required',
            'material_qty_unit'=>'required',
            'working_standard_qty'=>'required',
            'working_standard_qty_unit'=>'required',
            'material_price_per_unit'=>'required',
            'working_standard_price_per_unit'=>'required',
            ''
        ];
    }
}
