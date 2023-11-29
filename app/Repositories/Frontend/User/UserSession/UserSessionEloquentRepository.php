<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 13.07.2018
 * Time: 16:58
 */

namespace App\Repositories\Frontend\User\UserSession;


use App\Models\User\UserSession\UserSession;
use Carbon\Carbon;

class UserSessionEloquentRepository implements UserSessionRepositoryContract
{
    protected $userSession;

    /**
     * UserSessionEloquentRepository constructor.
     * @param $userSession
     */
    public function __construct(UserSession $userSession)
    {
        $this->userSession = $userSession;
    }

    public function findByAuth(): ?UserSession
    {
        return $this->userSession->where('user_id', \Auth::id())->first();
    }

    public function createOrUpdateForAuth(string $access_token, string $access_token_expires_at, string $refresh_token, string $refresh_token_expires_at): UserSession
    {
        $userSession = $this->findByAuth();

        if ($userSession === null) {
            $userSession = new UserSession();
            $userSession->user_id = \Auth::id();
            $userSession->access_token = $access_token;
            $userSession->access_token_expires_at = $access_token_expires_at;
            $userSession->refresh_token = $refresh_token;
            $userSession->refresh_token_expires_at = $refresh_token_expires_at;
            $userSession->save();
        } else {

            $userSession->access_token = $access_token;
            $userSession->access_token_expires_at = $access_token_expires_at;
            $userSession->refresh_token = $refresh_token;
            $userSession->refresh_token_expires_at = $refresh_token_expires_at;
            $userSession->save();
            //dd($userSession->getAttributes());
        }

        return $userSession;
    }

    public function revokeByAuth()
    {
        $userSession = $this->findByAuth();
        $userSession->setOldAttributes($userSession->getAttributes());

        if ($userSession !== null) {
            $userSession->access_token = null;
            $userSession->refresh_token = null;
            $userSession->revoked_at = Carbon::now();
            $userSession->save();
        }

        return $userSession;

    }

}