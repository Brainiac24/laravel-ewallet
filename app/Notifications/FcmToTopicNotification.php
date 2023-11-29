<?php

namespace App\Notifications;

use App\Services\Common\Gateway\Queue\Channels\Push\FcmMessage;
use App\Services\Common\Gateway\Queue\Channels\Push\QueueFcmChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FcmToTopicNotification extends Notification
{
    //use Queueable;
    private $title;
    private $body;
    /**
     * @var string
     */
    private $with_topic;

    /**
     * FcmToTopicNotification constructor.
     * @param $title
     * @param $body
     * @param string $with_topic
     */
    public function __construct($title, $body, $with_topic = "news")
    {
        $this->title = $title;
        $this->body = $body;
        $this->with_topic = $with_topic;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [QueueFcmChannel::class];
    }


    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->setTitle($this->title);
        $message->setBody($this->body);
        $message->setWithTopic($this->with_topic);

        return $message->toArray();
    }


}
