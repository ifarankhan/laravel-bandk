<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if(is_null($this->get('id')))  {
            return [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'roles' => 'required',
                'modules' => 'required',
                'customer_id' => 'required'
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required',
                'roles' => 'required',
                'modules' => 'required',
            ];

        }
    }
}
