<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 18.10.2019
 * Time: 13:57
 */

namespace App\Services\Backend\Web\Notification;


use App\Models\User\User;

interface NotificationServiceContract
{
    public function save(string $userId, string $title, string $description);
    public function saveList(array $users, string $title, string $description);
}