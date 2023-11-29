<?php

namespace App\Notifications\User;

use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Mail\QueueEmailTjChannel;
use App\Services\Common\Gateway\Queue\Channels\QueueSmsTjChannel;
use App\Services\Common\Gateway\SMSTransporter\SmsTjChannel;
use Illuminate\Notifications\Notification;

class SendCodeForResetPin extends Notification
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
        return empty($notifiable->email) ? [QueueSmsTjChannel::class] : [QueueEmailTjChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSmsTj($notifiable)
    {
        return sprintf('%s: %s - ваш код для подтверждения', config('app.name'), $notifiable->sms_code);
    }

    public function toMail($notifiable)
    {
        //return (new MailRegisteredTmpEmail($notifiable))->to($notifiable->tmp_email);
        //$notifiable->email = $notifiable->tmp_email;

        $message = new MailMessage();
        $message->setEmail($notifiable->email);
        $message->setSubject('Подтверждения сброса пин-кода');
        $message->setGreeting("Здравствуйте, {$notifiable->full_name}");
        $message->setLine(sprintf('Чтобы сбросить пин-код в %s, введите одноразовый код:', config('app.name')));
        $message->setLine($notifiable->email_code);
        $message->setLine('Если вы не запрашивали код доступа, просто удалите это письмо.');

        return $message->toArray();
    }

}
