<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 15:58
 */

namespace App\Http\Controllers\Backend\Web\User\TempUser;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\User\TempUser\IndexTempUsersRequest;
use App\Repositories\Backend\User\TempUser\TempUserRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class TempUsersController extends Controller
{
    /**
     * @var TempUserRepositoryContract
     */
    private $tempUserRepositoryContract;

     public function __construct(TempUserRepositoryContract $tempUserRepositoryContract)
     {
         $this->middleware('user.tempUser.can-list', ['only' => ['index']]);
         $this->middleware('user.tempUser.can-show', ['only' => ['show']]);
         $this->tempUserRepositoryContract = $tempUserRepositoryContract;
     }

    public function Index(IndexTempUsersRequest $request)
    {
        $data = $request->validated();
        $tempUsers = $this->tempUserRepositoryContract->paginate($data);
        $tempUsers->appends($request->validated());
        return view('backend.user.tempUser.index', compact('tempUsers', 'data'));
    }

    public function show($id)
    {
        $data = $this->tempUserRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.users.tempUsers.show', $data);
        return view('backend.user.tempUser.show', compact('data'));
    }
}