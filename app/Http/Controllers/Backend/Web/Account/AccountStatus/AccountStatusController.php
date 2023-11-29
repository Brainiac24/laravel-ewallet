<?php

namespace App\Http\Controllers\backend\web\account\AccountStatus;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Requests\Backend\Web\Account\AccountStatus\StoreAccountStatusRequest;
use App\Http\Requests\Backend\Web\Account\AccountStatus\UpdateAccountStatusRequest;
use App\Repositories\Backend\Account\AccountStatus\AccountStatusRepositoryContract;
use App\Services\Common\Helpers\Events;
use Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountStatusController extends Controller
{
    /**
     * @var AccountStatusRepositoryContract
     */
    private $accountStatusRepositoryContract;

    /**
     * Display a listing of the resource.
     *
     * @param AccountStatusRepositoryContract $accountStatusRepositoryContract
     */

    public function __construct(AccountStatusRepositoryContract $accountStatusRepositoryContract)
    {

        $this->accountStatusRepositoryContract = $accountStatusRepositoryContract;

        $this->middleware('account.status.can-list', ['only' => ['index']]);
        $this->middleware('account.status.can-show', ['only' => ['show']]);
        $this->middleware('account.status.can-create', ['only' => ['create', 'store']]);
        $this->middleware('account.status.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('account.status.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
        $accountStatus = $this->accountStatusRepositoryContract->all();
        return view('backend.account.accountStatus.index', compact('accountStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.account.accountStatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountStatusRequest $request)
    {
        //
        $accountStatus = $this->accountStatusRepositoryContract->create($request->validated());
        $accountStatus->setChanges($accountStatus->getAttributes());
        event(new UserModifiedEvent($accountStatus, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.accounts.status.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $accountStatus = $this->accountStatusRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.accounts.status.show', $accountStatus);
        return view('backend.account.accountStatus.show', compact('accountStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $accountStatus = $this->accountStatusRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.accounts.status.show', $accountStatus);
        return view('backend.account.accountStatus.edit', compact('accountStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountStatusRequest $request, $id)
    {
        //
        $accountStatus = $this->accountStatusRepositoryContract->update($request->validated(), $id);
        //dd('123');
        event(new UserModifiedEvent($accountStatus, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.accounts.status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $accountStatus = $this->accountStatusRepositoryContract->destroy($id);
            event(new UserModifiedEvent($accountStatus, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.accounts.status.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.accounts.status.index');
        }
    }
}
