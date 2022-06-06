<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Providers\IndexRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use App\Services\FirestoreProviders;

class ProviderController extends Controller
{
    public function index(IndexRequest $request)
    {
        $firestore_provides = (new FirestoreProviders())->filterProviders($request->service_id,30, 30);
        $providers = Provider::query();
        $providers->whereIn('id', $firestore_provides->pluck('id')->toArray());
        $providers->whereDate('expire_at','>=',now()->toDateString());
        $providers->where('is_active',1)->where('is_confirmed',1);
        $providers->when(\request('category_id'), function ($query) {
            $query->whereHas('service', function ($q) {
                $q->where('category_id', \request('category_id'));
            });
        });
        $providers->where('is_reviewed',1);
        $providers->when(\request('category_id'), function ($q) {
            $q->where('service_id', \request('service_id'));
        });
        $providers->withCount(['PendingOrders','CanceledOrders','FinishedOrders','OnTheWayOrders','orders']);
        $providers->withAvg('orders','rate');
        $data = $providers->get()->transform(function ($q) use ($firestore_provides) {
            $q['lat'] = $firestore_provides[$q['id']]['lat'];
            $q['lng'] = $firestore_provides[$q['id']]['lng'];
            $q['distance'] = $firestore_provides[$q['id']]['distance'];
            return $q;
        });
        return \responder::success(ProviderResource::collection($data));
    }
}
