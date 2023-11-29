<?php

namespace App\Mail\User;

use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class RegisteredTmpEmail extends Mailable
{
    use SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @return MailMessage
     */
    public function build()
    {
        /*
        dd((new MailMessage)
            ->subject('Подтверждения привязки почты')
            ->greeting("Здравствуйте, {$this->user->full_name}")
            ->line('Чтобы привязать почту в Eskhata Online, введите одноразовый код:')
            ->greeting($this->user->email_code)
            ->line('С уважением, Банк Эсхата'));
        */
        //return $this->
    }
}
