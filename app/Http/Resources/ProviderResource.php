<?php

namespace App\Http\Resources;

use App\Models\Country;
use App\Models\Provider;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProviderResource
 * @package App\Http\Resources
 * @mixin Provider
 */
class ProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country_code' => $this->country_code,
            'country' => new CountryResource($this->country),
            'phone' => $this->phone,
            'image' => $this->image ,
            'images'=>MediaResource::collection($this->getMedia('photos')),
            'token' => $this->when($this->token, $this->token),
            'location' => $this->location,
            'is_active' => $this->is_active==true,
            'is_confirmed' => $this->is_confirmed==true,
            'bio'=>$this->bio??'',
            'service'=>new ServiceResource($this->service),
            'is_verified'=>$this->is_verified==true,
            'lat'=>$this->lat??0,
            'lng'=>$this->lng??0,
            'expire_at'=>$this->expire_at->toDateString(),
            'has_expired'=>now()->greaterThan($this->expire_at),
            'views'=>(int)$this->profile_counter,
            'rate'=>round($this->orders_avg_rate)??0,
            'distance'=>$this->distance??0,
            'has_accepted_order'=>$this->has_accepted_order==true??false,
            'chart'=>[
                'on_the_road'=>(int)$this->on_the_way_orders_count,
                'canceled'=>(int)$this->canceled_orders_count,
                'finished'=>(int)$this->finished_orders_count,
                'pending'=>(int)$this->pending_orders_count,
                'orders'=>(int)$this->orders_count,
            ]
        ];
    }
}
