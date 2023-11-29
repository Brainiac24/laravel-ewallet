<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 06.09.2018
 * Time: 11:38
 */

namespace App\Http\Controllers\Backend\Api\Consolidator;

use App\Http\Controllers\Controller;
use App\Services\Common\ArrayToXml;
use App\Services\Common\Gateway\Consolidator\ConsolidatorContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsolidatorController extends Controller
{
    protected $serverAnswerArray;
    protected $serverConfigIP;
    protected $http_status;
    protected $ConsolidatorTransport;

    public function __construct(ConsolidatorContract $ConsolidatorTransport)
    {
        $this->serverConfigIP = config('consolidator.server_ips');
        $this->serverAnswerArray = config('consolidator.result_array');
        $this->http_status = config('consolidator.default_http_status');
        $this->ConsolidatorTransport=$ConsolidatorTransport;
    }

    public function index(Request $request)
    {
        if (in_array($request->getClientIp(), $this->serverConfigIP)) {    // CHECK ALLOWED IP ADDRESS
            
            //IP ALLOWED AND START PROTOCOL
            //CHECKING FIELDS AND VALUES INSERTED
            $validation = $this->requestValidator($request->all());
            if ($validation[0] == false) {
                $this->serverAnswerArray['status'] = 1;
                $this->http_status = 200;
                $this->serverAnswerArray['msg'] = 'MISSING SOME VALUES. CHECK PROTOCOL.'. json_encode($validation[1]->errors());
                return response((ArrayToXml::convert($this->serverAnswerArray, 'xml')), $this->http_status, ['Content-Type' => 'application/xml']);
            }
            //REQUEST IS VALIDATED
            switch ($request->get('type', null)) {
                case 1:
                    $finalBackend= $this->ConsolidatorTransport->check($request->all());
                    $this->http_status = 200;
                    $this->serverAnswerArray['status'] = $finalBackend['status'];
                    $this->serverAnswerArray['msg'] = $finalBackend['msg'];
                    if(isset($finalBackend['client_status']) && isset($finalBackend['client_full_name'])) {
                        $this->serverAnswerArray['client_status'] = $finalBackend['client_status'];
                        $this->serverAnswerArray['client_full_name'] = $finalBackend['client_full_name'];
                    }
                    break;
                case 2:
                    $finalBackend= $this->ConsolidatorTransport->pay($request->all());
                    $this->http_status = 200;
                    $this->serverAnswerArray['status'] = $finalBackend['status'];
                    $this->serverAnswerArray['msg'] = $finalBackend['msg'];
                    break;
                default:
                    $this->serverAnswerArray['status'] = 1;
                    $this->http_status = 200;
                    $this->serverAnswerArray['msg'] = 'MISSING OR WRONG TYPE';
                    break;
            }
        } else {  //IP ADDRESS NOT ALLOWED
            $this->serverAnswerArray['status'] = 1;
            $this->http_status = 200;
            $this->serverAnswerArray['msg'] = 'Forbidden'. $request->getClientIp();
        }
        return response((ArrayToXml::convert($this->serverAnswerArray, 'xml')), $this->http_status, ['Content-Type' => 'application/xml']);
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
        $result[0] = false;
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
                $result[1] = $validator;
               return $result;
            }
            if ($this->isValidMd5($requestArray['key'])) {
                $result[0] = true;
                return $result;
            } else {
                $result[1] = $validator;
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