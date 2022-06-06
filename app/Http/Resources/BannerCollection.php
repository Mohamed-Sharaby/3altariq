<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'type' => __($item->type),
                    'device_type' => __($item->device_type),
                    'country' => __($item->country),
                    'url' => $item->url,
                    'image' => getImgPath($item->image),
                ];
            }),
        ];
    }
}
