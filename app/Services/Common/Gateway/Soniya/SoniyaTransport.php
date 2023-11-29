<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 31.08.2018
 * Time: 13:34
 */

namespace App\Services\Common\Gateway\Soniya;


use App\Services\Common\ArrayToXml;
use GuzzleHttp\Psr7\Request;

class SoniyaTransport implements SoniyaContract
{
    protected $REQUEST_R_CONFIRM_OUTPUT = [];
    protected $http_status;
    protected $server_url;

    public function __construct()
    {
        $this->REQUEST_R_CONFIRM_OUTPUT = config('soniyaapi.REQUEST_R_CONFIRM_OUTPUT');
        $this->http_status = 200;
        $this->server_url = config('soniyaapi.server_out_ips');
    }

    public function pay($data)
    {
        echo $this->REQUEST_R_CONFIRM_OUTPUT;
    }

    public function check($data)
    {

    }

    public function test($data, $user_id)
    {
        $result_array = $this->REQUEST_R_CONFIRM_OUTPUT;
        $result_array['head']['session_id'] = $data['session_id'];
        $result_array['head']['application_key'] = config('soniyaapi.applicationCallBackURL');
        $result_array['request']['protocol-version'] = config('soniyaapi.server_protocol_version');
        $result_array['request']['login'] = config('soniyaapi.server_login');
        $result_array['request']['password'] = config('soniyaapi.server_password');
        $result_array['request']['point_id'] = config('soniyaapi.server_point_id');
        $result_array['request']['user_id'] = config('soniyaapi.server_user_id');
        $result_array['request']['key'] = config('soniyaapi.server_secret_key');
        $result_array['request']['request-type'] = $data['request_type'];
        $result_array['request']['id_transaction'] = $data['id_transaction'];
        $result_array['request']['date_doc'] = $data['request_type'];
        $result_array['request']['family_cl'] = $data['family_cl'];
        $result_array['request']['name_cl'] = $data['name_cl'];
        $result_array['request']['sname_cl'] = $data['sname_cl'];
        $result_array['request']['inn'] = $data['inn'];
        $result_array['request']['region_ref'] = $data['region_ref'];
        $result_array['request']['date_pers'] = $data['date_pers'];
        $result_array['request']['sex_ref'] = $data['sex_ref'];
        $result_array['request']['doc']['type_ref'] = $data['doc_type_ref'];
        $result_array['request']['doc']['date'] = $data['doc_date'];
        $result_array['request']['doc']['num'] = $data['doc_num'];
        $result_array['request']['doc']['ser'] = $data['doc_ser'];
        $result_array['request']['doc']['who'] = $data['doc_who'];
        $result_array['request']['client_phone'] = $data['client_phone'];
        $result_array['request']['address'] = $data['address'];
        $result_array['request']['citizen_id'] = $data['citizen_id'];
        $result_array['request']['receiver']['family_cl'] = $data['receiver_family_cl'];
        $result_array['request']['receiver']['name_cl'] = $data['receiver_name_cl'];
        $result_array['request']['receiver']['sname_cl'] = $data['receiver_sname_cl'];
        $result_array['request']['receiver']['receiver_phone'] = $data['receiver_phone'];
        $result_array['request']['receiver']['doc_num'] = $data['receiver_doc_num'];
        $result_array['request']['receiver']['doc_ser'] = $data['receiver_doc_ser'];
        $result_array['request']['summa_pay'] = $data['summa_pay'];
        $result_array['request']['summa'] = $data['summa'];
        $result_array['request']['summa_komis'] = $data['summa_komis'];
        $result_array['request']['currency_code'] = $data['currency_code'];
        $result_array['request']['date_doc'] = $data['date_doc'];
        $result_array['request']['rate'] = $data['rate'];
        $result_array['request']['id_np'] = $data['id_np'];
        $this->REQUEST_R_CONFIRM_OUTPUT = $result_array;
        $returnData = [];
        $transport = [];
        $returnData['request'] = $this->REQUEST_R_CONFIRM_OUTPUT;
        try {
            $xml = ArrayToXml::convert($this->REQUEST_R_CONFIRM_OUTPUT, ['rootElementName' => config('soniyaapi.xmlDefaultRoot')]);
            $clientHttp = new \GuzzleHttp\Client();
            $request = new Request('post', $this->server_url, ['Content-Type' => 'application/xml; charset=UTF8; verify=true'], $xml);
            $response = $clientHttp->send($request);
            $requestResultArray = json_decode(json_encode(simplexml_load_string((string)$response->getBody()->getContents(), "SimpleXMLElement", LIBXML_NOCDATA)), true);
            $returnData['response'] = $requestResultArray;
            $transport['status'] = $requestResultArray['response']['state'];
            $transport['message'] = $requestResultArray['response']['state_msg'];
        } catch (\Exception $e) {
            $transport['status'] = -1;
            $transport['message'] = $e->getMessage();
        }
        $returnData['transport'] = $transport;
        return $returnData;
    }
}
