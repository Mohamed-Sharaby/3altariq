<?php


namespace App\Services;

class ProvidersTransFormer
{
    private $providers;

    public function __construct(array $providers)
    {
        $this->providers = collect($providers);
    }

    public function transform($lat, $lng)
    {

        return $this->providers->mapWithKeys(function ($q) use ($lat, $lng) {
            $data = $q->data();
            return [$data['id'] => [
                'id' => $data['id'],
                'is_online' => $data['is_online'],
                'lat' => $data['location']->latitude(),
                'lng' => $data['location']->longitude(),
                'distance' => distanceCalculation($lat, $lng, $data['location']->latitude(), $data['location']->longitude())
            ]
            ];
        });
    }
}
