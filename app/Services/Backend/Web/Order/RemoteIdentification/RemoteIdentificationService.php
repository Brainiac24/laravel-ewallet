<?php

namespace App\Services\Backend\Web\Order\RemoteIdentification;



use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Common\EwalletApi\EwalletApiClientServiceContract;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repositories\Backend\Order\RemoteIdentification\RemoteIdentificationRepositoryContract;

class RemoteIdentificationService implements RemoteIdentificationServiceContract
{
    /**
     * @var EwalletApiClientServiceContract
     */
    private $ewalletApiClientServiceContract;
    private $remoteIdentificationRepositoryContract;

    public function __construct(EwalletApiClientServiceContract $ewalletApiClientServiceContract,
                                RemoteIdentificationRepositoryContract $remoteIdentificationRepositoryContract)
    {
        $this->ewalletApiClientServiceContract = $ewalletApiClientServiceContract;
        $this->remoteIdentificationRepositoryContract = $remoteIdentificationRepositoryContract;
    }

    public function update(Request $request, $id)
    {
        $fields = [
            "first_name",
            "last_name",
            "middle_name",
            "birth_date",
            "gender_id",
            "passport_seria",
            "passport_number",
            "passport_by_who",
            "passport_issue_date",
            "inn",
            "citizenship_id",
            "document_type_id",
            "document_expiration_date",
            "country_id",
            "region_id",
            "district_id",
            "city_id",
            "street",
            "house_number",
            "housing",
            "room",
            "registration_date",
            "address",
            "is_resident",
            "registration_date_not"
        ];

        $data = $this->remoteIdentificationRepositoryContract->findById($id);
        if(!$data) throw new NotFoundHttpException();

        $profile = [];
        foreach ($fields as $field) {
            foreach ($request->get("profile", []) as $key => $value) {
                if ($field == $key) {
                    if(!is_null($value) && !empty($value) && in_array($field,array("birth_date","passport_issue_date","document_expiration_date", "registration_date"))){
                        $value = Carbon::createFromFormat("Y-m-d", $value)->format("d.m.Y");
                    }

                    if($field == "inn" &&
                      in_array($data->order_status->code,["completed", "in_process", "accepted","no_verified","rejected"])) {
                        $value = $data->remote_identification_payload_params["profile"]["Items"]["inn"] ?? null;
                    }

                    $profile[] = ["key" => $key, "value" => $value];
                }
            }
        }

        return $this->ewalletApiClientServiceContract->getHttpClient()
            ->post("/api/v2.2/order/callback/identification/$id/change", [
                \GuzzleHttp\RequestOptions::HEADERS => ['userId' => \Auth::user()->id],
                "form_params" => ["profile" => $profile],
            ]);
    }

    public function reject(Request $request, $id)
    {
        $data = [
            [
                "section_name" => "profile",
                "status" => $request->profile["status"] == "1" ? true : false,
                "order_comment_id" => $request->profile["order_comment_id"] ?? null,
            ],
            [
                "section_name" => "front_photo",
                "status" => $request->front_photo["status"] == "1" ? true : false,
                "order_comment_id" => $request->front_photo["order_comment_id"] ?? null,
            ],
            [
                "section_name" => "back_photo",
                "status" => $request->back_photo["status"] == "1" ? true : false,
                "order_comment_id" => $request->back_photo["order_comment_id"] ?? null,
            ],
            [
                "section_name" => "selfie_photo",
                "status" => $request->selfie_photo["status"] == "1" ? true : false,
                "order_comment_id" => $request->selfie_photo["order_comment_id"] ?? null,
            ],
        ];

        if(isset($request->additional_photo["status"])){
            $data[] = [
                "section_name" => "additional_photo",
                "status" => $request->additional_photo["status"] == "1" ? true : false,
                "order_comment_id" => $request->additional_photo["order_comment_id"] ?? null,
            ];
        }elseif(isset($request->additional_photo["include"]) && $request->additional_photo["include"] == "1"){
            $data[] = [
                "section_name" => "additional_photo",
                "status" => false,
                "order_comment_id"  => $request->additional_photo["order_comment_id"] ?? null,
            ];
        }

        return $this->ewalletApiClientServiceContract->getHttpClient()
            ->post("/api/v2.2/order/callback/identification/$id/reject", [
                \GuzzleHttp\RequestOptions::HEADERS => ['userId' => \Auth::user()->id],
                \GuzzleHttp\RequestOptions::JSON => [
                    "data" => $data
                ]
            ]);
    }

    public function accept($id)
    {
        return $this->ewalletApiClientServiceContract->getHttpClient()
                    ->get("/api/v2.2/order/callback/identification/$id/accept",[
                            \GuzzleHttp\RequestOptions::HEADERS => ['userId' => \Auth::user()->id],
                        ]
                    );
    }

    public function search($id, $form_params = null)
    {
        return $this->ewalletApiClientServiceContract->getHttpClient()
            ->post("/api/v2.2/order/callback/identification/{$id}/search",[
                \GuzzleHttp\RequestOptions::HEADERS => ['userId' => \Auth::user()->id],
                \GuzzleHttp\RequestOptions::QUERY => $form_params
            ]);
    }

    public function checkJob($job_id)
    {
        return $this->ewalletApiClientServiceContract->getHttpClient()
            ->get("/api/v2.2/order/callback/identification/{$job_id}/check");
    }

    public function createClient($id)
    {
        return $this->ewalletApiClientServiceContract->getHttpClient()
                    ->get("/api/v2.2/order/callback/identification/client/create/{$id}",[
                        \GuzzleHttp\RequestOptions::HEADERS => ['userId' => \Auth::user()->id],
                    ]);
    }

    public function updateClient($id, $job_id)
    {
        return $this->ewalletApiClientServiceContract->getHttpClient()
            ->get("/api/v2.2/order/callback/identification/client/update/{$id}",[
                \GuzzleHttp\RequestOptions::HEADERS => [
                    'userId' => \Auth::user()->id,
                    'jobLogId' => $job_id
                ],
            ]);
    }

    public function register($id)
    {
        return $this->ewalletApiClientServiceContract->getHttpClient()
            ->post("/api/v2.2/order/callback/identification/{$id}/register",[
                \GuzzleHttp\RequestOptions::HEADERS => [
                    'userId' => \Auth::user()->id,
                ],
            ]);
    }

    public function confirm($id, $job_id)
    {
        return $this->ewalletApiClientServiceContract->getHttpClient()
            ->post("/api/v2.2/order/callback/identification/{$id}/confirm",[
                \GuzzleHttp\RequestOptions::HEADERS => ['userId' => \Auth::user()->id],
                \GuzzleHttp\RequestOptions::JSON => [
                    "job_id" => $job_id
                ]
            ]);
    }

    public function updateHistory($id, $data)
    {
        $request=[];
        if (isset($data['call_comment'])){
            $request['OrderCommentId']=$data['call_comment'];
            $request['UserId']=\Auth::user()->id;
        }
        if (isset($data['history_comment'])){
            $request['Comment']= str_replace("\r\n", '',$data['history_comment']);
            $request['UserId']=\Auth::user()->id;
        }

        if (count($request)>0){
            return $this->ewalletApiClientServiceContract->getHttpClient()
                ->post("/api/v2.3/order/callback/identification/{$id}/comments/add",[
                    \GuzzleHttp\RequestOptions::HEADERS => ['userId' => \Auth::user()->id],
                    'form_params' => $request
                ]);
        }
        return null;

    }

    public function updateStatus($id)
    {
        return $this->ewalletApiClientServiceContract->getHttpClient()
            ->post("/api/v2.2/order/callback/identification/{$id}/status/back",[
                \GuzzleHttp\RequestOptions::HEADERS => [
                    'userId' => \Auth::user()->id,
                ],
            ]);
    }

}
