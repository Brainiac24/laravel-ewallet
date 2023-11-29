<?php

namespace App\Http\Controllers\Backend\Web\User\Profile;

use App\Events\Backend\User\UserChangePassword\UserChangePasswordEvent;
use Breadcrumbs;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\User\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{

    public function profile()
    {
        $user = \Auth::user();
        Breadcrumbs::setCurrentRoute('admin.profile', $user);
        return view('backend.user.profile.profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = \Auth::user();
        if(!empty($data['new_password'])) {
            $user->password = bcrypt($data['new_password']);
            event(new UserChangePasswordEvent($user));
        }
        $user->save();
        session()->flash('flash_message', "Пароль успешно изменен!");
        return redirect()->route('admin.profile');
    }

}

