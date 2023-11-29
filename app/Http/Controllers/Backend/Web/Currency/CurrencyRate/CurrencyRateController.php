<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Currency\CurrencyRate;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Currency\CurrencyRate\IndexCurrencyRateRequest;
use App\Http\Requests\Backend\Web\Currency\CurrencyRate\StoreCurrencyRateRequest;
use App\Http\Requests\Backend\Web\Currency\CurrencyRate\UpdateCurrencyRateRequest;
use App\Http\Requests\Backend\Web\Currency\StoreCurrencyRequest;
use App\Http\Requests\Backend\Web\Currency\UpdateCurrencyRequest;
use App\Repositories\Backend\Currency\CurrencyRate\CurrencyRateRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRateCategory\CurrencyRateCategoryRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRateHistory\CurrencyRateHistoryEloquentRepository;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class CurrencyRateController extends Controller
{
    protected $currencyRateRepository;
    protected $currencyRateHistory;
    protected $currencies;
    protected $currencyRateCategories;

    public function __construct(CurrencyRateRepositoryContract $currencyRateRepository , CurrencyRepositoryContract $currencies , CurrencyRateHistoryEloquentRepository $currencyRateHistory, CurrencyRateCategoryRepositoryContract $currencyRateCategories)
    {
        $this->currencyRateRepository = $currencyRateRepository;
        $this->currencies = $currencies;
        $this->currencyRateHistory = $currencyRateHistory;
        $this->currencyRateCategories = $currencyRateCategories;
        $this->middleware('currency.rate.can-list', ['only' => ['index']]);
        $this->middleware('currency.rate.can-show', ['only' => ['show']]);
        //$this->middleware('currency.rate.can-create', ['only' => ['create','store']]);
        $this->middleware('currency.rate.can-edit', ['only' => ['edit','store']]);
        $this->middleware('currency.rate.can-delete', ['only' => ['destroy','store']]);
    }

    public function index(IndexCurrencyRateRequest $request)
    {
        $data = $request->validated();
        $currencyRates = $this->currencyRateRepository->paginate($data);
        return view('backend.currency.currencyRate.index', compact('currencyRates','data'));
    }

    /*public function create()
    {
        $currencies = $this->currencies->listsAll();
        $currency_rate_categories = $this->currencyRateCategories->listsAll();
        return view('backend.currency.currencyRate.create',compact(['currencies','currency_rate_categories']));
    }*/

    public function edit($id)
    {

        $currencyRate = $this->currencyRateRepository->findById($id);
        $currencies = $this->currencies->listsAll();
        $currency_rate_categories = $this->currencyRateCategories->listsAll();
        $selectedCurrencyRate = $currencyRate->currency_id;
        $selectedCurrencyRateCategory = $currencyRate->currency_rate_category_id;
        Breadcrumbs::setCurrentRoute('admin.currencies.rates.edit', $currencyRate);
        return view('backend.currency.currencyRate.edit', compact('currencyRate','currencies','selectedCurrencyRate', 'currency_rate_categories', 'selectedCurrencyRateCategory'));
    }

    public function show($id)
    {
        $currencyRate = $this->currencyRateRepository->findById($id);
        $currencyRateHistory = $this->currencyRateHistory->paginateByCurrencyID($currencyRate->currency_id);
        Breadcrumbs::setCurrentRoute('admin.currencies.rates.show', $currencyRate);
        return view('backend.currency.currencyRate.show', compact('currencyRate','currencyRateHistory'));
    }

    public function destroy($id)
    {
        try {
            $currencyRate = $this->currencyRateRepository->destroy($id);
            event(new UserModifiedEvent($currencyRate, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.currencies.rates.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.currencies.rates.index');
        }
    }

    /*public function store(StoreCurrencyRateRequest $request)
    {
        $currencyRate = $this->currencyRateRepository->create($request->validated());
        $currencyRate->setChanges($currencyRate->getAttributes());
        event(new UserModifiedEvent($currencyRate, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.currencies.rates.index');
    }*/

    public function update(UpdateCurrencyRateRequest $request, $id)
    {
        $currencyRate = $this->currencyRateRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($currencyRate, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.currencies.rates.index');
    }
}