<?php

namespace App\Notifications\Transaction;

use App\Notifications\Transaction\BaseSendTransactionNotification;
use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Push\FcmMessage;

class SendTransactionStatusPaySuccess extends BaseSendTransactionNotification
{
    
    public function toSmsTj($notifiable)
    {
        return config('app.name') . ' - Оплата успешно завершена. Код оплаты :' . $this->transaction->session_number;
    }

    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->setTitle('Оплата успешно завершена');
        $message->setBody('Оплата успешно завершена. Код оплаты :' . $this->transaction->session_number);

        return $message->toArray();
    }

    public function toMail($notifiable)
    {
        //return (new MailRegisteredTmpEmail($notifiable))->to($notifiable->tmp_email);
        //$notifiable->email = $notifiable->tmp_email;

        $message = new MailMessage();
        $message->setEmail($notifiable->email);
        $message->setSubject('Оплата успешно завершена');
        $message->setGreeting("Здравствуйте, {$notifiable->full_name}");
        $message->setLine('Оплата успешно завершена.');
        $message->setLine('Код оплаты :' . $this->transaction->session_number);

        return $message->toArray();
    }

}
