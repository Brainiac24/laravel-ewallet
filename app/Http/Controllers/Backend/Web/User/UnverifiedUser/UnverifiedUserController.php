<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 30.08.2019
 * Time: 10:59
 */

namespace App\Http\Controllers\Backend\Web\User\UnverifiedUser;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\User\UnverifiedUser\IndexUnverifiedUserRequest;
use App\Repositories\Backend\User\UnverifiedUser\UnverifiedUserRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class UnverifiedUserController extends Controller
{
    /**
     * @var UnverifiedUserRepositoryContract
     */
    private $unverifiedUserRepositoryContract;

    public function __construct(UnverifiedUserRepositoryContract $unverifiedUserRepositoryContract)
    {
        $this->middleware('user.unverifiedUser.can-list', ['only' => ['index']]);
        $this->middleware('user.unverifiedUser.can-show', ['only' => ['show']]);
        $this->unverifiedUserRepositoryContract = $unverifiedUserRepositoryContract;
    }

    public function Index(IndexUnverifiedUserRequest $request)
    {
        $data = $request->validated();

        $unverifiedUsers = $this->unverifiedUserRepositoryContract->paginate($data);
        $unverifiedUsers->appends($request->validated());
        return view('backend.user.unverifiedUser.index', compact('unverifiedUsers', 'data'));
    }

    public function show($id)
    {
        $data = $this->unverifiedUserRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.users.unverifiedUser.show', $data);
        return view('backend.user.unverifiedUser.show', compact('data'));
    }
}