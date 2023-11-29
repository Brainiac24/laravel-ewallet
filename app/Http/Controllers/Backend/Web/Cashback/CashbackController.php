<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 17:43
 */

namespace App\Http\Controllers\Backend\Web\Cashback;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Cashback\StoreCashbackRequest;
use App\Http\Requests\Backend\Web\Cashback\UpdateCashbackRequest;
use App\Repositories\Backend\Cashback\CashbackItem\CashbackItemRepositoryContract;
use App\Repositories\Backend\Cashback\CashbackRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class CashbackController extends Controller
{

    /**
     * @var CashbackRepositoryContract
     */
    private $cashbackRepository;
    /**
     * @var CashbackItemRepositoryContract
     */
    private $cashbackItemRepository;

    /**
     * CashbackController constructor.
     * @param CashbackRepositoryContract $cashbackRepository
     * @param CashbackItemRepositoryContract $cashbackItemRepository
     */
    public function __construct(CashbackRepositoryContract $cashbackRepository, CashbackItemRepositoryContract $cashbackItemRepository)
    {
        $this->middleware('cashback.can-list', ['only' => ['index']]);
        $this->middleware('cashback.can-show', ['only' => ['show']]);
        $this->middleware('cashback.can-create', ['only' => ['create', 'store']]);
        $this->middleware('cashback.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('cashback.can-delete', ['only' => ['destroy']]);
        $this->cashbackRepository = $cashbackRepository;
        $this->cashbackItemRepository = $cashbackItemRepository;
    }

    public function Index()
    {
        $data = $this->cashbackRepository->all('');

        return view('backend.cashback.cashback.index', compact('data'));
    }

    public function show($id)
    {
        //
        $data = $this->cashbackRepository->findById($id);
        $cashBackItems = $this->cashbackItemRepository->GetAllByCashbackId($id);

        Breadcrumbs::setCurrentRoute('admin.cashbacks.show', $data);
        return view('backend.cashback.cashback.show', compact('data', 'cashBackItems'));
    }

    public function create()
    {
        //
        $data = $this->cashbackRepository->all('')->pluck('name', 'id');
        return view('backend.cashback.cashback.create', compact('data'));
    }

    public function store(StoreCashbackRequest $request)
    {
        //
        $data = $request->validated();
        $cashback = $this->cashbackRepository->create($data);
        $cashback->setChanges($cashback->getAttributes());
        event(new UserModifiedEvent($cashback, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.cashbacks.index');
    }

    public function edit($id)
    {
        $data = $this->cashbackRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.cashbacks.edit', $data);
        return view('backend.cashback.cashback.edit', compact('data'));
    }

    public function update(UpdateCashbackRequest $request, $id)
    {
        //
        $data = $this->cashbackRepository->update($request->validated(), $id);

        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.cashbacks.index');
    }

    public function destroy($id)
    {
        //
        try {
            $data = $this->cashbackRepository->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.cashbacks.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.cashbacks.index');
        }
    }
}