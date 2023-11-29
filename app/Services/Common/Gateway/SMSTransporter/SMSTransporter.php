<?php
/**
 * Created by PhpStorm.
 * User: Farrukh Kosimov
 * Date: 04.07.2018
 * Time: 16:28
 */

namespace App\Services\Common\Gateway\SMSTransporter;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class SMSTransporter implements SMSTransporterContract
{
    protected $serverURL;
    protected $serverMethod;
    protected $autoReplaceAnswer;

    public function __construct()
    {
        //Loading Configuration Data
        $this->serverURL = config('smstransporter.smsRequestURL');
        $this->serverMethod = config('smstransporter.smsRequestMethod');
        $this->autoReplaceAnswer = config('smstransporter.autoreplaceAnswer');
    }

    public function send($to, $text)
    {
        $uuid = 'SMSRequest_'.(string)Uuid::uuid4();
        $result = [$to, $text, 'sms_accept_result' => false, 'message_id' => 0, 'message_error' => ''];
        try {
            $client = new Client();
            $fullURL = sprintf('%s?n=%s&m=%s', $this->serverURL, $to, $text);
            //SEND REQUEST
            $res = $client->request($this->serverMethod, $fullURL);
            $resultStr = (string)$res->getBody();
            if ($res->getStatusCode() == 200 && strpos($resultStr, $this->autoReplaceAnswer) !== false) {
                $result['sms_accept_result'] = true;
                $result['message_id'] = str_replace($this->autoReplaceAnswer, '', $resultStr);
                $result['request_uuid'] = $uuid;
                Log::info('[SUCCESS SMS Sended] ' . $uuid . ' To = ' . $to . ' USING TEXT:' . $text);
            }
        } catch (\Exception $e) {
            $result['error_message'] = $e->getMessage();
            $result['request_uuid'] = $uuid;
            Log::error('[EMERGENCY MODULE SMSTransporter] ' . $uuid . '  ERROR:' . $e->getMessage());
        }
        return $result;
    }

    public function check($message_id)
    {
        return ['message_id' => $message_id, 'succes_result' => true, 'request_uuid'=> 'SMSRequest_'.(string)Uuid::uuid4() ];
    }
}