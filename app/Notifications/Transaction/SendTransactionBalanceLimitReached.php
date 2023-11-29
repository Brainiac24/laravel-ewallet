<?php

namespace App\Notifications\Transaction;

use App\Notifications\Transaction\BaseSendTransactionNotification;
use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Push\FcmMessage;

class SendTransactionBalanceLimitReached extends BaseSendTransactionNotification
{

    public function toSmsTj($notifiable)
    {
        return config('app.name') . ' - Ошибка. Сумма пополнения превышает установленный лимит.';
    }

    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->setTitle('Лимит исчерпан');
        $message->setBody('Ошибка. Сумма пополнения превышает установленный лимит.');

        return $message->toArray();
    }

    public function toMail($notifiable)
    {
        //return (new MailRegisteredTmpEmail($notifiable))->to($notifiable->tmp_email);
        //$notifiable->email = $notifiable->tmp_email;

        $message = new MailMessage();
        $message->setEmail($notifiable->email);
        $message->setSubject('Ошибка. Сумма превышает лимит');
        $message->setGreeting("Здравствуйте, {$notifiable->full_name}");
        $message->setLine(sprintf('Сумма пополнения превышает установленный лимит.'));

        return $message->toArray();
    }

}
