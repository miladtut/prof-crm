<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryStoreRequest extends FormRequest
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
            'material_id'=>'required',
            'spec_id'=>'required',
            'qty'=>'required',
            'qty_unit'=>'required',
            'project_status'=>'required',
            'end_market_id'=>'required',
            'supplier_id'=>'max:10000000',
            'document'=>'required'
        ];
    }
}
