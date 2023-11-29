<?php

namespace App\Services\Common\Gateway\AspTransport;

use App\Services\Common\Helpers\Logger\Logger;
use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;

class AspTransport
{

    private $server_url;
    private $logger;
    public $log_name = 'ClassNotSet';
    public $session_id = null;
    public $response = null;

    public function __construct()
    {
        $this->server_url = config('queue_transporter.asp_callback_url');
        $this->logger = new Logger('asp_transport', 'ASP_TRANSPORT');
        $this->log_name = get_class($this);
    }

    public function sendRequest($data, $url = null)
    {

        if (empty($url)) {
            $url = $this->server_url;
        }

        $responseBody = null;
        $resultArray = null;

        $res = null;

        try {

            $client = new Client(); //Guzzle Client
            $this->session_id = Uuid::uuid4();

            $headers = [
                'Content-Type' => 'application/json; charset=UTF8;',
            ];

            $options = [
                'connect_timeout' => 30,
                //'headers' => $headers,
                'json' => $data,
            ];

            $log_params['Class'] = $this->log_name;
            $log_params['SessionId'] = $this->session_id;
            $log_params['RequestData'] = json_encode($data, JSON_UNESCAPED_UNICODE);
            $log_params['Url'] = $url;

            $this->logger->info('PARAMS - QUEUE BUS_TRANSPORT REQUEST --- session_id: '. $this->session_id.' --- class: '. $this->log_name , $log_params);

            $this->response = $client->post($url, $options);

            //$this->response = $client->request('POST', config('queue_transporter.queue_callback_url') , ['json' => $data]);

            if (!empty((string) $this->response->getBody()) && $this->response->getStatusCode() == 200) {
                $responseBody = (string) $this->response->getBody();

                $log_params['Class'] = $this->log_name;
                $log_params['SessionId'] = $this->session_id;
                $log_params['RequestData'] = json_encode($data, JSON_UNESCAPED_UNICODE);
                $log_params['Url'] = $url;
                $log_params['StatusCode'] = $this->response->getStatusCode();
                $log_params['ResponseData'] = $responseBody;

                $this->logger->info('SUCCESS - QUEUE BUS_TRANSPORT RESPONSE --- session_id: '. $this->session_id.' --- class: '. $this->log_name , $log_params);

                $res = $responseBody;
            } else {

                $responseBody = (string) $this->response->getBody();

                $log_params['Class'] = $this->log_name;
                $log_params['SessionId'] = $this->session_id;
                $log_params['RequestData'] = json_encode($data, JSON_UNESCAPED_UNICODE);
                $log_params['Url'] = $url;
                $log_params['StatusCode'] = empty($this->response)?:$this->response->getStatusCode();
                $log_params['ResponseData'] = $responseBody;

                $this->logger->info('WRONG - QUEUE BUS_TRANSPORT RESPONSE --- session_id: '. $this->session_id.' --- class: '. $this->log_name , $log_params);

                throw new \Exception();
            }

        } catch (\Throwable $e) {
            $log_params['Class'] = $this->log_name;
            $log_params['SessionId'] = $this->session_id;
            $log_params['RequestData'] = json_encode($data, JSON_UNESCAPED_UNICODE);
            $log_params['Url'] = $url;
            $log_params['StatusCode'] = empty($this->response)?:$this->response->getStatusCode();
            $log_params['ResponseData'] = $this->response;
            $log_params['ErrorMessage'] = $e->getMessage();
            $log_params['ErrorTraceData'] = $e->getTraceAsString();

            $this->errors = 'FATAL ERROR - QUEUE BUS_TRANSPORT RESPONSE --- session_id: '. $this->session_id.' --- class: '. $this->log_name  . json_encode($log_params);
            $this->logger->error('FATAL ERROR - QUEUE BUS_TRANSPORT RESPONSE --- session_id: '. $this->session_id.' --- class: '. $this->log_name , $log_params);

            throw $e;
        }

        return $res;

    }
}