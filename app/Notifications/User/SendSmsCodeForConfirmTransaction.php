<?php

namespace App\Notifications\User;

use App\Services\Common\Gateway\Queue\Channels\QueueSmsTjChannel;
use Illuminate\Notifications\Notification;

class SendSmsCodeForConfirmTransaction extends Notification
{
    private $sms_code = null;

    /**
     * SendSmsCodeForConfirmTransaction constructor.
     * @param $sms_code
     */
    public function __construct($sms_code)
    {
        $this->sms_code=$sms_code;
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
        return sprintf('%s: %s - ваш код для подтверждения', config('app.name'), $this->sms_code);
    }

}
