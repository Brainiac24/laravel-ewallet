<?php

namespace App\Http\Controllers\Backend\Api\Currency\CurrencyRate;

use App\Exceptions\Backend\Api\ResourceNotFoundException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Currency\CurrencyRate\CurrencyRateRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Services\Common\Gateway\Queue\QueueHashContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CurrencyRateController extends Controller
{
    protected $currencyRateRepository;
    protected $currencyRepository;
    protected $queueHash;

    protected $storeRules = [
        'hash' => 'required|alpha_num',
        'datetime' => 'required|date_format:ymdHis|after:yesterday',
        'payload' => 'required|array',
        'payload.date' => 'required|date_format:Y.m.d',
        'payload.code_iso' => 'required|integer',
        'payload.cur_iso' => 'required|alpha',
        'payload.rate' => 'required|numeric',
        'payload.sale' => 'required|numeric',
        'payload.buy' => 'required|numeric',
        'payload.type_rate' => 'required|string',
    ];

    /**
     * CurrencyRateController constructor.
     * @param $currencyRateRepository
     * @param $currencyRepository
     * @param $queueHash
     */
    public function __construct(CurrencyRateRepositoryContract $currencyRateRepository, CurrencyRepositoryContract $currencyRepository, QueueHashContract $queueHash)
    {
        $this->currencyRateRepository = $currencyRateRepository;
        $this->currencyRepository = $currencyRepository;
        $this->queueHash = $queueHash;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ResourceNotFoundException
     */
    public function store(Request $request)
    {
        if (!in_array($request->getClientIp(), config('app_settings.allowed_ips_for_change_rate')))
            throw new ResourceNotFoundException("Ip not allowed {$request->getClientIp()}");

        $validator = \Validator::make($request->all(), $this->storeRules);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                throw new ResourceNotFoundException($error);
            }
        }

        $payload = $request->payload;
        $hash = $request->hash;
        $datetime = $request->datetime;

        if (!$this->queueHash->check($hash, $datetime, $payload)) {
//            Log::error("{$hash}:{$datetime}", $payload);
            throw new ResourceNotFoundException('Invalid hash');
        }

        $currency = $this->currencyRepository->findByCode($payload['code_iso']);

        if ($currency === null)
            throw new ResourceNotFoundException("Currency {$payload['code_iso']} not found");

        $this->currencyRateRepository->createOrUpdateByCurrencyId($payload['buy'], $payload['sale'], $currency->id, $payload['type_rate']);

        return response()->json(['success' => true]);
    }
}
