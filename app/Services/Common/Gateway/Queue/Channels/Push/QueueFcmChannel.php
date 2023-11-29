<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 16.07.2018
 * Time: 16:45
 */

namespace App\Services\Common\Gateway\Queue\Channels\Push;


use App\Exceptions\Frontend\Api\LogicException;
use App\Services\Common\Gateway\Queue\QueueHandlerEnum;
use App\Services\Common\Gateway\Queue\QueueTransporterContract;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;

class QueueFcmChannel
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
        $message = $notification->{'toFcm'}($notifiable);

        if (!\App::environment('local')) {

            $topic_name = null;
            $push_token = "empty";
            $available_at = null;

            if (isset($message['topic_name']) && !empty($message['topic_name'])) {
                $topic_name = $message['topic_name'];
                $available_at = Carbon::now()->addMinute(3)->format('Y-m-d H:i:s');
                unset($message['topic_name']);
            } else if (isset($notifiable->devices_json['push_token'])) {
                $push_token = $notifiable->devices_json['push_token'];
            }

            if ($topic_name !== null || $push_token != null) {
                $payload = [
                    'content' => $message,
                    'push_token' => $push_token
                ];

                if ($topic_name !== null)
                    $payload['topic_name'] = $topic_name;

                $this->queue->send($payload, QueueHandlerEnum::PUSH_NOTIFICATION, true, $available_at);
            }
        }
    }
}