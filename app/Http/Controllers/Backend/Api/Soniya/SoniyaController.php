<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 06.09.2018
 * Time: 11:38
 */

namespace App\Http\Controllers\Backend\Api\Soniya;

use App\Http\Controllers\Controller;
use App\Services\Common\ArrayToXml;
use App\Services\Common\Gateway\Consolidator\ConsolidatorContract;
use App\Services\Common\Gateway\Soniya\SoniyaTransport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class SoniyaController extends Controller
{
    protected $serverAnswerArray;
    protected $serverConfigIP;
    protected $http_status;
    protected $ConsolidatorTransport;
    protected $soniyaTransport;

    public function __construct(SoniyaTransport $soniyaTransport)
    {
        $this->serverConfigIP = config('soniyaapi.server_ips');
        $this->serverAnswerArray = config('soniyaapi.result_array');
        $this->http_status = config('soniyaapi.default_http_status');
        $this->soniyaTransport=$soniyaTransport;
    }

    public function callBack(Request $request)
    {
       // Log::info('[REQUEST COME TO SONIYA_API] FROM:'.$request->ip().'  '.$request->getContentType(). '; Parsed to Array:'.json_encode($request->all()));
        if ($request->getContentType()=='xml'){
            $requestStr = (string)$request->getContent();
            $requestStr = iconv(mb_detect_encoding($requestStr, mb_detect_order(), true), "UTF-8", $requestStr);
            $requestStr= str_replace("<?xml version=1.0 encoding=utf-8?>",'', $requestStr);
            //$requestStr = str_replace('"',"",str_replace("\r\n",'',$requestStr));
            $requestStr = stripslashes($requestStr);
            $requestArray=[];
            try{
                $requestArray =  json_decode(json_encode(simplexml_load_string(html_entity_decode($requestStr), "SimpleXMLElement", LIBXML_NOCDATA)), true);
                $resultArray = ['head'=>['session_id'=>$requestArray['head']['session_id']],'response'=>['protocol-version'=>'1.00','request-type'=>'A_PAY_TRANSFER','state'=>1, 'state_msg'=>'Saved']];
            } catch (\Exception $e){
                Log::error('[REQUEST ERROR COME TO SONIYA_API]'.$e->getMessage().' REQUEST:'.$request->getContentType(). '='.$requestStr.'; Parsed to Array:'.json_encode($requestArray));
                echo $e->getMessage();
            }
            Log::info('[REQUEST COME TO SONIYA_API] FROM:'.$request->ip().'  '.$request->getContentType(). '='.$requestStr.'; Parsed to Array:'.json_encode($requestArray));
            //Log AND HARDCODE_ANSWER

            return response((ArrayToXml::convert($resultArray, 'root')), $this->http_status, ['Content-Type' => 'application/xml']);
        }
    }

    public function noob(Request $request)
    {
        // FOR NOOBS WHICH SEND GET , PUT or DELETE REQUEST
        if (in_array($request->getClientIp(), $this->serverConfigIP)) {
            $this->serverAnswerArray['status'] = 1;
            $this->http_status = 200;
            $this->serverAnswerArray['msg'] = 'PROTOCOL ERROR! NOT POST REQUEST SENT. YOU ARE SENDING GET REQUEST. BUT YOUR IP IS ALLOWED ';
        } else {
            $this->serverAnswerArray['status'] = 1;
            $this->http_status = 200;
            $this->serverAnswerArray['msg'] = 'Forbidden';
        }
        return response((ArrayToXml::convert($this->serverAnswerArray, 'xml')), $this->http_status, ['Content-Type' => 'application/xml']);
    }

    public function test(Request $request , $id = null)
    {
        $data = [
            'session_id' =>(string)Uuid::uuid4(),
            'request_type'=>'R_PAY_TRANSFER',
            'id_transaction'=>(string)Uuid::uuid4(),
            'family_cl'=>'Фамилия',
            'name_cl'=>'Имя',
            'sname_cl'=>'Отчество',
            'inn'=>'INN',
            'region_ref'=>17682384,
            'city_ref'=>289914554,
            'date_pers'=>'1987.10.23',
            'sex_ref'=>22911821,
            'doc_type_ref'=>10604024,
            'doc_date'=>'2012.11.23',
            'doc_num'=>'0033916',
            'doc_ser'=>'A',
            'doc_who'=>'ШКВД ш.Хучанд',
            'client_phone'=>'992927071111',
            'address'=>'Эшони Шайдо 36',
            'citizen_id'=>'Таджикистан',
            'receiver_family_cl'=>'Фамилия',
            'receiver_name_cl'=>'Имя',
            'receiver_sname_cl'=>'Отчество',
            'receiver_phone'=>'992927771111',
            'receiver_doc_num'=>'0000000',
            'receiver_doc_ser'=>'0000000',
            'summa_pay'=>987.45,
            'summa'=>900,
            'summa_komis'=>8,
            'currency_code'=>'TJS',
            'date_doc'=>'2014.12.03',
            'rate'=>4.75,
            'id_np'=>12,
        ];
        $result = $this->soniyaTransport->test($data, $id);
        dd($result);
    }

    protected function ruleCheck()
    {
        return [
            'type' => 'required|integer',
            'provid' => 'required|digits_between:1,10|numeric',
            'contractid' => 'required|digits_between:8,12|numeric',
            'date' => 'required|digits_between:10,14|numeric',
            'key' => 'required|max:32|alpha_num',
            'prove_num' => 'required|digits_between:4,4|numeric',
        ];
    }

    protected function rulePay()
    {
        return [
            'type' => 'required|integer',
            'provid' => 'required|digits_between:1,10|numeric',
            'contractid' => 'required|digits_between:8,12|numeric',
            'date' => 'required|digits_between:10,14|numeric',
            'key' => 'required|max:32|alpha_num',
            'summa' => 'required|numeric',
            'tranzid' => 'required|numeric',
        ];
    }


    public function requestValidator($requestArray)
    {
        $result = false;
        $validator = null;
        switch ($requestArray['type']) {
            case 1:
                $validator = Validator::make($requestArray, $this->ruleCheck());
                break;
            case 2:
                $validator = Validator::make($requestArray, $this->rulePay());
                break;
        }
        if ($validator !== null) {
            if ($validator->fails()) {
               return $result;
            }
            if ($this->isValidMd5($requestArray['key'])) {
                $result = true;
                return $result;
            } else {
                return $result;
            }
        }
        return $result;
    }

    public function isValidMd5($md5 = '')
    {
        return preg_match('/^[a-f0-9]{32}$/', $md5);
    }
}