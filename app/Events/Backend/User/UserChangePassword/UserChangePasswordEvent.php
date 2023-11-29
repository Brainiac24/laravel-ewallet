<?php

namespace App\Events\Backend\User\UserChangePassword;

use App\Models\User\User;

class UserChangePasswordEvent
{
    public $User;

    public function __construct(User $User)
    {
        $this->User = $User;
    }


}