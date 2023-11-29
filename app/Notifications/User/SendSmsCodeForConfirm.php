<?php

namespace App\Notifications\User;

use App\Services\Common\Gateway\Queue\Channels\Push\FcmMessage;
use App\Services\Common\Gateway\Queue\Channels\Push\QueueFcmChannel;
use App\Services\Common\Gateway\Queue\Channels\QueueSmsTjChannel;
use App\Services\Common\Gateway\SMSTransporter\SmsTjChannel;
use Illuminate\Notifications\Notification;

class SendSmsCodeForConfirm extends Notification
{

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [QueueSmsTjChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSmsTj($notifiable)
    {
//        return sprintf('%s: %s - код подтверждения.', config('app.name'), $notifiable->sms_code);
        return sprintf('%s: %s - ваш код для подтверждения', config('app.name'), $notifiable->sms_code);
    }

    public function toFcm($notifiable)
    {
//        return sprintf('%s: %s - ваш код для подтверждения', config('app.name'), $notifiable->sms_code);

        $message = new FcmMessage();
        $message->setTitle('Код подтверждения');
        $message->setBody(sprintf('%s: %s - ваш код для подтверждения', config('app.name'), $notifiable->sms_code));

        return $message->toArray();
    }

}
