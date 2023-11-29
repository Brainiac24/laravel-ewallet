<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 15:37
 */

namespace App\Http\Controllers\Backend\Web\TransferList;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\TransferList\StoreTransferListRequest;
use App\Http\Requests\Backend\Web\TransferList\UpdateTransferListRequest;
use App\Repositories\Backend\TransferList\TransferListRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class TransferListController extends Controller
{
    /**
     * @var TransferListRepositoryContract
     */
    private $transferListRepositoryContract;

    public function __construct(TransferListRepositoryContract $transferListRepositoryContract)
    {
        $this->middleware('transferList.can-list', ['only' => ['index']]);
        $this->middleware('transferList.can-show', ['only' => ['show']]);
        $this->middleware('transferList.can-create', ['only' => ['create','store']]);
        $this->middleware('transferList.can-edit', ['only' => ['edit','update']]);
        $this->middleware('transferList.can-delete', ['only' => ['destroy']]);

        $this->transferListRepositoryContract = $transferListRepositoryContract;
    }

    public function index()
    {
        $data = $this->transferListRepositoryContract->all();
        //dd($data);
        return view('backend.transferList.index', compact('data'));
    }

    public function show($id)
    {
        $data = $this->transferListRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transferList.show', $data);
        return view('backend.transferList.show',compact('data'));
    }

    public function create()
    {
        return view('backend.transferList.create');
    }

    public function store(StoreTransferListRequest $request)
    {
        //
        $data = $this->transferListRepositoryContract->create($request->validated());
        $data->setChanges($data->getAttributes());
        event(new UserModifiedEvent($data, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.transferList.index');
    }

    public function edit($id)
    {
        //dd($id);
        $data = $this->transferListRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transferList.edit', $data);
        return view('backend.transferList.edit', compact('data'));
    }

    public function update(UpdateTransferListRequest $request, $id)
    {
        $data = $this->transferListRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.transferList.index');
    }

    public function destroy($id)
    {
        try {
            $data = $this->transferListRepositoryContract->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_disable'));
            return redirect()->route('admin.transferList.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.transferList.index');
        }
    }
}