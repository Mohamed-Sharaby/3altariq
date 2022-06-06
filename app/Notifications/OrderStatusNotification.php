<?php

namespace App\Notifications;

use App\Models\Order;
use App\Services\FireBase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification
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
        $this->order = $order;
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
        $status= __($this->order->status,[],$notifiable->locale);

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
            'title' => __("on the road app || Order status has changed", [], $notifiable->locale),
            'body' => __("Order :order status changed to :status", ['order' => $this->order->id, 'status' =>$status], $notifiable->locale),

            'title_ar' => 'تطبيق عالطريق || هناك تحديث علي حالة طلبك',
            'body_ar' => "طلبك رقم {$this->order->id} قد تم تحديث حالتة الي {$this->order->status_ar}",
            'type' => 'order',
            'action_type' => 'text'
        ];
        return $message;
    }

    public function toFireBase($notifiable)
    {
        $status= __($this->order->status,[],$notifiable->locale);
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
            'title' => __("on the road app || Order status has changed", [], $notifiable->locale),
            'body' => __("Order :order status changed to :status", ['order' => $this->order->id, 'status' =>$status], $notifiable->locale),

            'title_ar' => 'تطبيق عالطريق || هناك تحديث علي حالة طلبك',
            'body_ar' => "طلبك رقم {$this->order->id} قد تم تحديث حالتة الي {$this->order->status_ar}",
            'type' => 'order',
            'action_type' => 'text'
        ];
        FireBase::notification($notifiable, $message['title'], $message['body'], $message);
    }
}
