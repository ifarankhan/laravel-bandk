<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
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
                'title' => 'required',
                'description' => 'required',
                'category_id' => 'required',
            ];
        } else {
            return [
                'title' => 'required|unique:contents',
                'description' => 'required',
                'category_id' => 'required',
            ];
        }

    }

/*if($this->get('default_content_id')) {
        return [
        'default_title' => 'required',
        'default_description' => 'required',
        'category_id' => 'required',
        ];
}

if($this->get('customer_content_id')) {
    return [
        'title' => 'required',
        'description' => 'required',
        'category_id' => 'required',
    ];
}*/
}
