<?php

namespace App\Notifications\Transaction;

use App\Notifications\Transaction\BaseSendTransactionNotification;
use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Push\FcmMessage;
use App\Services\Common\Helpers\Helper;

class SendTransactionStatusFillSuccess extends BaseSendTransactionNotification
{

    public function toSmsTj($notifiable)
    {
        return config('app.name') . ' - Ваш счёт пополнен на сумму: ' . Helper::roundTo2dp($this->transaction->amount) . ' ' . $this->transaction->currency_iso_name;
    }

    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->setTitle('Пополение баланса - ' . config('app.name'));
        $message->setBody('Ваш счёт пополнен на сумму: ' . Helper::roundTo2dp($this->transaction->amount) . ' ' . $this->transaction->currency_iso_name);

        return $message->toArray();
    }

    public function toMail($notifiable)
    {
        //return (new MailRegisteredTmpEmail($notifiable))->to($notifiable->tmp_email);
        //$notifiable->email = $notifiable->tmp_email;

        $message = new MailMessage();
        $message->setEmail($notifiable->email);
        $message->setSubject('Пополение баланса');
        $message->setGreeting("Здравствуйте, {$notifiable->full_name}");
        $message->setLine('Ваш счёт успешно пополнен на сумму: ' . Helper::roundTo2dp($this->transaction->amount) . ' ' . $this->transaction->currency_iso_name);

        return $message->toArray();
    }

}
