<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required|string|max:100|unique:admins,name',
            'email' => 'required|email|max:100|unique:admins,email',
            'phone' => 'required|numeric|phone:EG,SA|unique:admins,phone',
            'password' => 'required|confirmed|min:6',
            'permissions'=>'nullable',
            'roles'=>'required',
            'is_active'=>'boolean',
        ];

        if ($this->method() == 'PUT') {
            $rules = [
                'name' => 'required|string|max:100|unique:admins,name,'.$this->admin,
                'email' => 'required|email|max:100|unique:admins,email,' . $this->admin,
                'phone' => 'required|numeric|phone:EG,SA|unique:admins,phone,' . $this->admin,
                'password' => 'nullable|confirmed|min:6',
                'permissions'=>'nullable',
                'roles'=>'nullable',
                'is_active'=>'boolean',
            ];
        }
        return $rules;
    }
}
