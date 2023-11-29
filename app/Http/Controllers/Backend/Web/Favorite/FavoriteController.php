<?php

namespace App\Http\Controllers\Backend\Web\Favorite;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Favorite\IndexFavoriteRequest;
use App\Http\Requests\Backend\Web\Favorite\StoreFavoriteRequest;
use App\Http\Requests\Backend\Web\Favorite\UpdateFavoriteRequest;
use App\Repositories\Backend\Favorite\FavoriteRepositoryContract;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class FavoriteController extends Controller
{
    protected $favorite;
    protected  $userRepository;
    protected  $services;

    public function __construct(FavoriteRepositoryContract $favorite, UserRepositoryContract $userRepository , ServiceRepositoryContract $services)
    {
        $this->favorite = $favorite;
        $this->userRepository = $userRepository;
        $this->services=$services;
        $this->middleware('user.favorite.can-list', ['only' => ['index']]);
        $this->middleware('user.favorite.can-show', ['only' => ['show']]);
        $this->middleware('user.favorite.can-create', ['only' => ['create','store']]);
        $this->middleware('user.favorite.can-edit', ['only' => ['edit','update']]);
        $this->middleware('user.favorite.can-delete', ['only' => ['destroy']]);
    }

    public function index(IndexFavoriteRequest $request)
    {
        $data = $request->validated();
        $favorites = $this->favorite->paginate($data);
        return view('backend.user.favorite.index',compact('favorites','data'));
    }

    public function create()
    {
        $services = $this->services->all()->pluck('name','id');
        $users = $this->userRepository->listsAll();
        return view('backend.user.favorite.create' , compact('users','services'));
    }

    public function edit($id)
    {
        $users = $this->userRepository->listsAll();
        $services = $this->services->all()->pluck('name','id');
        $favorite = $this->favorite->findById($id);
        $selectedUsers = $favorite->user_id;
        Breadcrumbs::setCurrentRoute('admin.favorites.edit', $favorite);
        return view('backend.user.favorite.edit',compact('favorite','users','selectedUsers','services'));
    }

    public function show($id)
    {

        $favorite= $this->favorite->findById($id);
        Breadcrumbs::setCurrentRoute('admin.favorites.show', $favorite);
        return view('backend.user.favorite.show', compact('favorite'));
    }

    public function destroy($id)
    {
        try {
            $favorite = $this->favorite->destroy($id);
            event(new UserModifiedEvent($favorite, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.favorites.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.favorites.index');
        }
    }

    public function store(StoreFavoriteRequest $request)
    {
        $data = $request->validated();
        $data['params_json'] = json_decode($data['params_json']);
        $favorite = $this->favorite->create($data);
        $favorite->setChanges($favorite->getAttributes());
        event(new UserModifiedEvent($favorite, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.favorites.index');
    }

    public function restore($id)
    {
        try {
            $favorite = $this->favorite->restore($id);
            event(new UserModifiedEvent($favorite, Events::RESTORED));
            session()->flash('flash_message', trans('alerts.general.success_restore'));
            return redirect()->route('admin.favorites.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.favorites.index');
        }
    }

    public function update(UpdateFavoriteRequest $request, $id)
    {
        $data = $request->validated();
        $data['params_json'] = json_decode($data['params_json']);
        $favorite = $this->favorite->update($data, $id);
        event(new UserModifiedEvent($favorite, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.favorites.index');
    }
}
