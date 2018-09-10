<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaimRequests extends FormRequest
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
            'claim_type_id' => 'required',
            'customer_id' => 'required',
            'estimate' => 'required',
            'date' => 'required',
            'claim_mechanic_id' => 'required',
            'department_id' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'description' => 'required',
            'status' => 'required',
            'images' => 'required',
            /*'images.*' => 'mimes:jpg,png,jpeg'*/
        ];
    }

    public function messages()
    {
        return [
            'claim_type_id.required' => 'Claim type field is required',
            'customer_id.required' => 'Customer field is required',
            'estimate.required' => 'Estimate is required',
            'claim_mechanic_id.required' => 'Claim mechanics field is required.',
            'department_id.required' => 'Department field is required',
            'address_1.required' => 'Address field is required',
            'address_2.required' => 'Sub address field is required',
        ];
    }
}
