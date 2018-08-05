<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class ClaimCreationRequest extends FormRequest
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
            'estimate' => 'required',
            'date' => 'required',
            'claim_mechanic_id' => 'required',
            'department_id' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'status' => 'required',
        ];
    }
}
