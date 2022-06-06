<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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
            'parent_id' => 'nullable',
            'country_code'=>Rule::requiredIf(function (){
                return is_null($this->request->get('parent_id'));
            })
        ];

        if ($this->method() == 'PUT') {
            $rules = [
                'ar_name' => 'required|string|max:255',
                'en_name' => 'required|string|max:255',
                'parent_id' => 'nullable',
                'country_code'=>Rule::requiredIf(function (){
                    return is_null($this->request->get('parent_id'));
                })
            ];
        }
        return $rules;
    }
}
