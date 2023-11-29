<?php

namespace App\Notifications\Transaction;

use App\Notifications\Transaction\BaseSendTransactionNotification;
use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Push\FcmMessage;

class SendTransactionStatusPayRejected extends BaseSendTransactionNotification
{
   
    public function toSmsTj($notifiable)
    {
        return config('app.name') . ' - Ошибка оплаты. Код оплаты :' . $this->transaction->session_number;
    }

    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->setTitle('Ошибка оплаты - ' . config('app.name'));
        $message->setBody('Ошибка оплаты. Код оплаты :' . $this->transaction->session_number);

        return $message->toArray();
    }

    public function toMail($notifiable)
    {
        //return (new MailRegisteredTmpEmail($notifiable))->to($notifiable->tmp_email);
        //$notifiable->email = $notifiable->tmp_email;

        $message = new MailMessage();
        $message->setEmail($notifiable->email);
        $message->setSubject('Ошибка оплаты');
        $message->setGreeting("Здравствуйте, {$notifiable->full_name}");
        $message->setLine('Ошибка оплаты. ');
        $message->setLine('Код оплаты :' . $this->transaction->session_number);
        

        return $message->toArray();
    }

}
