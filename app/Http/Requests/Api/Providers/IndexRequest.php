<?php

namespace App\Http\Requests\Api\Providers;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'service_id'=>'required|exists:services,id',
            'lat'=>'required|numeric|min:-90|max:90',
            'lng'=>'required|numeric|min:-90|max:90',
        ];
    }
}
