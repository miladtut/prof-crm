<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest
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
            'supplier_name'=>'required|max:100',
            'contact_person_name'=>'required|max:100',
            'phone_key'=>'required',
            'phone'=>'required|max:20',
            'country'=>'required|max:50',
            'email'=>'required|email|max:100|unique:companies,email,'.$this->id,
        ];
    }
}
