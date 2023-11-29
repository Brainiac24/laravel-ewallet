<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 15.09.2018
 * Time: 13:19
 */

namespace App\Services\Common\Gateway\Queue\Channels\Mail;


class MailMessage
{
    private $email;
    private $subject;
    private $greeting;
    private $line = [];

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getGreeting()
    {
        return $this->greeting;
    }

    /**
     * @param mixed $greeting
     */
    public function setGreeting($greeting): void
    {
        $this->greeting = $greeting;
    }

    /**
     * @return array
     */
    public function getLine(): array
    {
        return $this->line;
    }

    /**
     * @param array $line
     */
    public function setLine($line): void
    {
        $this->line[] = $line;
    }

    public function toArray()
    {
        return [
            'email' => $this->getEmail(),
            'subject' => $this->getSubject(),
            'greeting' => $this->getGreeting(),
            'line' => $this->getLine(),
        ];
    }

}