<?php

namespace App\Http\Controllers\Frontend\Api\Currency\CurrencyRate;

use App\Exceptions\Frontend\Api\LogicException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\Api\CurrencyRate\CurrencyRateResource;
use App\Repositories\Frontend\Currency\CurrencyRate\CurrencyRateRepositoryContract;
use App\Services\Common\Helpers\HttpStatusCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyRateController extends Controller
{
    
    protected $currencyRateRepository;

    function __construct(CurrencyRateRepositoryContract $currencyRateRepository)
    {
        $this->currencyRateRepository = $currencyRateRepository;
    }

    public function index()
    {
        //dd($this->currencyRateRepository->allExceptTjs());
        $data = CurrencyRateResource::Collection($this->currencyRateRepository->allExceptTjs());
        if ($data == null) {
            throw new LogicException(trans('currency_rate.errors.not_found'));
        }
        $code = HttpStatusCode::OK;
        //$meta = Auth::user();
        return \response()->apiSuccess(compact('code', 'data','meta'));
    }
}
