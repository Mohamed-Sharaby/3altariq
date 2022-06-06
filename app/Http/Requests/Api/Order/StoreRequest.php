<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !$this->user()->orders()->whereNotIn('status', ['finished', 'canceled', 'rejected'])->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'provider_id' => 'required|exists:providers,id',
            'lat' => 'required|numeric|min:-90|max:90',
            'lng' => 'required|numeric|min:-90|max:90',
        ];
    }

}
