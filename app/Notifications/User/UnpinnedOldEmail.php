<?php

namespace App\Notifications\User;

use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Mail\QueueEmailTjChannel;
use Illuminate\Notifications\Notification;

class UnpinnedOldEmail extends Notification
{
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @param $email
     * @return void
     */
    public function __construct(string $email)
    {
        $this->email = $email;
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
        $message = new MailMessage();
        $message->setEmail( $this->email);
        $message->setSubject('Смена почты');
        $message->setGreeting("Здравствуйте, {$notifiable->full_name}");
        $message->setLine("Ваша почта была откреплена от аккаунта {$notifiable->msisdn}");
        $message->setLine('Если вы не запрашивали смену email, сообщите в Call Center банка по номеру 446000600 для предотвращения несанкционированного доступа.');

        return $message->toArray();
    }
}
