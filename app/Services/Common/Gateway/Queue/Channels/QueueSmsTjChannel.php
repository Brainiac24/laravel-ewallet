<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 16.07.2018
 * Time: 16:45
 */

namespace App\Services\Common\Gateway\Queue\Channels;


use App\Exceptions\Frontend\Api\LogicException;
use App\Services\Common\Gateway\Queue\QueueHandlerEnum;
use App\Services\Common\Gateway\Queue\QueueTransporterContract;
use Illuminate\Notifications\Notification;

class QueueSmsTjChannel
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
        $message = $notification->{'toSmsTj'}($notifiable);

        if (!method_exists($notifiable, 'routeNotificationForSmsTj'))
            throw new LogicException('routeNotificationForSmsTj not found');

        $to = $notifiable->routeNotificationForSmsTj();

        if (empty($to))
            throw new LogicException('SmsTjChannel route not found');

        if (!\App::environment('local')) {
            $payload = [
                'to' => (string)$to,
                'message' => $message,
            ];

            $this->queue->send($payload, QueueHandlerEnum::SMS_NOTIFICATION);
        }
    }
}