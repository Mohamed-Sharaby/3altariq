<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OrderResource
 * @package App\Http\Resources
 * @mixin Order
 */
class OrderResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'provider' => new ProviderResource($this->provider),
            'date' => $this->created_at->toDateString(),
            'time' => $this->created_at->format('H:i A'),
            'lat' => (double)$this->lat,
            'lng' => (double)$this->lng,
            'price' => $this->price??'0',
            'note' => $this->notes??'',
            'rate' => (double)$this->rate,
            'status'=>$this->status

        ];
    }
}
