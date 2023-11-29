<?php
/**
 * Created by PhpStorm.
 * User: Farrukh Kosimov
 * Date: 05.07.2018
 * Time: 13:47
 */

namespace App\Services\Common\Gateway\AbsCftEskhata;


class AbsCftEskahataRate extends AbsCftEskhata implements AbsCftEskhataRateContract
{
    protected $absMethod;
    protected $sendMethod;
    protected $reciveMethod;

    public function __construct()
    {
        parent::__construct();
        $this->sendMethod = self::R_GET_RATE;
        $this->reciveMethod = self::R_GET_RATE;
    }

    public function rGetRate($session_id, $date, $code_iso, $cur_iso, $type_rate)
    {
        $arguments = ['session_id' => (string)$session_id, 'date' => $date, 'code_iso' => $code_iso, 'cur_iso' => $cur_iso, 'type_rate' => $type_rate, 'protocol-version' => self::SERVER_PROTOCOL_VER, 'request-type' => (string)$this->sendMethod];
        $sendRequest = $this->sendRequest($arguments);
        $resultArray = ['session_id' => $session_id, 'protocol-version' => '', 'request-type' => '', 'state' => '', 'state_msg' => '', 'errorState' => '', 'errorMessage' => false];
        if (isset($sendRequest['response']['state']) && $sendRequest['response']['state'] == 1) {
            $resultArray['session_id'] = $sendRequest['head']['session_id'];
            $resultArray['protocol-version'] = $sendRequest['response']['protocol-version'];
            $resultArray['request-type'] = $sendRequest['response']['request-type'];
            $resultArray['state'] = $sendRequest['response']['state'];
            $resultArray['state_msg'] = $sendRequest['response']['state_msg'];
            $resultArray['errorMessage'] = '';
            $resultArray['request_uuid'] = $sendRequest['request_uuid'];
        } else {
            $resultArray['state_msg'] = $sendRequest['errorMessage'];
            $resultArray['errorMessage'] = $sendRequest['errorMessage'];
            $resultArray['request_uuid'] = $sendRequest['request_uuid'];
        }
        return $resultArray;
    }

    public function aGetRate($session_ids)
    {
        $resultArray = ['session_id' => $session_ids, 'protocol-version' => '', 'request-type' => '', 'date' => '', 'code_iso' => '', 'cur_iso' => '', 'rate' => '', 'sale' => '', 'buy' => '', 'state' => false, 'message' => '',];
        $sendRequest = $this->checkResult($session_ids);
        if (!isset($sendRequest['response']['state_msg'])) {
            if (isset($sendRequest['request']['state_msg'])) {
                $resultArray['message'] = $sendRequest['request']['state_msg'];
                $resultArray['session_id'] = $sendRequest['head']['session_id'];
                $resultArray['protocol-version'] = $sendRequest['request']['protocol-version'];
                $resultArray['request-type'] = $sendRequest['request']['request-type'];
                $resultArray['date'] = $sendRequest['request']['date'];
                $resultArray['code_iso'] = $sendRequest['request']['code_iso'];
                $resultArray['cur_iso'] = $sendRequest['request']['cur_iso'];
                $resultArray['rate'] = $sendRequest['request']['rate'];
                $resultArray['sale'] = $sendRequest['request']['sale'];
                $resultArray['buy'] = $sendRequest['request']['buy'];
                $resultArray['state_msg'] = $sendRequest['request']['state_msg'];
                $resultArray['state'] = true;
                $resultArray['request_uuid'] = $sendRequest['request_uuid'];
            } else {
                $resultArray['state'] = false;
                $resultArray['error_message'] = 'NON "REQUEST" METHOD IN REQUEST';
                $resultArray['request_uuid'] = $sendRequest['request_uuid'];
            }
        } else {
            if ($sendRequest['response']['request-type'] == self::A_GET_ANSWER) {
                $resultArray['state'] = false;
                $resultArray['error_message'] = $sendRequest['response']['state_msg'];
                $resultArray['request_uuid'] = $sendRequest['request_uuid'];
            } else {
                $resultArray['state'] = false;
                $resultArray['error_message'] = 'WRONG ANSWER TYPE SYSTEM WAITS FOR:' . $this->reciveMethod . ' GETS:' . $sendRequest['response']['request-type'];
                $resultArray['request_uuid'] = $sendRequest['request_uuid'];
            }
        }
        return $resultArray;
    }
}
