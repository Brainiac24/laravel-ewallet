<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Currency\CurrencyRateHistory;

use App\Http\Controllers\Controller;

use App\Http\Requests\Backend\Web\Currency\CurrencyRateHistory\StoreCurrencyRateHistoryRequest;
use App\Http\Requests\Backend\Web\Currency\CurrencyRateHistory\UpdateCurrencyRateHistoryRequest;
use App\Repositories\Backend\Currency\CurrencyRateHistory\CurrencyRateHistoryRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class CurrencyRateHistoryController extends Controller
{
    protected $currencyRateHistoryRepository;

    public function __construct(CurrencyRateHistoryRepositoryContract $currencyRateHistoryRepository)
    {
        $this->currencyRateHistoryRepository = $currencyRateHistoryRepository;
        $this->middleware('currency.rate.history.can-list', ['only' => ['index']]);
        $this->middleware('currency.rate.history.can-show', ['only' => ['show']]);
        $this->middleware('currency.rate.history.can-create', ['only' => ['create','store']]);
        $this->middleware('currency.rate.history.can-edit', ['only' => ['edit','store']]);
        $this->middleware('currency.rate.history.can-delete', ['only' => ['destroy','store']]);
    }

    public function index()
    {
        $currencyRateHistories = $this->currencyRateHistoryRepository->paginate();
        return view('backend.currency.currencyRateHistory.index', compact('currencyRateHistories'));
    }

    public function create()
    {
        return view('backend.currency.currencyRateHistory.create');
    }

    public function edit($id)
    {
        $currencyRateHistory = $this->currencyRateHistoryRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.currencies.rates.histories.edit', $currencyRateHistory);
        return view('backend.currency.currencyRateHistory.edit', compact('currencyRateHistory'));
    }

    public function show($id)
    {
        $currencyRateHistory = $this->currencyRateHistoryRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.currencies.rates.histories.show', $currencyRateHistory);
        return view('backend.currency.currencyRateHistory.show', compact('currencyRateHistory'));
    }

    public function destroy($id)
    {
        try {
            $this->currencyRateHistoryRepository->destroy($id);
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.currencies.rates.histories.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.currencies.rates.histories.index');
        }
    }

    public function store(StoreCurrencyRateHistoryRequest $request)
    {
        $this->currencyRateHistoryRepository->create($request->validated());
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.currencies.rates.histories.index');
    }

    public function update(UpdateCurrencyRateHistoryRequest $request, $id)
    {
        $this->currencyRateHistoryRepository->update($request->validated(), $id);
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.currencies.rates.histories.index');
    }
}