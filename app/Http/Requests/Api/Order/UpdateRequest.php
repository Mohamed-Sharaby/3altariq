<?php

namespace App\Http\Requests\Api\Order;

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
        return $order->user_id==$this->user()->id ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rate'=>'required_with:price|min:1|max:5|integer',
            'price'=>'required_with:rate|numeric',
            'notes'=>'nullable|string',
            'status'=>'sometimes|in:canceled'
        ];
    }
}
