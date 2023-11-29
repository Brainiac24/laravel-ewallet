<?php

namespace App\Notifications\Transaction;

use App\Notifications\Transaction\BaseSendTransactionNotification;
use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Push\FcmMessage;

class SendTransactionStatusReturnSuccess extends BaseSendTransactionNotification
{
    
    public function toSmsTj($notifiable)
    {
        return config('app.name') . ' - Возврат средств: Успешно. Код транзакции :' . $this->transaction->session_number;
    }

    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->setTitle('Возврат средств исполнен успешно - ' . config('app.name'));
        $message->setBody('Запрос на возврат средств исполнен успешно. Код транзакции :' . $this->transaction->session_number);

        return $message->toArray();
    }

    public function toMail($notifiable)
    {
        //return (new MailRegisteredTmpEmail($notifiable))->to($notifiable->tmp_email);
        //$notifiable->email = $notifiable->tmp_email;

        $message = new MailMessage();
        $message->setEmail($notifiable->email);
        $message->setSubject('Возврат средств');
        $message->setGreeting("Здравствуйте, {$notifiable->full_name}");
        $message->setLine('Запрос на возврат исполнен успешно. Код транзакции :' . $this->transaction->session_number);

        return $message->toArray();
    }

}
