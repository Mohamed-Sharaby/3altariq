<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Http\Requests\Api\Order\UpdateRequest;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Notifications\NewOrderNotification;

class OrderController extends Controller
{
    public function index()
    {
        $orders=auth()->user()->orders()->when(request()->has('date_from') and request()->has('date_to'),function ($q){
            $q->whereDate('created_at','>=',request('date_from'))->whereDate('created_at','<=',request('date_to'));
        })->latest()->paginate(10);
        return \responder::success(new BaseCollection($orders, OrderResource::class));
    }

    public function store(StoreRequest $request)
    {

        $inputs = $request->validated();
        $inputs['user_id'] = auth()->id();
        $order = Order::create($inputs);
        $order->provider->notify(new NewOrderNotification($order->refresh()));
       // return \responder::success(__('your order has been sent to the provider'));
        return \responder::success(new OrderResource($order));
    }

    public function show(Order $order)
    {
        return \responder::success(new OrderResource($order));

    }

    public function update(UpdateRequest $request, Order $order)
    {
        $inputs=$request->validated();
        if (!$request->has('status')){
            $inputs['status']='finished';
        }
        $order->update($inputs);

      //  return \responder::success(__('thank you for your order'));
        return \responder::success(new OrderResource($order));
    }
}
