<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PilotRequest extends FormRequest
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
        if (auth('admin')->check()){
            return [
                'price'=>'required',
                'qty'=>'required',
                'currency_id'=>'required',
                'qty_unit'=>'required',
                'price_unit'=>'required'
            ];
        }else{
            return [
                'qty'=>'required',
                'qty_unit'=>'required'
            ];
        }

    }
}
