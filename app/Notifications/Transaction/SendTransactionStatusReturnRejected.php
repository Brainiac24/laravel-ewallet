<?php

namespace App\Notifications\Transaction;

use App\Notifications\Transaction\BaseSendTransactionNotification;
use App\Services\Common\Gateway\Queue\Channels\Mail\MailMessage;
use App\Services\Common\Gateway\Queue\Channels\Push\FcmMessage;

class SendTransactionStatusReturnRejected extends BaseSendTransactionNotification
{

    public function toSmsTj($notifiable)
    {
        return config('app.name') . ' - Ошибка при возврате средств. Код транзакции :' . $this->transaction->session_number;
    }

    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->setTitle('Возврат средств - ' . config('app.name'));
        $message->setBody('Ошибка при возврате средств. Код транзакции :' . $this->transaction->session_number);

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
        $message->setLine('Ошибка при возврате средств. ');
        $message->setLine('Код транзакции :' . $this->transaction->session_number);
        $message->setLine(onfig('app.name'));

        return $message->toArray();
    }

}
