<?php

namespace App\Services\Common\Gateway\Queue;


interface QueueHashContract
{
    public function make($timestamp, array $payload);
    public function check($hash, $timestamp, array $payload);
}