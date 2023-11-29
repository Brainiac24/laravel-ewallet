<?php

namespace App\Http\Controllers\Backend\Web\User\Role;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\User\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Web\User\Role\UpdateRoleRequest;
use App\Repositories\Backend\User\Permission\PermissionRepositoryContract;
use App\Repositories\Backend\User\Role\RoleRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $permRepository;

    /**
     * RoleController constructor.
     *
     * @param RoleRepositoryContract $roleRepository
     * @param PermissionRepositoryContract $permRepository
     */
    public function __construct(RoleRepositoryContract $roleRepository, PermissionRepositoryContract $permRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permRepository = $permRepository;
        $this->middleware('role.can-manage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->paginate();
        return view('backend.roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perms = $this->permRepository->listAll();
        return view('backend.roles.create')->with('perms', $perms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = $this->roleRepository->create($request->all());
        $role->setChanges($role->getAttributes());
        event(new UserModifiedEvent($role, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.roles.show', $role);
        return view('backend.roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->findById($id);
        $perms = $this->permRepository->listAll();
        $selectedPerms = $role->permissions->pluck('id')->toArray();
//        dd($selectedPerms);
        Breadcrumbs::setCurrentRoute('admin.roles.edit', $role);
        return view('backend.roles.edit', compact('role', 'perms', 'selectedPerms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRoleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = $this->roleRepository->update($request->all(), $id);
        event(new UserModifiedEvent($role, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->destroy($id);
        event(new UserModifiedEvent($role, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.roles.index');
    }
}
