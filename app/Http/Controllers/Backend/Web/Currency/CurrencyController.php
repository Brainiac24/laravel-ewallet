<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Currency;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Currency\StoreCurrencyRequest;
use App\Http\Requests\Backend\Web\Currency\UpdateCurrencyRequest;
use App\Http\Requests\Backend\Web\Region\StoreRegionRequest;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class CurrencyController extends Controller
{
    protected $currencyRepository;

    public function __construct(CurrencyRepositoryContract $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
        $this->middleware('currency.can-list', ['only' => ['index']]);
        $this->middleware('currency.can-show', ['only' => ['show']]);
        $this->middleware('currency.can-create', ['only' => ['create','store']]);
        $this->middleware('currency.can-edit', ['only' => ['edit','update']]);
        $this->middleware('currency.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $currencies = $this->currencyRepository->paginate();
        return view('backend.currency.index', compact('currencies'));
    }

    public function create()
    {

        return view('backend.currency.create');
    }

    public function edit($id)
    {

        $currency = $this->currencyRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.currencies.edit', $currency);
        return view('backend.currency.edit', compact('currency'));
    }

    public function show($id)
    {
        $currency = $this->currencyRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.currencies.show', $currency);
        return view('backend.currency.show', compact('currency'));
    }

    public function destroy($id)
    {
        try {
            $currency = $this->currencyRepository->destroy($id);
            event(new UserModifiedEvent($currency, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.currencies.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.currencies.index');
        }
    }

    public function store(StoreCurrencyRequest $request)
    {
        $currency = $this->currencyRepository->create($request->validated());
        $currency->setChanges($currency->getAttributes());
        event(new UserModifiedEvent($currency, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.currencies.index');
    }

    public function update(UpdateCurrencyRequest $request, $id)
    {
        $currency = $this->currencyRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($currency, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.currencies.index');
    }
}