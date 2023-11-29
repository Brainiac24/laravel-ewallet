<?php

namespace App\Services\Common\Gateway\Queue;

interface QueueTransporterContract
{

    public function send(array $payload, $handler, $with_queue = true, $available_at = null);

}
