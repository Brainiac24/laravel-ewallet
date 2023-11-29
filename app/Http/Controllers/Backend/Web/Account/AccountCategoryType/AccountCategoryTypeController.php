<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15.07.2019
 * Time: 16:51
 */

namespace App\Http\Controllers\Backend\Web\Account\AccountCategoryType;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Account\AccountCategoryType\UpdateAccountCategoryTypeRequest;
use App\Repositories\Backend\Account\AccountCategoryType\AccountCategoryTypeContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class AccountCategoryTypeController extends Controller
{
    /**
     * @var AccountCategoryTypeContract
     */
    private $accountCategoryTypeContract;

    /**
     * AccountCategoryType constructor.
     * @param AccountCategoryTypeContract $accountCategoryTypeContract
     */
    public function __construct(AccountCategoryTypeContract $accountCategoryTypeContract)
    {
        $this->accountCategoryTypeContract = $accountCategoryTypeContract;

        $this->middleware('account.categoryType.can-list', ['only' => ['index']]);
        $this->middleware('account.categoryType.can-show', ['only' => ['show']]);
        $this->middleware('account.categoryType.can-edit', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $accountCategoryTypes = $this->accountCategoryTypeContract->all();
        return view('backend.account.accountCategoryType.index', compact('accountCategoryTypes'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        $accountCategoryTypes = $this->accountCategoryTypeContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.accounts.category.types.show', $accountCategoryTypes);
        return view('backend.account.accountCategoryType.show', compact('accountCategoryTypes'));
    }

    public function edit($id)
    {
        //
        $accountCategoryTypes = $this->accountCategoryTypeContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.accounts.category.types.edit', $accountCategoryTypes);
        return view('backend.account.accountCategoryType.edit', compact('accountCategoryTypes'));
    }

    public function update(UpdateAccountCategoryTypeRequest $request, $id)
    {
        //
        $accountCategoryTypes = $this->accountCategoryTypeContract->update($request->validated(), $id);
        //dd($request->validated());
        event(new UserModifiedEvent($accountCategoryTypes, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.accounts.category.types.index');
    }
}