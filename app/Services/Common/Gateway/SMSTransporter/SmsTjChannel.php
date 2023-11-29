<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 16.07.2018
 * Time: 16:45
 */

namespace App\Services\Common\Gateway\SMSTransporter;


use App\Exceptions\Frontend\Api\LogicException;
use Illuminate\Notifications\Notification;

class SmsTjChannel
{
    protected $sms;

    /**
     * SmsTjChannel constructor.
     *
     * @param
     */
    public function __construct(SMSTransporterContract $sms)
    {
        $this->sms = $sms;
    }

    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws LogicException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->{'toSmsTj'}($notifiable);
        
        if (!method_exists($notifiable, 'routeNotificationForSmsTj'))
            throw new LogicException('routeNotificationForSmsTj not found');

        $to = $notifiable->routeNotificationForSmsTj();

        if (empty($to))
            throw new LogicException('SmsTjChannel route not found');

        if (!\App::environment('local')) {
            $this->sms->send($to, $message);
        }
    }
}