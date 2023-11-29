<?php

namespace App\Http\Controllers\Backend\Web\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\User\Auth\ChangePasswordRequest;
use App\Events\Backend\User\UserChangePassword\UserChangePasswordEvent;

class ChangePasswordController extends Controller
{
    public function changePasswordView()
    {
        $user = \Auth::user();
        return view('backend.auth.passwords.change', compact('user'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = \Auth::user();
        if(!empty($data['new_password'])) {
            $user->password = bcrypt($data['new_password']);
            event(new UserChangePasswordEvent($user));
        }
        $user->save();
        return redirect()->route('admin.dashboard');
    }
}
