<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Account;

use App\Events\Frontend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Account\Account\IndexAccountRequest;
use App\Http\Requests\Backend\Web\Account\Account\StoreAccountRequest;
use App\Http\Requests\Backend\Web\Account\Account\UpdateAccountRequest;
use App\Repositories\Backend\Account\AccountHistory\AccountHistoryRepositoryContract;
use App\Repositories\Backend\Account\AccountRepositoryContract;
use App\Repositories\Backend\Account\AccountStatus\AccountStatusRepositoryContract;
use App\Repositories\Backend\Account\AccountType\AccountTypeRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class AccountController extends Controller
{
    protected $accountRepository;
    protected $accountHistoryRepository;
    protected  $accountTypeRepository;
    protected  $accountStatusRepository;
    protected  $currencyRepository;

    public function __construct(AccountRepositoryContract $accountRepository,
                                AccountHistoryRepositoryContract $accountHistoryRepository,
                                AccountTypeRepositoryContract $accountTypeRepository,
                                AccountStatusRepositoryContract $accountStatusRepository,
                                CurrencyRepositoryContract $currencyRepository
            )
    {
        $this->accountRepository = $accountRepository;
        $this->accountHistoryRepository = $accountHistoryRepository;
        $this->accountTypeRepository=$accountTypeRepository;
        $this->accountStatusRepository=$accountStatusRepository;
        $this->currencyRepository=$currencyRepository;
        $this->middleware('account.can-list', ['only' => ['index']]);
        $this->middleware('account.can-show', ['only' => ['show']]);
        //$this->middleware('account.can-create', ['only' => ['create', 'store']]);
        $this->middleware('account.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('account.can-delete', ['only' => ['destroy']]);
    }

    public function index(IndexAccountRequest $request)
    {
        $data = $request->validated();
        $filterAccountTypes = $this->accountTypeRepository->all()->pluck('name','id')->toArray();
        $filterAccountStatuses = $this->accountStatusRepository->all()->pluck('name', 'id')->prepend('', '');
        $filterCurrencies = $this->currencyRepository->listsAll()->prepend('', '');
        $accounts = $this->accountRepository->paginate($data);
        $accounts->appends($request->validated());

        return view('backend.account.account.index', compact('accounts', 'data','filterAccountTypes',
                    'filterCurrencies', 'filterAccountStatuses'));

    }

    /*public function create()
    {
        return view('backend.account.account.create');
    }*/

    public function edit($id)
    {

        $account = $this->accountRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.accounts.types.edit', $account);
        return view('backend.account.account.edit', compact('account'));
    }

    public function show($id)
    {
        $account = $this->accountRepository->findById($id);
        $params_json = $account->params_json;
        $params_json['exp_date']=null;
        $account->params_json=$params_json;
        //$accountHistory = $account->accountHistories()->orderBy('created_at','desc')->get();
        $accountHistory = $this->accountHistoryRepository->findByNumberWithPaginate($account->number??'');
        //dd($accountHistory);
        Breadcrumbs::setCurrentRoute('admin.accounts.show', $account);

        return view('backend.account.account.show', compact('account', 'accountHistory'));
    }

    public function destroy($id)
    {
        try {
            $account = $this->accountRepository->destroy($id);
            event(new UserModifiedEvent($account, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.accounts.types.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.accounts.types.index');
        }
    }

    /*public function store(StoreAccountRequest $request)
    {
        $account = $this->accountRepository->create($request->validated());
        event(new UserModifiedEvent($account, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.accounts.types.index');
    }*/

    public function update(UpdateAccountRequest $request, $id)
    {
        $account = $this->accountRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($account, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.accounts.types.index');
    }
}