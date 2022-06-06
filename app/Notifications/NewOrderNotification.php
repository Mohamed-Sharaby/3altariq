<?php

namespace App\Notifications;

use App\Models\Order;
use App\Services\FireBase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $message;
    private $order;
    public function __construct(Order $order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', FireBaseChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $message = [
            'model_id' => $this->order->id,
            'user' => [
                'id' => $this->order->user_id,
                'name' => $this->order->user->name,
            ],
            'provider' => [
                'id' => $this->order->provider_id,
                'name' => $this->order->provider->name,
            ],
            'title' => __('on the road app || New order',[],$notifiable->locale),
            'body' => __("there is a new order near by you # :order",['order'=> $this->order->id],$notifiable->locale),

            'title_ar' => 'تطبيق عالطريق || هناك طلب جديد',
            'body_ar' => "هناك طلب جديد قريب منك #" . $this->order->id,
            'type' => 'order',
            'action_type'=>'text'
        ];
        return $message;
    }

    public function toFireBase($notifiable)
    {
        $message = [
            'model_id' => $this->order->id,
            'user' => [
                'id' => $this->order->user_id,
                'name' => $this->order->user->name,
            ],
            'provider' => [
                'id' => $this->order->provider_id,
                'name' => $this->order->provider->name,
            ],
            'title' => __('on the road app || New order',[],$notifiable->locale),
            'body' => __("there is a new order near by you # :order",['order'=> $this->order->id],$notifiable->locale),

            'title_ar' => 'تطبيق عالطريق || هناك طلب جديد',
            'body_ar' => "هناك طلب جديد قريب منك #" . $this->order->id,
            'type' => 'order',
            'action_type'=>'text'
        ];
        FireBase::notification($notifiable,$message['title'],$message['body'],$message);
    }
}
