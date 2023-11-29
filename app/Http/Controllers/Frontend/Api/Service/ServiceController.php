<?php

namespace App\Http\Controllers\Frontend\Api\Service;

use App\Exceptions\Frontend\Api\LogicException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\Api\Service\ServiceResource;
use App\Repositories\Frontend\Service\ServiceRepositoryContract;
use App\Services\Common\Helpers\Attestation;
use App\Services\Frontend\Api\Transaction\TransactionService;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public $serviceRepository;
    public $transactionService;
    public function __construct(ServiceRepositoryContract $serviceRepository, TransactionService $transactionService)
    {
        $this->serviceRepository = $serviceRepository;
        $this->transactionService = $transactionService;
    }

    public function getServiceById($id)
    {
        $service = $this->serviceRepository->findById($id);

        if ($service == null) {
            throw new LogicException(trans('service.errors.code_not_found'));
        }

        if (Auth::user()->attestation_id == Attestation::NOT_IDENTIFIED) {
            if ($service->is_enabled == 0) {
                throw (new LogicException(trans('attestations.errors.not_allowed')));
            }
        }

        $this->transactionService->checkServiceWorkday($service);


        $data = new ServiceResource($service);
        //dd($data);
        $code = '0';
        //$meta
        return \response()->apiSuccess(compact('code', 'data'));
    }

    public function getImageSize($size)
    {
        $res = '';
        switch ($size) {
            case 'hdpi':
                $res = '/hdpi/';
                break;
            case 'ldpi':
                $res = '/ldpi/';
                break;
            case 'mdpi':
                $res = '/mdpi/';
                break;
            case 'xhdpi':
                $res = '/xhdpi/';
                break;
            case 'xxhdpi':
                $res = '/xxhdpi/';
                break;
            case 'xxxhdpi':
                $res = '/xxxhdpi/';
                break;
            default:
                $res = '/xxxhdpi/';
        }
        return $res;
    }

}
