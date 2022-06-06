<?php

namespace App\Notifications;

use App\Services\FireBase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = [
            'title' => $data['title'],
            'body' => $data['body'],
            'type' => 'general'
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',FireBaseChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return
     */
    public function toDatabase($notifiable)
    {
      //  $this->sendFcm($notifiable);
        return $this->data;
    }

    public function toFireBase($notifiable)
    {
        FireBase::notification($notifiable,$this->data['title'],$this->data['body'],$this->data);

    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
//    public function sendFcm($notifiable)
//    {
//        if ($notifiable->fcm_android) {
//            $token = $notifiable->fcm_android;
//            $is_notification = 1;
//        } else {
//            $token = $notifiable->fcm_ios;
//            $is_notification = 0;
//        }
//
//        FireBase::notifyByFirebase($this->data['title'], $this->data['body'], $token, $this->data,$is_notification);
//    }
}
