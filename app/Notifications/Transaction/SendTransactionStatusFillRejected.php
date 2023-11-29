<?php

namespace App\Notifications\Transaction;

use App\Notifications\Transaction\BaseSendTransactionNotification;
use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Push\FcmMessage;


class SendTransactionStatusFillRejected extends BaseSendTransactionNotification
{

    public function toSmsTj($notifiable)
    {
        return config('app.name') . ' - Ошибка при пополнении баланса. Причина: ' . $this->transaction;
    }

    public function toFcm($notifiable)
    {
        //dd($this->session_in);
        $message = new FcmMessage();
        $message->setTitle('Ошибка при пополнении - ' . config('app.name'));
        $message->setBody('Ошибка при пополнении баланса. Причина: ' . $this->transaction);

        return $message->toArray();
    }

    public function toMail($notifiable)
    {
        //return (new MailRegisteredTmpEmail($notifiable))->to($notifiable->tmp_email);
        //$notifiable->email = $notifiable->tmp_email;

        $message = new MailMessage();
        $message->setEmail($notifiable->email);
        $message->setSubject('Ошибка при пополнении');
        $message->setGreeting("Здравствуйте, {$notifiable->full_name}");
        $message->setLine('Ошибка при пополнении баланса. Причина: ' . $this->transaction);

        return $message->toArray();
    }

}