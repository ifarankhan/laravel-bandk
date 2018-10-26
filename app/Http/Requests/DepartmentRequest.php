<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        if($this->get('id')) {
            return [
                'name' => 'required',
                /*'code' => 'required|numeric',*/
                'customer_id' => 'required',
                'addresses' => 'required'
            ];
        }

        return [
            'name' => 'required|unique:departments',
            //'name' => 'required|unique:departments,name,'.$this->get('customer_id').',customer_id',
            /*'code' => 'required|numeric|unique:departments',*/
            'customer_id' => 'required',
            'addresses' => 'required'
        ];

    }
}
