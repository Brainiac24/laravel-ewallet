<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 13.07.2018
 * Time: 16:51
 */

namespace App\Repositories\Frontend\User\UserSession;

use App\Models\User\UserSession\UserSession;

interface UserSessionRepositoryContract
{
    public function findByAuth(): ?UserSession;

    public function createOrUpdateForAuth(string $access_token, string $access_token_expires_at, string $refresh_token, string $refresh_token_expires_at);

    public function revokeByAuth();
}