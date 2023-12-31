<?php

namespace App\Services\Common\Gateway\Queue;

use App\Services\Common\Gateway\Queue\Exceptions\KeyNotFoundException;

class QueueHash implements QueueHashContract
{
    /**
     * @param $timestamp
     * @param array $payload
     * @return string
     * @throws KeyNotFoundException
     */
    public function make($timestamp, array $payload)
    {
        $key = config('queue_transporter.key');

        if (empty($key))
            throw new KeyNotFoundException('Key queue transport not found');

        //\Log::error(sprintf('%s:%s:%s', $timestamp, json_encode($payload), $key));

        return strtolower(hash('sha256', sprintf('%s:%s:%s', $timestamp, json_encode($payload), $key)));
    }

    /**
     * @param $hash
     * @param $timestamp
     * @param array $payload
     * @return bool
     * @throws KeyNotFoundException
     */
    public function check($hash, $timestamp, array $payload)
    {
        return $hash === $this->make($timestamp, $payload);
    }
}