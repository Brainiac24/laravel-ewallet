<?php


namespace App\Http\Controllers\Backend\Web\Branch;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Branch\StoreBranchRequest;
use App\Http\Requests\Backend\Web\Branch\UpdateBranchRequest;
use App\Repositories\Backend\Branch\BranchRepositoryContract;
use App\Services\Common\Helpers\Events;

class BranchController extends Controller
{
    protected $branchRepository;

    public function __construct(BranchRepositoryContract $branchRepository)
    {
        $this->branchRepository = $branchRepository;

        $this->middleware('branch.can-list', ['only' => ['index']]);
        $this->middleware('branch.can-show', ['only' => ['show']]);
        $this->middleware('branch.can-create', ['only' => ['create', 'store']]);
        $this->middleware('branch.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('branch.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $branches = $this->branchRepository->paginate();
        return view('backend.branch.index', compact('branches'));
    }

    public function show($id)
    {
        $branch = $this->branchRepository->getById($id);
        \Breadcrumbs::setCurrentRoute('admin.branches.show', $branch);
        return view('backend.branch.show', compact('branch'));
    }

    public function create()
    {
        return view('backend.branch.create');
    }

    public function store(StoreBranchRequest $request)
    {
        //
        $branch = $this->branchRepository->create($request->validated());
        $branch->setChanges($branch->getAttributes());
        event(new UserModifiedEvent($branch, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.branches.index');
    }

    public function edit($id)
    {
        $branch = $this->branchRepository->getById($id);

        \Breadcrumbs::setCurrentRoute('admin.branches.edit', $branch);
        return view('backend.branch.edit', compact('branch'));
    }

    public function update(UpdateBranchRequest $request, $id)
    {
        //
        $branch = $this->branchRepository->update($request->validated(), $id);

        event(new UserModifiedEvent($branch, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.branches.index');
    }

    public function destroy($id)
    {
        try {
            $bank = $this->branchRepository->destroy($id);
            event(new UserModifiedEvent($bank, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.branches.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.branches.index');
        }
    }
}