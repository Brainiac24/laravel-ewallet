<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 06.07.2018
 * Time: 15:56
 */

namespace App\Services\Common\Gateway\Processing;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class ProcessingTransport implements ProcessingTransportContract
{
    protected $processing_server_url;
    protected $processing_point_id;
    protected $processing_user_name;
    protected $processing_user_password;
    protected $valid_answers;
    protected $answers = [];
    protected $commands = [];
    protected $processing_user_authentication_method;
    protected $processing_server_method;
    protected $resultArray = [];

    public function __construct()
    {
        // Initialize variables
        $this->processing_server_url = config('processingconf.processing_server_url');
        $this->processing_point_id = config('processingconf.processing_point_id');
        $this->processing_user_name = config('processingconf.processing_user_name');
        $this->processing_user_password = config('processingconf.processing_user_password');
        $this->valid_answers = config('processingconf.valid_answers');
        $this->processing_server_method = config('processingconf.processing_server_method');
        $this->answers = config('processingconf.answers');
    }

    public function pay($txn_id, $sum, $prv_id, $number)
    {
        $fullURL = sprintf('%s?txn_id=%s&sum=%s&prv_id=%s&NUMBER=%s&point_id=%s&command=pay', $this->processing_server_url, $txn_id, $sum, $prv_id, $number, $this->processing_point_id);
        $result = $this->sendRequest($fullURL);
        $resultArray = [];
        if (isset($this->answers[$result['result']])) {
            $resultArray['txn_id'] = $result['osmp_txn_id'];
            $txn_id = $result['osmp_txn_id'];
            $resultArray['message'] = $this->answers[$result['result']]['message'];
            $resultArray['private_state_id'] = $this->answers[$result['result']]['private_state_id'];
            $resultArray['requested_txn'] = $txn_id;
            $resultArray['request_uuid'] = $result['request_uuid'];
            if (isset($result['extra_info'])) {
                $resultArray['info'] = $result['extra_info'];
            } else {
                $resultArray['info'] = [];
            }
            $resultArray['response'] = $result['responced_xml'];
            $resultArray['request'] = $fullURL;
            if ($result['result'] != 0) {
                $resultArray['state'] = (bool)false;
                $resultArray['private_state_id'] = 3;
                $resultArray['request_uuid'] = $result['request_uuid'];
            } else {
                $resultArray['state'] = (bool)true;
                $resultArray['request_uuid'] = $result['request_uuid'];
            }
        } else {
            $resultArray['message'] = 'UNKNOWN ANSWER CODE';
            $resultArray['state'] = (bool)false;
            $resultArray['private_state_id'] = 3;
            $resultArray['request_uuid'] = $result['request_uuid'];
        }
        return $resultArray;
    }


    public function check($txn_id, $sum, $prv_id, $number)
    {
        $fullURL = sprintf('%s?txn_id=%s&sum=%s&prv_id=%s&NUMBER=%s&point_id=%s&command=check', $this->processing_server_url, $txn_id, $sum, $prv_id, $number, $this->processing_point_id);
        $resultArray = [];
        $result = $this->sendRequest($fullURL);
        if (isset($this->answers[$result['result']])) {
            $resultArray['txn_id'] = $result['osmp_txn_id'];
            $resultArray['message'] = $this->answers[$result['result']]['message'] . '. ' . $result['comment'];
            $resultArray['private_state_id'] = $this->answers[$result['result']]['private_state_id'];
            $resultArray['requested_txn'] = $txn_id;
            $resultArray['request_uuid'] = $result['request_uuid'];
            if (isset($result['extra_info'])) {
                $resultArray['info'] = $result['extra_info'];
                $resultArray['request_uuid'] = $result['request_uuid'];
            } else {
                $resultArray['info'] = [];
                $resultArray['request_uuid'] = $result['request_uuid'];
            }
            $resultArray['response'] = $result['responced_xml'];
            $resultArray['request'] = $fullURL;
            $resultArray['request_uuid'] = $result['request_uuid'];
            if ($result['result'] != 0) {
                $resultArray['state'] = (bool)false;
                $resultArray['request_uuid'] = $result['request_uuid'];
            } else {
                $resultArray['state'] = (bool)true;
                $resultArray['request_uuid'] = $result['request_uuid'];
            }
        } else {
            $resultArray['message'] = 'UNKNOWN ANSWER CODE';
            $resultArray['state'] = (bool)false;
            $resultArray['private_state_id'] = 3;
            $resultArray['request_uuid'] = $result['request_uuid'];
        }
        return $resultArray;
    }

    public function status($txn_id, $sum, $prv_id, $number)
    {
        $fullURL = sprintf('%s?txn_id=%s&sum=%s&prv_id=%s&NUMBER=%s&point_id=%s&command=pay&getstatus=1', $this->processing_server_url, $txn_id, $sum, $prv_id, $number, $this->processing_point_id);
        $result = $this->sendRequest($fullURL);
        $resultArray = [];
        if (isset($this->answers[$result['result']])) {
            $resultArray['txn_id'] = $result['osmp_txn_id'];
            $resultArray['message'] = $this->answers[$result['result']]['message'];
            $resultArray['private_state_id'] = $this->answers[$result['result']]['private_state_id'];
            $resultArray['requested_txn'] = $txn_id;
            $resultArray['request_uuid'] = $result['request_uuid'];
            if (isset($result['extra_info'])) {
                $resultArray['info'] = $result['extra_info'];
            } else {
                $resultArray['info'] = [];
            }
            $resultArray['response'] = $result['responced_xml'];
            $resultArray['request'] = $fullURL;
            $resultArray['request_uuid'] = $result['request_uuid'];
            if ($result['result'] != 0) {
                $resultArray['state'] = (bool)false;
                $resultArray['private_state_id'] = 3;
                $resultArray['request_uuid'] = $result['request_uuid'];
            } else {
                $resultArray['state'] = (bool)true;
                $resultArray['request_uuid'] = $result['request_uuid'];
            }
        } else {
            $resultArray['message'] = 'UNKNOWN ANSWER CODE';
            $resultArray['state'] = (bool)false;
            $resultArray['private_state_id'] = 3;
            $resultArray['request_uuid'] = $result['request_uuid'];
        }
        return $resultArray;
    }

    private function sendRequest($requestStr)
    {
        $uuid = 'ProcRequest_' . (string)Uuid::uuid4();
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request($this->processing_server_method, $requestStr, ['auth' => [$this->processing_user_name, $this->processing_user_password]]);
            Log::info('[INFO MODULE Processing]: ' . $uuid . ' Send Request:' . $requestStr);
            $resultArray = json_decode(json_encode(simplexml_load_string((string)$response->getBody(), "SimpleXMLElement", LIBXML_NOCDATA)), true);
            Log::info('[INFO MODULE Processing]: ' . $uuid . ' GET  RESPONSE: ' . (string)$response->getBody());
            $resultArray['responced_xml'] = (string)$response->getBody();
            $resultArray['request_uuid'] = $uuid;
            return $resultArray;
        } catch (\Exception $e) {
            $resultError = ['message' => $e->getMessage(), 'state' => false, 'private_state_id' => 1, 'responce' => ''];
            $resultArray['request_uuid'] = $uuid;
            Log::error('[EMERGENCY MODULE Processing] ' . $uuid . $e->getMessage());
            return $resultError;
        }
    }

}