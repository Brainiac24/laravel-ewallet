<?php

namespace App\Http\Controllers\Backend\Web\User;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\User\IndexUserRequest;
use App\Http\Requests\Backend\Web\User\StoreUserRequest;
use App\Http\Requests\Backend\Web\User\UpdateUserRequest;
use App\Repositories\Backend\Branch\BranchRepositoryContract;
use App\Repositories\Backend\User\Role\RoleRepositoryContract;
use App\Repositories\Backend\User\UserHistory\UserHistoryRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Services\Common\Helpers\Events;
use Carbon\Carbon;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;
    protected $branchRepository;
    /**
     * @var UserHistoryRepositoryContract
     */
    private $userHistoryRepository;

    public function __construct(UserRepositoryContract $userRepository,
                                UserHistoryRepositoryContract $userHistoryRepository ,
                                RoleRepositoryContract $roleRepository,
                                BranchRepositoryContract $branchRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->branchRepository = $branchRepository;
        $this->middleware('user.can-show-list', ['only' => ['index']]);
        $this->middleware('user.can-show-detail', ['only' => ['show']]);
        $this->middleware('user.can-create', ['only' => ['create', 'store']]);
        $this->middleware('user.can-edit-admin', ['only' => ['edit', 'update']]);
        $this->middleware('user.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('user.can-deleteEmail', ['only' => ['deleteEmail']]);
        $this->middleware('user.can-unlock', ['only' => ['unlock']]);
        $this->middleware('user.can-lock', ['only' => ['block']]);
//        $this->middleware('user.can-delete', ['only' => ['destroy']]);
        $this->userHistoryRepository = $userHistoryRepository;
    }

    public function index(IndexUserRequest $request)
    {

        $data = $request->validated();
        $users = $this->userRepository->paginate($data);

        return view('backend.user.index', compact('users','data'));
    }

    public function create()
    {
        $roles = $this->roleRepository->listsAll();
        $branches = $this->branchRepository->listsAll();
        return view('backend.user.create',compact('roles', 'branches'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
        $block_result = false;
        $now = Carbon::now();
        if ($now->diffInSeconds($user->unblock_at, false) > 0 || $user->is_active == false){
            $block_result=true;
        }
        Breadcrumbs::setCurrentRoute('admin.users.edit', $user);
        $roles = $this->roleRepository->listsAll();
        $branches = $this->branchRepository->listsAll();

        $selectedRoles=$user->roles->pluck('id');
        $selectedBranches=$user->branches->pluck('id');
        return view('backend.user.edit', compact('user','roles','selectedRoles','block_result', 'branches','selectedBranches'));
    }

    public function show($id)
    {
        $user = $this->userRepository->findById($id);
        $userHistory = $this->userHistoryRepository->paginateByUserId($id);
        $block_result = false;
        $now = Carbon::now();
        if ($now->diffInSeconds($user->unblock_at, false) > 0 || $user->is_active == false){
            $block_result=true;
        }

        Breadcrumbs::setCurrentRoute('admin.users.show', $user);
        return view('backend.user.show', compact('user', 'userHistory','block_result'));
    }
    public function destroy($id)
    {
        try {
            $user = $this->userRepository->destroy($id);
            event(new UserModifiedEvent($user, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.users.index');
        }
    }
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->create($request->validated());
        $user->setChanges($user->getAttributes());
        event(new UserModifiedEvent($user, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.users.index');
    }

    public function update(UpdateUserRequest $request, $id)
    {

        $user = $this->userRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($user, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.users.index');
    }

    public function unlock($id)
    {
        try {
            $user = $this->userRepository->unlock($id);
            event(new UserModifiedEvent($user, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.users.show', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.users.show', $id);
        }
    }

    public function deleteEmail($id)
    {
        try {
            $user = $this->userRepository->deleteEmail($id);
            event(new UserModifiedEvent($user, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.users.show', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.users.show', $id);
        }
    }
    public function block($id)
    {
        try {
            $user = $this->userRepository->block($id);
            event(new UserModifiedEvent($user, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.users.show', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.users.show', $id);
        }
    }
}
