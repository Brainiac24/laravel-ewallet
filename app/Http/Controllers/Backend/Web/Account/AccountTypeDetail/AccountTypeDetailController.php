<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Account\AccountTypeDetail;

use App\Http\Controllers\Controller;


use App\Http\Requests\Backend\Web\Account\AccountTypeDetail\StoreAccountTypeDetailRequest;
use App\Http\Requests\Backend\Web\Account\AccountTypeDetail\UpdateAccountTypeDetailRequest;
use App\Repositories\Backend\Account\AccountType\AccountTypeRepositoryContract;
use App\Repositories\Backend\Account\AccountTypeDetail\AccountTypeDetailEloquentRepository;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class AccountTypeDetailController extends Controller
{
    protected $accountTypeDetailRepository;
    protected $accountTypeRepository;
//accountType
    public function __construct(AccountTypeDetailEloquentRepository  $accountTypeDetailRepository, AccountTypeRepositoryContract $accountTypeRepository)
    {
        $this->accountTypeDetailRepository = $accountTypeDetailRepository;
        $this->accountTypeRepository = $accountTypeRepository;
    }

    public function index()
    {
        $accountTypeDetails = $this->accountTypeDetailRepository->paginate();
        return view('backend.account.accountTypeDetail.index',compact('accountTypeDetails'));
    }

    public function create()
    {
        $accountTypeDetail= $this->accountTypeDetailRepository->listsAll();
        return view('backend.account.accountTypeDetail.create',compact('accountTypeDetail'));
    }

    public function edit($id)
    {

        $accountTypeDetail = $this->accountTypeDetailRepository->findById($id);
        $selectedAccountTypeId = $accountTypeDetail->account_type_id;
        $accountTypeRepository= $this->accountTypeRepository->listsAll();
        Breadcrumbs::setCurrentRoute('admin.accounts.types-detail.edit', $accountTypeDetail);
        return view('backend.account.accountTypeDetail.edit' , compact('selectedAccountTypeId','accountTypeDetail','accountTypeRepository'));
    }

    public function show($id)
    {
        $accountTypeDetail = $this->accountTypeDetailRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.accounts.types-detail.show', $accountTypeDetail);
        return view('backend.account.accountTypeDetail.show',compact('accountTypeDetail'));
    }
    public function destroy($id)
    {
        try {
            $this->accountTypeDetailRepository->destroy($id);
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.accounts.types-detail.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.accounts.types-detail.index');
        }
    }
    public function store(StoreAccountTypeDetailRequest $request)
    {
        $this->accountTypeDetailRepository->create($request->validated());
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.accounts.types-detail.index');
    }

    public function update(UpdateAccountTypeDetailRequest $request, $id)
    {

        $this->accountTypeDetailRepository->update($request->validated(), $id);
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.accounts.types-detail.index');
    }
}