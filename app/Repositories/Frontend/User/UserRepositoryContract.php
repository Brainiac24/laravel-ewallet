<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 13.07.2018
 * Time: 16:51
 */

namespace App\Repositories\Frontend\User;

use App\Models\User\User;

interface UserRepositoryContract
{
    public function findByMsisdn(string $msisdn): ?User;

    public function findById(string $id): ?User;

    public function create(array $user);

    public function updateSmsCodeByModel(User $user);

    public function updateEmailCodeByModel(User $user);

    public function incrementSmsConfirmTryCount(User $user);

    public function incrementEmailConfirmTryCount(User $user);

    public function incrementPinConfirmTryCount(User $user);

    public function incrementPinChangeTryCount(User $user);

    public function savePinByUser(User $user, string $pin);

    public function saveChangePinByUser(User $user, string $pin);

    public function saveDeviceByUser(User $user, array $device);

    public function saveTmpEmailByUser(User $user, string $email);

    public function saveEmailByUser(User $user, string $email);

    public function update(array $data, $id, $eventCode=null);

    public function updateLastLoginAt(User $user);

    public function setAttestation($user_id, $verification_confirm, $attestation_id = null);

}