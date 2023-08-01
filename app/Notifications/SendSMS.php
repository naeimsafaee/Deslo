<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SendSMS extends Notification implements ShouldQueue
{
    use Queueable;

    public $phone;
    public $message;
    public $is_message;

    public function __construct($phone, $message , $is_message = false)
    {
        $this->phone = $phone;
        $this->message = $message;
        $this->message = $message;
        $this->is_message = $is_message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSMS($notifiable)
    {
        return [
            'phone' => $this->phone,
            'message' => $this->message,
            'is_message' => $this->is_message,
        ];
    }
}
