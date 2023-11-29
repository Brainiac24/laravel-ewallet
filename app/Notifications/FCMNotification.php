<?php

namespace App\Notifications;

use App\Services\Common\Gateway\FCMMessage\FCMMessageCustom;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class FCMNotification extends Notification
{
    //use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $messageToSend;

    public function __construct($messageToSend)
    {
        //
       $this->messageToSend = $messageToSend;
    }

    public function via($notifiable)
    {
        return ['fcm'];
    }

    /**
     * @param $notifiable
     * @return FcmMessage
     */
    public function toFcm($notifiable)
    {
//INITIALIZE
        $notifiable['title'] = $this->messageToSend['title'];
        $notifiable['message'] = $this->messageToSend['message'];
        $notifiable['sound'] = 'beep';
        $notifiable['icon'] = '';
        $notifiable['click_action'] = $this->messageToSend['click_action'];
        $notifiable['param1'] = $this->messageToSend['param1'];
        $notifiable['UUID'] = $this->messageToSend['UUID'];
        $notifiable['private_state'] = 1;
//END INITIALIZE
        $message = new FCMMessageCustom();
        $message->content([
            'title' => $notifiable['title'],
            'body' => $notifiable['message'],
            'sound' => $notifiable['sound'], // Optional
            'icon' => $notifiable['icon'], // Optional
            'click_action' => $notifiable['click_action'] // Optional
        ])->data([
            'param1' => $notifiable['param1'] // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.
        $message->payload = ['user_id' => $notifiable['id'], 'device_token' => $notifiable['device_token'], 'title' => $notifiable['title'], 'message' => $notifiable['message'], 'params' => $notifiable['param1'], 'click_action' => $notifiable['click_action'], 'sound' => $notifiable['sound'], 'icon' => $notifiable['icon'], 'private_status' => $notifiable['private_state'], 'uuid' => $notifiable['UUID']];
        Log::info('[SUCCESS SENDING PUSH] ' . $message->payload['uuid'] . ' to_user_id = ' . $notifiable['id'] . ' USING TEXT:' . $message->payload['message'] . ' with title:' . $message->payload['title']);
        return $message;
    }
}
