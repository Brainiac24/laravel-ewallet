<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 16.07.2018
 * Time: 16:45
 */

namespace App\Services\Common\Gateway\Queue\Channels\Mail;


use App\Exceptions\Frontend\Api\LogicException;
use App\Services\Common\Gateway\Queue\QueueHandlerEnum;
use App\Services\Common\Gateway\Queue\QueueTransporterContract;
use Illuminate\Notifications\Notification;

class QueueEmailTjChannel
{
    protected $queue;

    /**
     * QueueSmsTjChannel constructor.
     * @param QueueTransporterContract $queue
     */
    public function __construct(QueueTransporterContract $queue)
    {
        $this->queue = $queue;
    }

    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws LogicException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->{'toMail'}($notifiable);

//        if (!property_exists($notifiable, 'email'))
//            throw new LogicException('property email not found');

//        if (!property_exists($notifiable, 'email'))
//            throw new LogicException('property email not found');

        //$to = $notifiable->email;

//        if (empty($to))
//            throw new LogicException('email not found');

        if (!\App::environment('local')) {
            $payload = $message;

            $this->queue->send($payload, QueueHandlerEnum::EMAIL_NOTIFICATION);
        }
    }
}