<?php

namespace App\Services\Common\Gateway\Queue;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Services\Common\Helpers\Logger\Logger;
use App\Exceptions\Frontend\Api\LogicException;

class QueueTransporter implements QueueTransporterContract
{

    protected $hash;
    protected $serverURL;
    protected $serverMethod;
    protected $logger;

    public function __construct(QueueHashContract $hash)
    {
        //Log::useDailyFiles();
        $this->logger = new Logger("queue/transport", 'transport');
        //Loading Configuration Data
        $this->serverURL = config('queue_transporter.smsRequestURL');
        $this->serverMethod = config('queue_transporter.smsRequestMethod');
        $this->hash = $hash;
    }

    /**
     * @param array $payload
     * @param $handler
     * @param bool $with_queue
     * @param null $available_at
     * @return mixed|null
     * @throws LogicException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(array $payload, $handler, $with_queue = true, $available_at = null)
    {
//        $this->changeLoggerHandler();

        $result = null;
        try {
            $client = new Client();
            $datetime = Carbon::now()->format('ymdHis');

            // удаляем параметры с null значениями, т.к. HttpGuzzle не отрпавляет эти данные, иначе будет проблема хэшем
            $payload = array_filter($payload, function ($value) {
                return !is_null($value);
            });

            if ($handler == QueueHandlerEnum::ACCOUNT_TO_ACCOUNT_SYNC || $handler == QueueHandlerEnum::ABS_CURRENCY_RATE || $handler == QueueHandlerEnum::PUSH_NOTIFICATION) {
                $this->serverURL = config('queue_transporter.smsRequestURLv2');
            }

            $response = $client->request($this->serverMethod, $this->serverURL, [
                'form_params' =>
                    [
                        'handler' => $handler,
                        'with_queue' => $with_queue,
                        'payload' => $payload,
                        'available_at' => $available_at ?? Carbon::now()->format('Y-m-d H:i:s'),
                        'hash' => $this->hash->make($datetime, $payload),
                        'datetime' => $datetime,
                    ],
            ]);

            $body = $response->getBody();

            $data = json_decode($body->getContents(), true);

            //Log::info($data);

            if ($data['success'] === false)
                $this->logger->error('[QueueTransporter] ' . json_encode($data));

            return $data;
        } catch (LogicException $e) {
            throw $e;
        } catch (\Exception $e) {
            $result['success'] = false;
            $this->logger->error('[QueueTransporter] ' . json_encode($payload, JSON_UNESCAPED_UNICODE) . '  ERROR:' . $e->getMessage());
        }
        return $result;
    }

}
