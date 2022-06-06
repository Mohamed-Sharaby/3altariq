<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        $rules = [
//            'ar_name' => 'required|string|max:255',
//            'en_name' => 'required|string|max:255',
            'url' => 'required|url',
            'ar_description' => 'required|string',
            'en_description' => 'required|string',
//            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
        ];

        if ($this->method() == 'PUT') {
            $rules = [
//                'ar_name' => 'required|string|max:255',
//                'en_name' => 'required|string|max:255',
                'url' => 'required|url',
                'ar_description' => 'required|string',
                'en_description' => 'required|string',
//                'image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
            ];
        }
        return $rules;
    }
}
