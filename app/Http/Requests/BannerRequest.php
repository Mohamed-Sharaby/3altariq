<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'ar_name' => 'required|string|max:255',
            'en_name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'type' => 'required|in:normal,splash',
            'device_type' => 'required|in:android,ios',
            'image' => 'required|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
            'url' => 'required',
            'url_type'=>'required|in:facebook,instagram,twitter,whatsapp,website'

        ];

        if ($this->method() == 'PUT') {
            $rules = [
                'ar_name' => 'required|string|max:255',
                'en_name' => 'required|string|max:255',
                'country_id' => 'required|exists:countries,id',
                'type' => 'required|in:normal,splash',
                'device_type' => 'required|in:android,ios',
                'url' => 'required',
                'image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
                'url_type'=>'required|in:facebook,instagram,twitter,whatsapp,website'

            ];
        }
        return $rules;
    }
}
