<?php

namespace App\Http\Requests;

use App\User;
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
                'email' => 'required|email',
                'username' => 'required|unique:users',
                'phone_number' => 'required',
                'password' => 'required',
                'roles' => 'required',
                'modules' => 'required',
                'departments' => 'required',
                'customer_id' => 'required'
            ];
        } else {
            $username = User::where('username', $this->get('username'))->first();
            if(($username) && $username->id != $this->get('id')) {
                return [
                    'name' => 'required',
                    'phone_number' => 'required',
                    'username' => 'required|unique:users',
                    'email' => 'required',
                    'roles' => 'required',
                    'departments' => 'required',
                    'modules' => 'required'
                ];
            } else {
                return [
                    'name' => 'required',
                    'phone_number' => 'required',
                    'username' => 'required',
                    'email' => 'required',
                    'roles' => 'required',
                    'departments' => 'required',
                    'modules' => 'required'
                ];
            }
        }
    }
}
