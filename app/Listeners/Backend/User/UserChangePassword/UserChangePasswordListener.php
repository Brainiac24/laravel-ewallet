<?php

namespace App\Listeners\Backend\User\UserChangePassword;

use App\Models\User\User;
use Carbon\Carbon;

class UserChangePasswordListener
{
    public function handle($event)
    {
        if($event->User instanceof User) {
            $User = $event->User;
            $password_params_json = !empty($User->password_params_json) ? $User->password_params_json : [];
            $password_params_json["is_change_password"] = false;
            $password_params_json["last_changed_password"] = Carbon::now()->format("Y-m-d H:i:s");
            $User->password_params_json = $password_params_json;
            $User->save();
        }
    }
}
