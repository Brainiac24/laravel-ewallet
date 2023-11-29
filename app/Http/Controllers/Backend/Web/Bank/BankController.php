<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.07.2019
 * Time: 17:49
 */

namespace App\Http\Controllers\Backend\Web\Bank;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Bank\IndexBankRequest;
use App\Http\Requests\Backend\Web\Bank\StoreBankRequest;
use App\Http\Requests\Backend\Web\Bank\UpdateBankRequest;
use App\Repositories\Backend\Bank\BankRepositoryContract;
use App\Services\Backend\Web\ExportJob\BankExportJob\BankExportJobService;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class BankController extends Controller
{
    /**
     * @var BankRepositoryContract
     */
    private $bankRepositoryContract;


    private $bankExportJobService;
    /**
     * BankController constructor.
     * @param BankRepositoryContract $bankRepositoryContract
     */
    public function __construct(BankRepositoryContract $bankRepositoryContract, BankExportJobService $service)
    {
        $this->bankRepositoryContract = $bankRepositoryContract;
        $this->bankExportJobService = $service;

        $this->middleware('bank.can-list', ['only' => ['index']]);
        $this->middleware('bank.can-show', ['only' => ['show']]);
        $this->middleware('bank.can-create', ['only' => ['create', 'store']]);
        $this->middleware('bank.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('bank.can-delete', ['only' => ['destroy']]);
    }

    public function index(IndexBankRequest $request)
    {
        $data = $request->validated();

        if ($request->export ?? false == true) {
            try{
                $this->bankExportJobService->create($data);
                session()->flash('flash_message', "Задача для формирование отчета создано. Вы сможете найти свою выгрузку в разделе \"Задачи\"");
                return redirect()->route('admin.banks.index');
            }catch (\Exception $e)
            {
                session()->flash('flash_message_error', $e->getMessage());
                return redirect()->route('admin.banks.index');
            }
        } else {
            $banks = $this->bankRepositoryContract->paginate($data);
            $banks->appends($request->validated());

            return view('backend.bank.index', compact('banks', 'data'));
        }
    }

    public function show($id)
    {
        //
        $bank = $this->bankRepositoryContract->getById($id);

        Breadcrumbs::setCurrentRoute('admin.bank.show', $bank);
        return view('backend.bank.show', compact('bank'));
    }

    public function create()
    {
        $maxPosition = $this->bankRepositoryContract->getMaxPosition();
        $bank = $this->bankRepositoryContract->all('')->pluck('name', 'id');

        return view('backend.bank.create', compact('bank', 'maxPosition'));
    }

    public function store(StoreBankRequest $request)
    {
        //
        $bank = $this->bankRepositoryContract->create($request->validated());
        $bank->setChanges($bank->getAttributes());
        event(new UserModifiedEvent($bank, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.banks.index');
    }

    public function edit($id)
    {
        $bank = $this->bankRepositoryContract->getById($id);
        $maxPosition = $this->bankRepositoryContract->getMaxPosition();
        Breadcrumbs::setCurrentRoute('admin.bank.edit', $bank);

        return view('backend.bank.edit', compact('bank','maxPosition'));
    }

    public function update(UpdateBankRequest $request, $id)
    {
        //
        $bank = $this->bankRepositoryContract->update($request->validated(), $id);

        event(new UserModifiedEvent($bank, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.banks.index');
    }

    public function destroy($id)
    {
        //
        try {
            $bank = $this->bankRepositoryContract->destroy($id);
            event(new UserModifiedEvent($bank, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.banks.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.banks.index');
        }
    }
}