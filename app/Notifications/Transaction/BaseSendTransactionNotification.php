<?php

namespace App\Notifications\Transaction;

use App\Repositories\Frontend\Setting\SettingRepositoryContract;
use App\Services\Common\Gateway\Queue\Channels\Mail\QueueEmailTjChannel;
use App\Services\Common\Gateway\Queue\Channels\Push\QueueFcmChannel;
use App\Services\Common\Gateway\Queue\Channels\QueueSmsTjChannel;
use App\Services\Common\Helpers\Setting;
use Illuminate\Container\Container;
use Illuminate\Notifications\Notification;

class BaseSendTransactionNotification extends Notification
{
    protected $transaction;
    protected $setting;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
        $this->setting = Container::getInstance()->make(SettingRepositoryContract::class);
    }

    public function via($notifiable)
    {
        $channel = null;
        $setting = \json_decode($this->setting->findByKey(Setting::NOTIFICATIONS), true);
        //$setting[0]['code'];

        if (!empty($notifiable->user_settings_json) && !empty($setting)) {
            foreach ($notifiable->user_settings_json as $key => $value) {
                switch ($value['code']) {
                    case Setting::PUSH_NOTIFICATION:
                        foreach ($setting as $setting_item) {
                            if ($setting_item['code'] == $value['code'] && $setting_item['is_enabled'] == 1) {
                                if (isset($value['is_active']) && $value['is_active'] == '1') {
                                    $channel[] = QueueFcmChannel::class;
                                }
                            }
                        }
                        break;
                    case Setting::SMS_NOTIFICATION:
                        foreach ($setting as $setting_item) {
                            if ($setting_item['code'] == $value['code'] && $setting_item['is_enabled'] == 1) {
                                if (isset($value['is_active']) && $value['is_active'] == '1') {
                                    $channel[] = QueueSmsTjChannel::class;
                                }
                            }
                        }
                        break;
                    case Setting::EMAIL_NOTIFICATION:
                        foreach ($setting as $setting_item) {
                            if ($setting_item['code'] == $value['code'] && $setting_item['is_enabled'] == 1) {
                                if (isset($value['is_active']) && $value['is_active'] == '1') {
                                    $channel[] = QueueEmailTjChannel::class;
                                }
                            }
                        }
                        break;
                    default:
                }
            }
        } else {
            $channel[] = QueueFcmChannel::class;
        }

        //dd($channel);

        return $channel;
    }
}
