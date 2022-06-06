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
        $rules = [
            'name' => 'required|string|max:100|unique:users,name',
            'country_code' => 'required',
            'phone' => 'required|phone:eg,jo,kw|unique:users,phone',
            'password' => 'required|confirmed|min:6',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
          //  'country' => 'required|in:jordan,kuwait',
            'is_active' => 'boolean',

        ];

        if ($this->method() == 'PUT') {
            $rules = [
                'name' => 'required|string|max:100|unique:users,name,'. $this->user->id,
                'country_code' => 'required',
                'phone' => 'required|phone:eg,jo,kw|unique:users,phone,' . $this->user->id,
                'password' => 'nullable|confirmed|min:6',
                'image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
               // 'country' => 'nullable|in:jordan,kuwait',
                'is_active' => 'boolean',
            ];
        }
        return $rules;
    }
}
