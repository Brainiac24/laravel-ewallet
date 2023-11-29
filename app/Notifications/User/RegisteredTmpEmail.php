<?php

namespace App\Notifications\User;

use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Mail\QueueEmailTjChannel;
use Illuminate\Notifications\Notification;

class RegisteredTmpEmail extends Notification
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
        return [QueueEmailTjChannel::class];
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toMail($notifiable)
    {
        //return (new MailRegisteredTmpEmail($notifiable))->to($notifiable->tmp_email);

        $message = new MailMessage();
        $message->setEmail($notifiable->tmp_email);
        $message->setSubject('Подтверждения привязки почты');
        $message->setGreeting("Здравствуйте, {$notifiable->full_name}");
        $message->setLine(sprintf('Чтобы привязать почту в %s, введите одноразовый код:', config('app.name')));
        $message->setLine($notifiable->email_code);
        $message->setLine('Если вы не запрашивали код подтверждения для привязки email, сообщите в Call Center банка по номеру 446000600 для предотвращения несанкционированного доступа.');

        return $message->toArray();
    }

}
