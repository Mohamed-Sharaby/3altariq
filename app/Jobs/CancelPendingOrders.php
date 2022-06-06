<?php

namespace App\Jobs;

use App\Models\Order;
use App\Notifications\OrderStatusNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CancelPendingOrders
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        log('this is cancel order');
        log(\DB::statement('select now() ;'));
        $orders=Order::selectRaw('*, TIMESTAMPDIFF( MINUTE,created_at,'.now()->toDateTimeString().') as time_diff')->whereRaw('TIMESTAMPDIFF( MINUTE,created_at,'.now()->toDateTimeString().') >= 3')->where('status','pending')->get();
        foreach ($orders as $order){
            $order->update(['status'=>'canceled']);
            $order->provider->notify(New OrderStatusNotification($order));
            $order->user->notify(New OrderStatusNotification($order));
        }

    }
}
