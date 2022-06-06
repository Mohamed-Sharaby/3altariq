<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country_code' => $this->country_code,
            'phone' => $this->phone,
            'image' => $this->image,
            'token' => $this->when($this->token, $this->token),
            'is_active' => $this->is_active==true,
            'is_confirmed' => $this->is_confirmed==true,
            'has_rate_order'=>(int)object_get($this->orders()->where('status','wait_for_rate')->first(),'id',0)
        ];
    }
}
