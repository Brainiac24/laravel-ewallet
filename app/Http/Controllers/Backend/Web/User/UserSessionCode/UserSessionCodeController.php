<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 02.09.2019
 * Time: 11:33
 */

namespace App\Http\Controllers\Backend\Web\User\UserSessionCode;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\User\UserSessionCode\IndexUserSessionCodeRequest;
use App\Repositories\Backend\User\UserSessionCode\UserSessionCodeRepositoryContract;
use App\Repositories\Backend\User\UserSessionCodeType\UserSessionCodeTypeRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class UserSessionCodeController extends Controller
{
    /**
     * @var UserSessionCodeRepositoryContract
     */
    private $sessionCodeRepositoryContract;
    /**
     * @var UserSessionCodeTypeRepositoryContract
     */
    private $userSessionCodeTypeRepositoryContract;

    public function __construct(UserSessionCodeRepositoryContract $sessionCodeRepositoryContract, UserSessionCodeTypeRepositoryContract $userSessionCodeTypeRepositoryContract)
    {
        $this->middleware('user.userSessionCode.can-list', ['only' => ['index']]);
        $this->middleware('user.userSessionCode.can-show', ['only' => ['show']]);
        $this->sessionCodeRepositoryContract = $sessionCodeRepositoryContract;
        $this->userSessionCodeTypeRepositoryContract = $userSessionCodeTypeRepositoryContract;
    }

    public function Index(IndexUserSessionCodeRequest $request)
    {
        $data = $request->validated();
        $filterUserSessionCodeTypes = $this->userSessionCodeTypeRepositoryContract->getAll('')->pluck('name','id')->toArray();
        $userSessionCodes = $this->sessionCodeRepositoryContract->paginate($data);
        return view('backend.user.userSessionCode.index', compact('userSessionCodes', 'data','filterUserSessionCodeTypes'));
    }

    public function show($id)
    {
        $data = $this->sessionCodeRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.users.userSessionCode.show', $data);
        return view('backend.user.userSessionCode.show', compact('data'));
    }
}