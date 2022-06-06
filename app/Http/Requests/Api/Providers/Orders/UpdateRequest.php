<?php

namespace App\Http\Requests\Api\Providers\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $order=$this->route('order');
        return $order->provider_id==$this->user()->id and in_array($order->status,['pending','confirmed']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'=>'required|string|in:confirmed,rejected,wait_for_rate'
        ];
    }
}
