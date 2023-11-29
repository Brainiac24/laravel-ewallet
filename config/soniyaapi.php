<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 04.07.2018
 * Time: 13:33
 */

return [
    'server_ips' => ['10.10.2.54','127.0.0.1','192.168.6.129','192.168.88.47','::1'],
    'server_out_ips' => '10.10.2.54:5556',
    'server_login'=>'SERVICEMIXUSER_SONIY',
    'server_password'=>'123456',
    'server_point_id'=>'6911984270',
    'server_user_id'=>'362003388',
    'server_protocol_version'=>'1.00',
    'server_secret_key'=>'K2+altQV5TSgJVFxwJShem/2k6AqhUBl8v4gsrSkDAk=',
    'applicationCallBackURL'=>'192.168.6.129:80/api/v1/soniyacallback##',
    'default_http_status'=>200,
    'default_xml_root_element'=>'response',
    'content_type'=>['Content-Type' => 'application/xml'],
    'default_http_status'=>200,
    'request_method'=>'post',
    'xmlDefaultRoot'=>'root',
    'result_array'=>[
        'status'=>-4,
        'message'=>'Request params not set',
        'data'=>[]
    ],
    'result_forbidden'=>[
        'status'=>-4,
        'message'=>'403 Forbidden.',
        'data'=>[]
    ],
    'REQUEST_R_CONFIRM_OUTPUT'=>[
        'head'=>['session_id'=>'', 'application_key'=>''],
        'request'=>[
            'protocol-version'=>'1.00',     /*DONE*/
            'request-type'=>'R_CONFIRM_OUTPUT',  /*DONE*/
            'id_transaction'=>0,  /*DONE*/
            'family_cl'=>'',  /*DONE*/
            'name_cl'=>'',   /*DONE*/
            'sname_cl'=>'', /*DONE*/
            'inn'=>'', /*DONE*/
            'region_ref'=>17682384,  /*DONE*/
            'city_ref'=>17682390,   /*DONE*/
            'date_pers'=>(string)\Illuminate\Support\Carbon::now()->format('Y.m.d'),
            'sex_ref'=>22911821,
            'doc'=>[
                'type_ref'=>10604024,
                'date'=>(string)\Illuminate\Support\Carbon::now()->format('Y.m.d'),
                'num'=>'',
                'ser'=>'',
                'who'=>''
            ],
            'client_phone'=>'',
            'address'=>'',
            'citizen_id'=>'',
            'receiver'=>[
                        'family_cl'=>'',
                        'name_cl'=>'',
                        'sname_cl'=>'',
                        'receiver_phone'=>'',
                        'doc_num'=>'',
                        'doc_ser'=>'',
                        ],
            'summa_pay'=>0,
            'summa'=>0,
            'summa_komis'=>0,
            'currency_code'=>'TJS',
            'date_doc'=>(string)\Illuminate\Support\Carbon::now()->format('Y.m.d'),
            'rate'=>4.75,
            'id_np'=>12,
            'user_id'=>'',
            'point_id'=>'',

        ]
    ],
    'ANSWER_A_CONFIRM_OUTPUT'=>[
        'head'=>['session_id'=>''],
        'response'=>[
            'protocol-version'=>'1.00',
            'request-type'=>'A_CONFIRM_OUTPUT',
            'state'=>1,
            'state_msg'=>''
        ]
    ]
];