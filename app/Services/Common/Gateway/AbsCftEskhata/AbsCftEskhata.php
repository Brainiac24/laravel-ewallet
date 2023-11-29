<?php

/**
 * Course updater class
 * Autor: Farrukh Kosimov
 * 04/07/2018  13:08:00
 */

namespace App\Services\Common\Gateway\AbsCftEskhata;

use GuzzleHttp\Psr7\Request;
use App\Services\Common\ArrayToXml;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class AbsCftEskhata
{
    protected $server_url;
    protected const SERVER_PROTOCOL_METHOD = 'POST';
    protected const A_GET_RATE = 'A_GET_RATE';
    protected const R_GET_RATE = 'R_GET_RATE';
    protected const A_GET_ANSWER = 'A_GET_ANSWER';
    protected const R_GET_ANSWER = 'R_GET_ANSWER';
    protected const PRIMARY_XML_CONTAINER = 'root';
    protected const SERVER_PROTOCOL_VER = '1.00';

    public function __construct()
    {
        $this->server_url = config('abscfteskhata.server_url');
    }

    protected function sendRequest($data)
    {
        $head = [];
        $request = [];
        foreach ($data as $key_name => $key_value) {
            if ($key_name == 'session_id' || $key_name == 'application_key') {
                $head[$key_name] = $key_value;
            } else {
                $request[$key_name] = $key_value;
            }
        }
        $root = ['head' => $head, 'request' => $request];
        $xml = ArrayToXml::convert($root, ['rootElementName' => self::PRIMARY_XML_CONTAINER]);
        return $this->sendHTTPRequest($xml);
    }

    protected function checkResult($session_id)
    {
        $root = ['head' => ["session_id" => $session_id], 'request' => ["protocol-version" => self::SERVER_PROTOCOL_VER, "request-type" => self::R_GET_ANSWER,]];
        $xml = ArrayToXml::convert($root, ['rootElementName' => self::PRIMARY_XML_CONTAINER]);
        return $this->sendHTTPRequest($xml);
    }

    private function sendHTTPRequest($xml)
    {
        $uuid = 'ABSRequest_'.(string)Uuid::uuid4();
        // SEND HTTP REQUEST
        try {
            $client = new \GuzzleHttp\Client();
            $request = new Request(self::SERVER_PROTOCOL_METHOD, $this->server_url, ['Content-Type' => 'application/xml; charset=UTF8; verify=true'], $xml);
            $response = $client->send($request);
            $resultArray = json_decode(json_encode(simplexml_load_string((string)$response->getBody()->getContents(), "SimpleXMLElement", LIBXML_NOCDATA)), true);
            $resultArray['errorState'] = 0;
            $resultArray['errorMessage'] = 'NO ERROR';
            $resultArray['request_uuid'] = $uuid;
            Log::error('[INFO MODULE ABS_TRANSMISSION] '.$uuid.'  Data sent! XML='.$xml);
            return $resultArray;
        } catch (\Exception $e) {
            $resultArray['errorMessage'] = $e->getMessage();
            $resultArray['errorState'] = -1;
            $resultArray['request_uuid'] = $uuid;
            Log::error('[EMERGENCY MODULE ABS_TRANSMISSION_MODULE] '.$uuid.' ' . $e->getMessage());
            return $resultArray;
        }
    }
}
