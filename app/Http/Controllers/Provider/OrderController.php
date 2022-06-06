<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Providers\Orders\UpdateRequest;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Notifications\OrderStatusNotification;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderController extends Controller
{
    public function index()
    {
        return \responder::success(new BaseCollection(auth()->user()->orders()->latest()->paginate(10), OrderResource::class));
    }

    public function show(Order $order)
    {
        return \responder::success(new OrderResource($order));

    }
    public function update(UpdateRequest $request, Order $order)
    {
        $inputs = $request->validated();
        $order->update($inputs);
        $order->user->notify(new OrderStatusNotification($order->refresh()));

       // return \responder::success(__('order updated successfully !'));
        return \responder::success(new OrderResource($order));
    }
}
