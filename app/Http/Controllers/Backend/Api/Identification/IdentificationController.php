<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 06.09.2018
 * Time: 11:38
 */

namespace App\Http\Controllers\Backend\Api\Identification;

use App\Http\Controllers\Controller;
use App\Services\Common\ArrayToXml;
use App\Services\Common\Gateway\Identification\IdentificationTransport;
use App\Services\Common\Helpers\Identification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class IdentificationController extends Controller
{
    protected $serverAnswerArray;
    protected $serverConfigIP;
    protected $serverConfigSecretKey;
    protected $serverConfigLogin;
    protected $http_status;
    protected $currentUser;
    protected $identification;
    protected $xml_root_element;
    protected $content_type;
    protected $user;

    public function __construct(IdentificationTransport $identification)
    {
        $this->serverConfigIP = config('soniyaapi.server_ips');
        $this->serverConfigSecretKey = config('soniyaapi.server_secret_key');
        $this->serverConfigLogin = config('soniyaapi.server_login');
        $this->serverAnswerArray = config('soniyaapi.result_array');
        $this->http_status = config('soniyaapi.default_http_status');
        $this->xml_root_element = config('soniyaapi.default_xml_root_element');
        $this->content_type = config('soniyaapi.content_type');
        $this->identification = $identification;
    }

    public function index(Request $request)
    {
        try {
            //CHECK ALLOWED IP ADDRESS
            if (!in_array($request->getClientIp(), $this->serverConfigIP)) {
                $this->serverAnswerArray = config('soniyaapi.result_forbidden');
                return $this->responseResult($this->serverAnswerArray, $this->xml_root_element, $this->http_status, $this->content_type);
            }
            //IP ALLOWED
            $checkValidation = $this->requestValidator($request->all());
            if ($checkValidation['result'] != true) {
                //dd(123);
                $this->serverAnswerArray['status'] = Identification::VALIDATION_EXCEPTION;
                $resultMessage = '';
                foreach ($checkValidation['data'] as $key => $value) {
                    $resultMessage = $resultMessage . ';' . $value;
                }
                $this->serverAnswerArray['message'] = 'VALIDATION ERROR. CHECH PARAMS.' . $resultMessage;
                return $this->responseResult($this->serverAnswerArray, $this->xml_root_element, $this->http_status, $this->content_type);
            }
            //REQUEST VALIDATED
            if (!$this->isValidSha256($request->hash)) {
                $this->serverAnswerArray['status'] = Identification::OTHER_EXCEPTION;
                $this->serverAnswerArray['message'] = 'UNKNOWN HASH TYPE. CHECK PROTOCOL';
                return $this->responseResult($this->serverAnswerArray, $this->xml_root_element, $this->http_status, $this->content_type);
            }
            $RemoteHash = "";
            switch ($request->type) {
                case 1:
                    //HASH_CHECK_FORMULA = sha256(SECRET+MSISDN+TYPE+LOGIN+ REMOTE_USER_ID)
                    $RemoteHash = $this->sha256($this->serverConfigSecretKey . $request->msisdn . $request->type . $request->login . $request->remote_user_id);
                    break;
                case 2:
                    //HASH_IDENTIFICATE_FORMULA = sha256(SECRET+USER_ID+TYPE+LOGIN+ REMOTE_USER_ID+ DAY_BIRTH+ DOCUMENT_NUMBER+ CITIZENSHIP)
                    $RemoteHash = $this->sha256($this->serverConfigSecretKey . $request->user_id . $request->type . $request->login . $request->remote_user_id . $request->DATE_BIRTH . $request->DOCUMENT_NUMBER . $request->CITIZENSHIP);
                    break;
            }
            //HASH MISMATCH
            if ($RemoteHash != $request->hash) {
                $this->serverAnswerArray['status'] = Identification::HASH_MISMATCH_EXCEPTION;
                $this->serverAnswerArray['message'] = 'HASH MISMATCH. CHECK LOGIN AND PASSWORD';
                if (\App::environment('local')) {
                    $this->serverAnswerArray['HASH_MUST_BE'] = $RemoteHash;
                }
                return $this->responseResult($this->serverAnswerArray, $this->xml_root_element, $this->http_status, $this->content_type);
            }
            //HASH IS VALID
            if ($this->serverConfigLogin != $request->login) {
                //WRONG LOGIN
                $this->serverAnswerArray['status'] = Identification::HASH_MISMATCH_EXCEPTION;
                $this->serverAnswerArray['message'] = 'WRONG LOGIN OR PASSWORD';
                if (\App::environment('local')) {
                    $this->serverAnswerArray['HASH_MUST_BE'] = $RemoteHash;
                }
                return $this->responseResult($this->serverAnswerArray, $this->xml_root_element, $this->http_status, $this->content_type);
            }

            //LOGIN IS VALID
            switch ($request->type) {
                case 1:
                    //CHECH NUMBER
                    $result = $this->identification->check($request);
                    $this->serverAnswerArray['status'] = $result['status'];
                    $this->serverAnswerArray['message'] = $result['message'];
                    $this->serverAnswerArray['data'] = $result['data'];
                    return $this->responseResult($this->serverAnswerArray, $this->xml_root_element, $this->http_status, $this->content_type);
                    break;
                case 2:
                    //IDENTIFICATE
                    $result = $this->identification->identificate($request);
                    $this->serverAnswerArray['status'] = $result['status'];
                    $this->serverAnswerArray['message'] = $result['message'];
                    $this->serverAnswerArray['data'] = $result['data'];
                    return $this->responseResult($this->serverAnswerArray, $this->xml_root_element, $this->http_status, $this->content_type, false);
                    break;
                default:
                    $this->serverAnswerArray['status'] = Identification::OTHER_EXCEPTION;
                    $this->serverAnswerArray['message'] = 'UNKNOWN TYPE. CHECK PROTOCOL';
                    return $this->responseResult($this->serverAnswerArray, $this->xml_root_element, $this->http_status, $this->content_type);
                    break;
            }
        } catch (\Throwable $e) {
            //dd(123);
            return $this->responseResult($this->serverAnswerArray, $this->xml_root_element, $this->http_status, $this->content_type, true, $e->getMessage() . '----' . $e->getTraceAsString());
        }

    }

    public function responseResult($serverAnswerArray, $xml_root_element, $http_status, $content_type, $is_log = true, $exception = '')
    {
        if ($is_log) {
            Log::error('[Identification Transport Error]: ' . json_encode($serverAnswerArray) . '----' . $exception);
        }
        return response((ArrayToXml::convert($this->serverAnswerArray, $this->xml_root_element)), $this->http_status, $this->content_type);
    }

    public function noob(Request $request)
    {
        // FOR NOOBS WHICH SEND GET , PUT or DELETE REQUEST
        if (in_array($request->getClientIp(), $this->serverConfigIP)) {
            $this->serverAnswerArray['status'] = Identification::OTHER_EXCEPTION;
            $this->serverAnswerArray['message'] = 'PROTOCOL ERROR! POST REQUEST EXPECTED.';
        } else {
            $this->serverAnswerArray['status'] = Identification::OTHER_EXCEPTION;
            $this->serverAnswerArray['message'] = '403 Forbidden.';
        }
        return response((ArrayToXml::convert($this->serverAnswerArray, $this->xml_root_element)), $this->http_status, $this->content_type);
    }

    protected function ruleCheck()
    {
        return [
            'type' => 'required|integer',
            'login' => 'required|string',
            'msisdn' => 'required|digits:12|numeric',
            'hash' => 'required|size:64|alpha_num',
            'remote_user_id' => 'required|numeric',
        ];
    }

    protected function ruleIdentificate()
    {
        return [
            'type' => 'required|integer',
            'login' => 'required|string',
            'user_id' => 'required|alpha_dash',
            'hash' => 'required|size:64|alpha_num',
            'remote_user_id' => 'required|numeric',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'required|string',
            'date_birth' => 'required|date',
            'inn' => 'numeric|digits_between:9,11|nullable',
            'document_type_id' => 'required|alpha_dash|exists:document_types,code_map',//Проверить на exist id
            'document_number' => 'string|regex:/^[A-Za-zА-Яа-яЁё]{1,4}[0-9]{7,12}$/|required',
            'document_inspected_by' => 'string|required',
            'document_inspected_at' => 'date|required',
            'country_id' => 'numeric|required|exists:countries,code_map', //Проверить на exist id
            'country_born_id' => 'numeric|required|exists:countries,code_map',//Проверить на exist id
            'region_id' => 'numeric|required|exists:regions,code_map',//Проверить на exist id
            'area_id' => 'numeric|required|exists:areas,code_map',//Проверить на exist id
            'city_id' => 'numeric|required|exists:city,code_map',//Проверить на exist id
            'street' => 'string|required',
            'house' => 'string|required',
            'flat' => 'string|required',
            'gender' => 'string|required',
        ];
    }

    public function requestValidator($requestArray)
    {
        $result = ['result' => false, $data = []];
        $validator = null;
        switch ($requestArray['type']) {
            case 1:
                $validator = Validator::make($requestArray, $this->ruleCheck());
                break;
            case 2:
                $validator = Validator::make($requestArray, $this->ruleIdentificate());
                break;
        }
        if ($validator !== null) {
            if ($validator->fails()) {

                return ['result' => false, 'data' => $validator->errors()->all()];
            } else {
                return ['result' => true, 'data' => []];
            }
        }
        return $result;
    }

    public function isValidSha256($sha256 = '')
    {
        return preg_match('/^[a-f0-9]{64}$/', $sha256);
    }

    public function sha256($text)
    {
        return hash('sha256', $text);
    }
}
