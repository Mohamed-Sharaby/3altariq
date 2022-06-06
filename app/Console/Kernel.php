<?php

namespace App\Console;

use App\Jobs\CancelPendingOrders;
use App\Models\Order;
use App\Notifications\OrderStatusNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('telescope:prune')->daily();
        $schedule->command('pending-orders:cancel')->everyMinute();
   /*     $schedule->call(function (){

            $orders=Order::selectRaw('*, TIMESTAMPDIFF( MINUTE,created_at,NOW()) as time_diff')->whereRaw('TIMESTAMPDIFF( MINUTE,created_at,NOW()) >= 3')->where('status','pending')->get();
            foreach ($orders as $order){
                $order->update(['status'=>'canceled']);
                $order->provider->notify(New OrderStatusNotification($order));
                $order->user->notify(New OrderStatusNotification($order));
            }

        })->everyMinute();*/

        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
