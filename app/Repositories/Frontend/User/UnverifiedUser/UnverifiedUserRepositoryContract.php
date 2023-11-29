<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 13.07.2018
 * Time: 16:51
 */

namespace App\Repositories\Frontend\User\UnverifiedUser;


use App\Models\User\UnverifiedUser\UnverifiedUser;

interface UnverifiedUserRepositoryContract
{
    public function findByMsisdn(string $msisdn) : ?UnverifiedUser;

    public function create(string $msisdn, array $device);

    public function updateSmsCodeByModel(UnverifiedUser $user);

    public function incrementSmsConfirmTryCount(UnverifiedUser $msisdn);
}