<?php

use App\Models\User\UserSessionCodeChannel\UserSessionCodeChannel;
use Illuminate\Database\Seeder;

class UserSessionCodeChannelTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        try {
            $items = [
                [
                    'id' => config('app_settings.user_session_code_channel_sms'),
                    'code' => 'sms',
                    'name' => 'SMS - оповещение',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.user_session_code_channel_email'),
                    'code' => 'email',
                    'name' => 'Email - оповещение',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.user_session_code_channel_push'),
                    'code' => 'push',
                    'name' => 'Push - оповещение',
                    'is_active' => '1',
                ]
            ];

            foreach ($items as $item) {
                try {
                    $cat = UserSessionCodeChannel::create(['id' => $item['id']], $item);
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
