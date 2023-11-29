<?php


namespace App\Http\Controllers\Backend\Web\Cashback\BonusAccrual\BonusAccrualStatus;


use App\Http\Controllers\Controller;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Http\Requests\Backend\Web\Cashback\BonusAccrual\BonusAccrualStatus\StoreBonusAccrualStatusRequest;
use App\Http\Requests\Backend\Web\Cashback\BonusAccrual\BonusAccrualStatus\UpdateBonusAccrualStatusRequest;
use App\Repositories\Backend\Cashback\BonusAccrual\BonusAccrualStatus\BonusAccrualStatusRepositoryContract;

class BonusAccrualStatusController extends Controller
{

    private $bonusAccrualStatusRepositoryContract;

    public function __construct(
        BonusAccrualStatusRepositoryContract $bonusAccrualStatusRepositoryContract
    )
    {
        $this->middleware('bonus.accrual.status.can-list', ['only' => ['index']]);
        $this->middleware('bonus.accrual.status.can-show', ['only' => ['show']]);
        $this->middleware('bonus.accrual.status.can-create', ['only' => ['create', 'store']]);
        $this->middleware('bonus.accrual.status.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('bonus.accrual.status.can-delete', ['only' => ['destroy']]);

        $this->bonusAccrualStatusRepositoryContract=$bonusAccrualStatusRepositoryContract;
    }

    public function index()
    {
        $bonusAccrualStatuses = $this->bonusAccrualStatusRepositoryContract->getAll('');
        return view('backend.cashback.bonusAccrual.bonusAccrualStatus.index', compact('bonusAccrualStatuses'));
    }

    public function show($id)
    {
        $data = $this->bonusAccrualStatusRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.bonusAccrualStatus.show', $data);
        return view('backend.cashback.bonusAccrual.bonusAccrualStatus.show', compact('data'));
    }

    public function edit($id)
    {
        $data = $this->bonusAccrualStatusRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.bonusAccrualStatus.edit', $data);
        return view('backend.cashback.bonusAccrual.bonusAccrualStatus.edit', compact('data'));
    }

    public function update(UpdateBonusAccrualStatusRequest $request, $id)
    {
        $data = $this->bonusAccrualStatusRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.bonusAccrualStatus.index');
    }

    public function create()
    {
        return view('backend.cashback.bonusAccrual.bonusAccrualStatus.create');
    }

    public function store(StoreBonusAccrualStatusRequest $request)
    {
        $data = $this->bonusAccrualStatusRepositoryContract->create($request->validated());
        $data->setChanges($data->getAttributes());
        event(new UserModifiedEvent($data, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.bonusAccrualStatus.index');
    }

    public function destroy($id)
    {
        try {
            $data = $this->bonusAccrualStatusRepositoryContract->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.bonusAccrualStatus.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.bonusAccrualStatus.index');
        }
    }


}