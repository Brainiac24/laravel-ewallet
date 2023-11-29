<?php

namespace App\Http\Controllers\Backend\Web\Order\RemoteIdentification;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Requests\Backend\Web\Order\RemoteIdentification\UpdateHistoryCallRemoteIdentificationRequest;
use App\Repositories\Backend\Order\OrderComment\OrderCommentRepositoryContract;
use App\Repositories\Backend\Order\OrderHistory\OrderHistoryRepositoryContract;
use App\Repositories\Backend\Order\OrderProcessStatus\OrderProcessStatusRepositoryContract;
use App\Repositories\Backend\Order\OrderStatus\OrderStatusRepositoryContract;
use App\Repositories\Backend\User\Attestation\AttestationRepositoryContract;
use App\Services\Backend\Web\ExportJob\RemoteIdentificationExportJob\RemoteIdentificationExportJobServiceContract;
use App\Services\Common\EwalletApi\EwalletApiClientServiceContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\OrderStatus;
use App\Services\Common\Helpers\OrderType;
use Breadcrumbs;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \GuzzleHttp\Exception\ClientException;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\City\CityRepositoryContract;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Repositories\Backend\User\DocumentType\DocumentTypeRepositoryContract;
use App\Services\Backend\Web\Order\RemoteIdentification\RemoteIdentificationServiceContract;
use App\Http\Requests\Backend\Web\Order\RemoteIdentification\IndexRemoteIdentificationRequest;
use App\Http\Requests\Backend\Web\Order\RemoteIdentification\AcceptRemoteIdentificationRequest;
use App\Repositories\Backend\Order\RemoteIdentification\RemoteIdentificationRepositoryContract;
use App\Http\Requests\Backend\Web\Order\RemoteIdentification\RejectRemoteIdentificationRequest;
use App\Http\Requests\Backend\Web\Order\RemoteIdentification\UpdateRemoteIdentificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Common\Helpers\EwalletApiExceptionHelper;

class RemoteIdentificationController extends Controller
{
    /**
     * @var RemoteIdentificationRepositoryContract
     */
    private $remoteIdentificationRepositoryContract;
    /**
     * @var DocumentTypeRepositoryContract
     */
    private $documentTypeRepositoryContract;
    /**
     * @var CountryRepositoryContract
     */
    private $countryRepositoryContract;
    /**
     * @var RegionRepositoryContract
     */
    private $regionRepositoryContract;
    /**
     * @var AreaRepositoryContract
     */
    private $areaRepositoryContract;
    /**
     * @var CityRepositoryContract
     */
    private $cityRepositoryContract;

    /**
     * @var OrderStatusRepositoryContract
     */
    private $orderStatusRepositoryContract;

    /**
     * @var OrderProcessStatusRepositoryContract
     */
    private $orderProcessStatusRepositoryContract;

    /**
     * @var RemoteIdentificationServiceContract
     */
    private $remoteIdentificationServiceContract;
    /**
     * @var OrderHistoryRepositoryContract
     */
    private $orderHistoryRepository;

    /**
     * @var AttestationRepositoryContract
     */
    private $attestationRepositoryContract;

    /**
     * @var OrderCommentRepositoryContract
     */
    private $orderCommentRepositoryContract;




    private $ewalletApiClientServiceContract;

    public function __construct(
        RemoteIdentificationRepositoryContract $remoteIdentificationRepositoryContract,
        DocumentTypeRepositoryContract $documentTypeRepositoryContract,
        CountryRepositoryContract $countryRepositoryContract,
        RegionRepositoryContract $regionRepositoryContract,
        AreaRepositoryContract $areaRepositoryContract,
        CityRepositoryContract $cityRepositoryContract,
        RemoteIdentificationServiceContract $remoteIdentificationServiceContract,
        OrderStatusRepositoryContract $orderStatusRepositoryContract,
        OrderProcessStatusRepositoryContract $orderProcessStatusRepositoryContract,
        OrderHistoryRepositoryContract $orderHistoryRepositoryContract,
        RemoteIdentificationExportJobServiceContract $remoteIdentificationExportJobServiceContract,
        EwalletApiClientServiceContract $ewalletApiClientServiceContract,
        AttestationRepositoryContract $attestationRepositoryContract,
        OrderCommentRepositoryContract $orderCommentRepositoryContract
    )
    {
        $this->middleware('remoteIdentification.can-list', ['only' => ['index']]);
        $this->middleware('remoteIdentification.can-show', ['only' => ['show']]);
        $this->middleware('remoteIdentification.can-update-status', ['only' => ['updateStatus']]);
        $this->middleware('remoteIdentification.can-edit', ['only' => ['edit',
            'update','reject','accept','confirm','search','checkJob','createClient',
            'identificationAccountsCheckRun','getInfoNalog','changeImage', 'takeToWork','updateHistory']]);


        $this->remoteIdentificationRepositoryContract = $remoteIdentificationRepositoryContract;
        $this->documentTypeRepositoryContract = $documentTypeRepositoryContract;
        $this->countryRepositoryContract = $countryRepositoryContract;
        $this->regionRepositoryContract = $regionRepositoryContract;
        $this->areaRepositoryContract = $areaRepositoryContract;
        $this->cityRepositoryContract = $cityRepositoryContract;
        $this->orderStatusRepositoryContract = $orderStatusRepositoryContract;
        $this->orderProcessStatusRepositoryContract = $orderProcessStatusRepositoryContract;
        $this->remoteIdentificationServiceContract = $remoteIdentificationServiceContract;
        $this->orderHistoryRepository = $orderHistoryRepositoryContract;
        $this->remoteIdentificationExportJobServiceContract = $remoteIdentificationExportJobServiceContract;
        $this->ewalletApiClientServiceContract = $ewalletApiClientServiceContract;
        $this->attestationRepositoryContract = $attestationRepositoryContract;
        $this->orderCommentRepositoryContract = $orderCommentRepositoryContract;
    }

    public function Index(IndexRemoteIdentificationRequest $request)
    {
        $data = $request->validated();
        if ($request->export ?? false == true) {
            try{
                $this->remoteIdentificationExportJobServiceContract->create($data);
                session()->flash('flash_message', "Задача для формирование отчета создано. Вы сможете найти свою выгрузку в разделе \"Задачи\"");
                return redirect()->route('admin.remoteIdentification.index');
            }catch (\Exception $e)
            {
                session()->flash('flash_message_error', $e->getMessage());
                return redirect()->route('admin.remoteIdentification.index');
            }
        } else {
            $remoteIdentifications = $this->remoteIdentificationRepositoryContract->paginate($data);
            $remoteIdentifications->appends($request->validated());
            $filterOrderStatus = $this->orderStatusRepositoryContract->listsAll()->prepend('', '');
            $filterOrderProcessStatus = $this->orderProcessStatusRepositoryContract->listsAll()->prepend('', '');
            $filterUserAttestations = $this->attestationRepositoryContract->listsAll()->prepend('', '');
            $orderCommentCalls = $this->orderCommentRepositoryContract->commentCallRemoteIdentificationList();
            return view('backend.order.remoteIdentification.index', compact('data', 'remoteIdentifications',
                'filterOrderStatus', 'filterOrderProcessStatus', 'filterUserAttestations', 'orderCommentCalls'));
        }
    }

    public function edit(Request $request, $id)
    {
        \Session::put(IndexRemoteIdentificationRequest::class, $request->get("url"));

        $data = $this->remoteIdentificationRepositoryContract->findById($id);
        if(!$data) throw new NotFoundHttpException();

        try {
            $this->checkProcessedUserId($data);
        }catch (\Exception $e){
            session()->flash('flash_message_error',  $e->getMessage());
            return $this->redirectToIndex();
        }

        $documentTypes = $this->documentTypeRepositoryContract->listsByCode(41);
        $countries  = $this->countryRepositoryContract->listsAll();
        $orderComments = $this->orderCommentRepositoryContract->isActiveList()->prepend("По умолчания","");
        $orderCommentCalls = $this->orderCommentRepositoryContract->commentCallRemoteIdentificationList()->prepend("","");

        $regions = $this->regionRepositoryContract->listsAll([
            "country_id" => $data->remote_identification_payload_params["profile"]["Items"]["country_id"] ??
                config("app_settings.default_country_id")
        ])->prepend('', '');

        $areas = $this->areaRepositoryContract->listsAll([
            "region_id" => $data->remote_identification_payload_params["profile"]["Items"]["region_id"] ??
                $regions->keys()->first()
        ])->prepend('', '');

        $cities = $this->cityRepositoryContract->listsAll([
            "area_id" => $data->remote_identification_payload_params["profile"]["Items"]["district_id"] ??
                $areas->keys()->first()
        ])->prepend('', '');

        $rejecttable = true;
        if (in_array($data->order_status->code, ["completed", "no_verified","in_process","rejected"]))
            $rejecttable = false;

        $accepttable = true;
        if (in_array($data->order_status->code,["completed", "in_process", "accepted","no_verified","rejected"]))
            $accepttable = false;

        $searchable = false;
        if ($data->order_status->code == "in_process")
            $searchable = true;

        $updatable = true;
        if (in_array($data->order_status->code,["no_verified", "completed","rejected"]) ||
            (isset($data->order_process_status) && $data->order_process_status->code == "WAITING_CLIENT_CONFIRMATION"))
            $updatable = false;

        $registerable = false;
        if ($data->order_status->code == "in_process" &&
            (isset($data->order_process_status) && $data->order_process_status->code == "WAITING_CLIENT_CONFIRMATION"))
            $registerable = true;

        $orderHistory = $this->orderHistoryRepository->findByOrderIdWithPaginate($id);

        Breadcrumbs::setCurrentRoute('admin.remoteIdentification.edit', $data);
        return view('backend.order.remoteIdentification.edit', compact('data','orderHistory',
            'documentTypes','countries','regions','areas','cities','orderComments',
            'accepttable','rejecttable', 'searchable', 'updatable','registerable', 'orderCommentCalls'));
    }

    public function show($id)
    {
        $data = $this->remoteIdentificationRepositoryContract->findById($id);
        if(!$data) throw new NotFoundHttpException();

        $documentTypes = $this->documentTypeRepositoryContract->listsByCode(41);
        $countries  = $this->countryRepositoryContract->listsAll();

        $regions = $this->regionRepositoryContract->listsAll([
            "country_id" => $data->remote_identification_payload_params["profile"]["Items"]["country_id"] ??
                config("app_settings.default_country_id")
        ])->prepend('', '');

        $areas = $this->areaRepositoryContract->listsAll([
            "region_id" => $data->remote_identification_payload_params["profile"]["Items"]["region_id"] ??
                $regions->keys()->first()
        ])->prepend('', '');

        $cities = $this->cityRepositoryContract->listsAll([
            "area_id" => $data->remote_identification_payload_params["profile"]["Items"]["district_id"] ??
                $areas->keys()->first()
        ])->prepend('', '');

        $orderCommentCalls = $this->orderCommentRepositoryContract->commentCallRemoteIdentificationList()->prepend("","");
        $orderHistory = $this->orderHistoryRepository->findByOrderIdWithPaginate($id);

        Breadcrumbs::setCurrentRoute('admin.remoteIdentification.show', $data);

        return view('backend.order.remoteIdentification.show', compact('data','orderHistory',
                                                            'documentTypes','countries','regions','areas','cities','orderCommentCalls'));
    }

    public function update(UpdateRemoteIdentificationRequest $request, $id)
    {
        try {
            $data = $this->remoteIdentificationRepositoryContract->findById($id);
            $this->checkProcessedUserId($data);
            $response = $this->remoteIdentificationServiceContract->update($request, $id);
            session()->flash('flash_message', 'Успешно редактирован');
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::REMOTE_IDENTIFICATION_CHANGED_PROFILE));
            return response()->json(\GuzzleHttp\json_decode($response->getBody()->getContents(), true));
        }
        catch (ClientException $e)
        {
            throw new \Exception(EwalletApiExceptionHelper::getMessage($e));
        }
    }

    public function reject(RejectRemoteIdentificationRequest $request, $id)
    {
        try {
            $data = $this->remoteIdentificationRepositoryContract->findById($id);
            $this->checkProcessedUserId($data);
            $this->remoteIdentificationServiceContract->reject($request, $id);
            session()->flash('flash_message', 'Заявка отклонена');
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::REMOTE_IDENTIFICATION_REJECTED));
            return $this->redirectToIndex();
        }
        catch (ClientException $e)
        {
            session()->flash('flash_message_error',  EwalletApiExceptionHelper::getMessage($e));
            return redirect()->route('admin.remoteIdentification.edit', ["id" => $id,"url" => $this->getRedirectUrl()]);
        }
    }

    public function accept(AcceptRemoteIdentificationRequest $request, $id)
    {
        if(!session()->get("inn_checked_by_nalog",false) &&
            config("app_settings.remote_indentification_requred_check_nalog") == true) {
            throw new \Exception("Сначало надо проверите ИНН с сервисом налога");
        }

        try {
            $data = $this->remoteIdentificationRepositoryContract->findById($id);
            $this->checkProcessedUserId($data);
            $response = $this->remoteIdentificationServiceContract->accept($id);
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::REMOTE_IDENTIFICATION_ACCEPTED));
            return response()->json(\GuzzleHttp\json_decode($response->getBody()->getContents(), true));
        }
        catch (ClientException $e)
        {
            throw new \Exception(EwalletApiExceptionHelper::getMessage($e));
        }
    }

    public function search(Request $request, $id)
    {
        try {
            $data = $this->remoteIdentificationRepositoryContract->findById($id);
            $this->checkProcessedUserId($data);
            $response = $this->remoteIdentificationServiceContract->search($id, ["attempt" => $request->get("attempt", 1)]);
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::REMOTE_IDENTIFICATION_SEARCHED_CLIENT));
            return response()->json(\GuzzleHttp\json_decode($response->getBody()->getContents(), true));
        }
        catch (ClientException $e)
        {
            throw new \Exception(EwalletApiExceptionHelper::getMessage($e));
        }
    }

    public function checkJob(Request $request, $id)
    {
        try {
            $response = $this->remoteIdentificationServiceContract->checkJob($request->job_id);
            $result = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            if ($result["code"] == -1)
                return response()->json(["errors" => [$result["message"]]], 400);

            if($result["code"] == 2){
                $data = $this->remoteIdentificationRepositoryContract->findById($id);
                $ew_full_name = $data->remote_identification_payload_params["profile"]["Items"]["full_name"] ?? "";
                $ew_passport_seria = $data->remote_identification_payload_params["profile"]["Items"]["passport_seria"] ?? "";
                $ew_passport_number = $data->remote_identification_payload_params["profile"]["Items"]["passport_number"] ?? "";
                $ew_inn = $data->remote_identification_payload_params["profile"]["Items"]["inn"] ?? "";
                $ew_date_birth = $data->remote_identification_payload_params["profile"]["Items"]["birth_date"] ?? "";
                if(!empty($ew_date_birth)){
                    $ew_date_birth = Carbon::createFromFormat("Y-m-d", $ew_date_birth)->format("d-m-Y");
                }

                $abs_full_name = $result["data"][0]["last_name"]." ".$result["data"][0]["first_name"]." ".$result["data"][0]["middle_name"];
                $abs_passport_seria = $result["data"][0]["passport_seria"];
                $abs_passport_number = $result["data"][0]["passport_number"];
                $abs_inn = $result["data"][0]["inn"];
                $abs_date_birth = $result["data"][0]["date_birth"] =
                    str_replace([".","/",","],"-",$result["data"][0]["date_birth"]);

                $result["update_client"] = false;
                $result["full_name_equal"] = true;
                $result["passport_seria_equal"] = true;
                $result["passport_number_equal"] = true;
                $result["inn_equal"] = true;
                $result["date_birth_equal"] = true;

                if(mb_strtolower($ew_full_name) != mb_strtolower($abs_full_name)) {
                    $result["full_name_equal"] = false;
                    $result["update_client"] = true;
                }

                if(mb_strtolower($ew_passport_seria) != mb_strtolower($abs_passport_seria)) {
                    $result["passport_seria_equal"] = false;
                    $result["update_client"] = true;
                }

                if($ew_passport_number != $abs_passport_number) {
                    $result["passport_number_equal"] = false;
                    $result["update_client"] = true;
                }

                if($ew_inn != $abs_inn) {
                    $result["inn_equal"] = false;
                    $result["update_client"] = true;
                }

                if($ew_date_birth != $abs_date_birth) {
                    $result["date_birth_equal"] = false;
                    $result["update_client"] = true;
                }

                return response()->json($result);
            }

            return response()->json($result);
        }
        catch (ClientException $e)
        {
            throw new \Exception(EwalletApiExceptionHelper::getMessage($e));
        }
    }

    public function createClient(Request $request, $id)
    {
        try {
            $response = $this->remoteIdentificationServiceContract->createClient($id);
            $result = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::REMOTE_IDENTIFICATION_CREATED_CLIENT));
            return response()->json($result);
        }
        catch (ClientException $e)
        {
            throw new \Exception(EwalletApiExceptionHelper::getMessage($e));
        }
    }

    public function updateClient(Request $request, $id)
    {
        try {
            $response = $this->remoteIdentificationServiceContract->updateClient($id,$request->job_id);
            $result = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::REMOTE_IDENTIFICATION_UPDATED_CLIENT));
            return response()->json($result);
        }
        catch (ClientException $e)
        {
            throw new \Exception(EwalletApiExceptionHelper::getMessage($e));
        }
    }

    public function confirm(Request $request, $id)
    {
        try {
            $data = $this->remoteIdentificationRepositoryContract->findById($id);
            $this->checkProcessedUserId($data);

            $response = $this->remoteIdentificationServiceContract->confirm($id, $request->job_id);
            $result = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            session()->flash('flash_message', $result["message"]);
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::REMOTE_IDENTIFICATION_CONFIRMED));
            return $this->redirectToIndex();
        }
        catch (ClientException $e)
        {
            session()->flash('flash_message_error',  EwalletApiExceptionHelper::getMessage($e));
            return redirect()->route('admin.remoteIdentification.edit', ["id" => $id,"url" => $this->getRedirectUrl()]);
        }
    }

    public function register($id)
    {
        try {
            $data = $this->remoteIdentificationRepositoryContract->findById($id);
            $this->checkProcessedUserId($data);

            $response = $this->remoteIdentificationServiceContract->register($id);
            $result = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            session()->flash('flash_message', $result["message"]);
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::REMOTE_IDENTIFICATION_REREGISTER));
            return $this->redirectToIndex();
        }
        catch (ClientException $e)
        {
            session()->flash('flash_message_error',  EwalletApiExceptionHelper::getMessage($e));
            return redirect()->route('admin.remoteIdentification.edit', ["id" => $id,"url" => $this->getRedirectUrl()]);
        }
    }

    public function identificationAccountsCheckRun()
    {
        try {
            \Artisan::call('identification:accounts-check');
            session()->flash('flash_message', "Команда выполнено");
            return redirect()->route('admin.remoteIdentification.index');
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message_error',  $e->getMessage());
            return redirect()->route('admin.remoteIdentification.index');
        }
    }

    public function image($orderId, $name)
    {
        $data = $this->remoteIdentificationRepositoryContract->findById($orderId);
        try {
            if (in_array($data->order_status->code, ["new", "no_verified", "in_process", "rejected"])) {
                $baseUrlPhoto = config("queue_transporter.asp_callback_base_url") . "/imgs/identification/passport/tmp";
            } else {
                $baseUrlPhoto = config("queue_transporter.asp_callback_base_url") . "/imgs/identification/passport";
            }
            $contents = file_get_contents($baseUrlPhoto."/".$name);
        }catch (\ErrorException  $e)
        {
            $contents = file_get_contents(public_path("imgs/remoteidentification")."/no_photo.png");
        }

        $type = (new \finfo(FILEINFO_MIME_TYPE))->buffer($contents);
        $response = \Response::make($contents, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function getInfoNalog(AcceptRemoteIdentificationRequest $request, $id)
    {
        $data = $this->remoteIdentificationRepositoryContract->findById($id);
        $this->checkProcessedUserId($data);
        $inn = $data->remote_identification_payload_params["profile"]["Items"]["inn"] ?? null;
        $HttpClient = new Client(['timeout'  => 10, 'verify' => false]);
        $response = $HttpClient->get("https://nalog.eskhata.tj:6443/p1.php",[
            'query' => ['inn' => $inn]
        ]);

        $xml = $response->getBody()->getContents();
        $xml = mb_convert_encoding($xml, mb_detect_encoding($xml, 'UTF-16,UTF-8'), 'UTF-8');
        $xml = str_replace("utf-16","utf-8",$xml);
        $sls = simplexml_load_string($xml);

        if ($sls->response->errorCode != "OK")
            return response()->json(["errors" => [strval($sls->response->errorMessage)]], 400);

        session()->flash('inn_checked_by_nalog', true);
        return response()->json(["code"=> strval($sls->response->errorCode), "data" => [
            "inn" => strval($sls->response->inn),
            "fullname" => strval($sls->response->FullName),
        ]]);
    }

    public function changeImage(Request $request, $orderId, $image)
    {
        $data = $this->remoteIdentificationRepositoryContract->findById($orderId);
        $this->checkProcessedUserId($data);
        if (in_array($data->order_status->code, ["new", "no_verified", "in_process", "rejected"])) {
            $baseUrlPhoto = config("queue_transporter.asp_callback_base_url") . "/imgs/identification/passport/tmp";
        } else {
            $baseUrlPhoto = config("queue_transporter.asp_callback_base_url") . "/imgs/identification/passport";
        }

        $img = \Image::make($baseUrlPhoto."/".$image);

        if(!empty($flip = $request->get("flip"))) {
            $img->flip($flip);
        }

        if(!empty($gradus = $request->get("gradus"))) {
            $img->rotate(-1 * $gradus);
        }

        $img->save("php://temp/maxmemory:".(20 * 1024 * 1024).""); // 20MB

        $fieldPhoto = null;
        foreach ($data->payload_params_json as $key => $value)
        {
            if(in_array($key, array("front_photo","back_photo","selfie_photo")))
            {
                if(isset($value["Item"]["img"]) && $value["Item"]["img"] == $image) {
                    $fieldPhoto = $key;
                }
            }
        }

        if(is_null($fieldPhoto))
            throw new \Exception("Это фото ненайдено в базе!");

        $options = [
            \GuzzleHttp\RequestOptions::HEADERS => ['userId' => \Auth::user()->id],
            'multipart' => [
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => $fieldPhoto,
                    'contents' => $img->stream(),
                    'filename' => $image,
                ],
            ],
        ];

        try {
            $response = $this->ewalletApiClientServiceContract
                ->getHttpClient()
                ->post("/api/v2.2/order/callback/identification/$orderId/change", $options);

            return response()->json(\GuzzleHttp\json_decode($response->getBody()->getContents(), true));
        }catch (ClientException $e)
        {
            throw new \Exception(EwalletApiExceptionHelper::getMessage($e));
        }
    }

    public function takeToWork(Request $request, $id)
    {
        $model = $this->remoteIdentificationRepositoryContract->findByIdToTake($id);

        if (!in_array($model->order_status->code, ["new", "in_process", "accepted"])) {
            return response()->json(["errors" => ["Невозможно взять заявку на обработку. Заявка находится в статусе ".$model->order_status->name]], 400);
        }

        if($request->confirmed){
            $model->processed_by_user_id = Auth::user()->id;
            $model->save();
            return response()->json(["code" => 1, "message" => ""]);
        }

        if(!is_null($model->processed_by_user_id) && $model->processed_by_user_id != Auth::user()->id){
            return response()->json(
                [
                    "code" => 0,
                    "message" => "Заявка находится на обработке у {$model->processed_by_user->full_name_extended_format}, Вы действительно хотите взять заявку на обработку?"
                ]);
        }elseif($model->processed_by_user_id == Auth::user()->id){
            return response()->json(
                [
                    "code" => 2,
                    "message" => "Заявка уже находится у Вас на обработке. Прейдите к заявке через редактирование."
                ]);
        }

        /* Если в дальнейшим хотим вывести диалог окно при взять на работу update_user_id null*/
        return response()->json(
            [
                "code" => 3,
                "message" => ""
            ]);
    }

    public function checkProcessedUserId($model)
    {
        if(is_null($model->processed_by_user_id)){
            throw new \Exception("Для обработки заявки нажмите \"Взять на работу\" ");
        } elseif($model->processed_by_user_id != Auth::user()->id)
        {
            throw new \Exception("Заявка обрабатывается другим пользователем");
        }
    }

    public function redirectToIndex()
    {
        $url = $this->getRedirectUrl();

        if(filter_var($url, FILTER_VALIDATE_URL) && strpos(strtolower($url), "http") === 0) {
            return redirect()->away($url);
        }else{
            return redirect()->route('admin.remoteIdentification.index');
        }
    }

    public function getRedirectUrl()
    {
        return base64_decode(\Session::get(IndexRemoteIdentificationRequest::class));
    }

    public function updateHistory(UpdateHistoryCallRemoteIdentificationRequest $request, $id)
    {
        try {
            $response = $this->remoteIdentificationServiceContract->updateHistory($id,$request->validated());
//            $result = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::UPDATED));
            $order=$this->remoteIdentificationRepositoryContract->findById($id);
            $data=[];
            if (isset($order->remote_identification_payload_params['history']['calls'])){
                $data=$order->history_call;
            }
            return response()->json($data, 200);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function updateStatus($id)
    {
        try {

            $data = $this->remoteIdentificationRepositoryContract->findById($id);
            if (isset($data) && isset($data->order_status_id)
                && $data->order_type_id==OrderType::REMOTE_IDENTIFICATION
                && $data->order_status_id==OrderStatus::IN_PROCESS
            ){
            $response = $this->remoteIdentificationServiceContract->updateStatus($id);
//            $result = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::UPDATED));
                session()->flash('flash_message', 'Успешно редактирован');
                event(new UserModifiedEvent($this->remoteIdentificationRepositoryContract->findById($id),Events::UPDATED));
            }else{
                session()->flash('flash_message_error', 'Невозможно изменить другие статусы кроме В обработке');
            }
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message_error', $e->getMessage());
        }
        return redirect()->route('admin.remoteIdentification.index');
    }
}