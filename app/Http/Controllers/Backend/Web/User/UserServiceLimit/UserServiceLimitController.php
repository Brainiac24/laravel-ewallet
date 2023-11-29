<?php

namespace App\Http\Controllers\Backend\Web\User\UserServiceLimit;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\User\UserServiceLimit\IndexUserServiceLimitRequest;
use App\Http\Requests\Backend\Web\User\UserServiceLimit\StoreUserServiceLimitRequest;
use App\Http\Requests\Backend\Web\User\UserServiceLimit\UpdateUserServiceLimitRequest;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Repositories\Backend\User\UserServiceLimit\UserServiceLimitRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class UserServiceLimitController extends Controller
{
    protected $userServiceLimitRepository;
    protected  $userRepository;
    protected  $services;

    public function __construct(UserServiceLimitRepositoryContract $userServiceLimitRepository, UserRepositoryContract $userRepository, ServiceRepositoryContract $services)
    {
        $this->userServiceLimitRepository = $userServiceLimitRepository;
        $this->userRepository= $userRepository;
        $this->services= $services;
        $this->middleware('user.limit.can-list', ['only' => ['index']]);
        $this->middleware('user.limit.can-show', ['only' => ['show']]);
        $this->middleware('user.limit.can-create', ['only' => ['create','store']]);
        $this->middleware('user.limit.can-edit', ['only' => ['edit','update']]);
        $this->middleware('user.limit.can-delete', ['only' => ['destroy']]);
    }

    public function index(IndexUserServiceLimitRequest $request)
    {
        $data=$request->validated();
        $userServiceLimits = $this->userServiceLimitRepository->paginate($data);
        $services = $this->services->allPluck();
       // dd($data);
        return view('backend.user.serviceLimit.index',compact('userServiceLimits','data','services'));
    }

    public function create()
    {
//        $users = $this->userRepository->listsAll();
//        $services= $this->services->all()->pluck('name','id');
//        return view('backend.user.serviceLimit.create',compact('users','services'));
    }

    public function edit($id)
    {
        $userServiceLimit = $this->userServiceLimitRepository->findById($id);
        $selectedUsers = $userServiceLimit->user_id;
        $users = $this->userRepository->listsAll();
        $services= $this->services->all()->pluck('name','id');
        Breadcrumbs::setCurrentRoute('admin.users.services.limits.edit', $userServiceLimit);
        return view('backend.user.serviceLimit.edit',compact('userServiceLimit','selectedUsers','users','services'));
    }

    public function show($id)
    {
        $userServiceLimit = $this->userServiceLimitRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.users.services.limits.show', $userServiceLimit);
        return view('backend.user.serviceLimit.show',compact('userServiceLimit'));
    }

    public function destroy($id)
    {
        try {
            $userServiceLimit = $this->userServiceLimitRepository->destroy($id);
            event(new UserModifiedEvent($userServiceLimit, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.users.services.limits.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.users.services.limits.index');
        }
    }

    public function store(StoreUserServiceLimitRequest $request)
    {
        $userServiceLimit = $this->userServiceLimitRepository->create($request->validated());
        $userServiceLimit->setChanges($userServiceLimit->getAttributes());
        event(new UserModifiedEvent($userServiceLimit, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.users.services.limits.index');
    }

    public function update(UpdateUserServiceLimitRequest $request, $id)
    {
        $userServiceLimit = $this->userServiceLimitRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($userServiceLimit, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.users.services.limits.index');
    }
}
