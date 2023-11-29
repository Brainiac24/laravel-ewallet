<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 18.10.2019
 * Time: 13:57
 */

namespace App\Services\Backend\Web\Notification;


use App\Models\Notification\Notification;
use App\Models\User\User;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class NotificationService implements NotificationServiceContract
{
    public function save(string $userId, string $title, string $description)
    {
        $data['id']=Uuid::uuid4();
        $data['type']='news';
        $data['user_id']=$userId;
        $data['title']=$title;
        $data['description']=$description;
        $data['is_active']= true;
        $data['created_at']=  Carbon::now();

        Notification::insert($data);
    }

    public function saveList(array $users, string $title, string $description)
    {
        $notifications=[];

        foreach ($users as $user)
        {
            $data['id']=Uuid::uuid4();
            $data['type']='news';
            $data['user_id']=$user;
            $data['title']=$title;
            $data['description']=$description;
            $data['is_active']= true;
            $data['created_at']=  Carbon::now();

            $notifications[]=$data;
        }

        Notification::insert($notifications);
    }
}