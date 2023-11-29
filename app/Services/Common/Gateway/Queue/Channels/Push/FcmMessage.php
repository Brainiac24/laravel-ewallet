<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 15.09.2018
 * Time: 14:30
 */

namespace App\Services\Common\Gateway\Queue\Channels\Push;


class FcmMessage
{
    private $title;
    private $body;
    private $with_topic;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    public function toArray()
    {
        return [
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'topic_name' => $this->getWithTopic()
        ];
    }

    /**
     * @return mixed
     */
    public function getWithTopic()
    {
        return $this->with_topic;
    }

    /**
     * @param mixed $with_topic
     */
    public function setWithTopic($with_topic): void
    {
        $this->with_topic = $with_topic;
    }
}