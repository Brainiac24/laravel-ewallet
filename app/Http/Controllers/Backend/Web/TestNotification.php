<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 19.07.2018
 * Time: 14:50
 */

namespace App\Http\Controllers\Backend\Web;

use App\Http\Controllers\Controller;
use App\Models\User\User;


class TestNotification extends Controller
{
     public function testFirebase()
    {
        $messageToSend = ['title' => 'Laravel Dynamic Message', 'message' => 'Laravel Dynamic Message', 'UUID' => 'Laravel Dynamic Message', 'user_id' => '46ff63db-a077-11e8-904b-b06ebfbfa715', 'click_action' => 'Laravel Dynamic Message', 'param1' => 'Laravel Dynamic Message'];
        $result = User::SendPushNotification($messageToSend);
        print_r($result);
        echo '<-------------------------------------------- CHECK  RESULT ----------------------------------->';
    }

    public function testSMS()
    {
        $rate = new \App\Services\Common\Gateway\SMSTransporter\SMSTransporter();
        $res = $rate->send('992927071111', 'Тестовые данные прошли');
        echo '<-------------------------------------------- CHECK  RESULT ----------------------------------->';
        print_r($res);

    }

    public function testProcessing()
    {
        $rate = new \App\Services\Common\Gateway\Processing\ProcessingTransport();
        $result = $rate->pay('18070910170100009', 1.00, '18257', 'accountnotvalid');
        echo "<-------------------------------------------- REGISTER REQUEST processing ----------------------------------->\n";
        print_r($result);
        echo '<-------------------------------------------- CHECK  RESULT ----------------------------------->';
    }
    public function testProcessing2()
    {
        $rate = new \App\Services\Common\Gateway\Processing\ProcessingTransport();
        $result = $rate->check('18070910170100009', 1.00, '18257', 'permanentfailure');
        echo "<-------------------------------------------- check  REQUEST processing ----------------------------------->\n";
        print_r($result);
        echo '<-------------------------------------------- CHECK  RESULT ----------------------------------->';
    }
    public function testProcessing3()
    {
        $rate = new \App\Services\Common\Gateway\Processing\ProcessingTransport();
        $result = $rate->status('18070910170100009', 1.00, '18257', 'permanentfailure');
        echo "<-------------------------------------------- status REQUEST processing  ----------------------------------->\n";
        print_r($result);
    }
    public function testABSrGet()
    {
        $rate = new \App\Services\Common\Gateway\AbsCftEskhata\AbsCftEskahataRate();
        $result = $rate->rGetRate((string)'eOnline_' . \Ramsey\Uuid\Uuid::uuid4(), '2018.07.06', '840', 'USD', 'nbt');
        echo '<-------------------------------------------- REGISTER REQUEST ABS ----------------------------------->';
        print_r($result);
    }
    public function testABSaGet()
    {
        $rate = new \App\Services\Common\Gateway\AbsCftEskhata\AbsCftEskahataRate();
        $esult = $rate->aGetRate('eOnline_3bb06483-ff53-4bc9-9283-b112a454947e');
        echo '<-------------------------------------------- CHECK  RESULT ----------------------------------->';
        print_r($esult);
        echo 'test';
    }
}