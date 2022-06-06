<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Notifications\OrderStatusNotification;
use Illuminate\Console\Command;

class CancelPendingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pending-orders:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cancel pending orders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now=now()->toDateTimeString();
        $orders=Order::selectRaw("*, TIMESTAMPDIFF( MINUTE,created_at,'{$now}') as time_diff")->whereRaw("TIMESTAMPDIFF( MINUTE,created_at,'{$now}') >= 3")->where('status','pending')->get();
        foreach ($orders as $order){
            $order->update(['status'=>'canceled']);
            $order->provider->notify(New OrderStatusNotification($order));
            $order->user->notify(New OrderStatusNotification($order));
        }
    }
}
