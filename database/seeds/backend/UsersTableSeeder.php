<?php

use App\Models\User\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin_id = config('app_settings.role_admin_id');
        $test_apple_client_id = config('app_settings.test_apple_client_id');
        $test_client_id_1 = 'aa3df392-a077-11e8-904b-b06ebfbfa715';
        $test_client_id_2 = '74016b8a-ba71-11e8-92b3-b06ebfbfa715';
        $system_user_id = config('app_settings.system_user_id');
        $merchant_user_id = config('app_settings.default_merchant_user_id');
        $contact_center_user_id = config('app_settings.default_contact_center_user_id');

        $users = [
            [
                'id' => '46ff63db-a077-11e8-904b-b06ebfbfa715',
                'username' => 'sadmin',
                'msisdn' => '0',
                'first_name' => 'Админ',
                'last_name' => 'Администратор',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('SeCRet0070Kk'),
                'attestation_id' => config('app_settings.default_attestation_id'),
                'is_active' => '1',
                'is_admin' => '1',
            ],
            [
                'id' => $test_apple_client_id,
                'username' => '992989157846',
                'msisdn' => '992989157846',
                'pin' => config('app_settings.default_code_apple'),
                'is_auth' => true,
                'first_name' => 'Test iphone',
                'last_name' => 'client',
                'email' => 'K.Hakimboev@eskhata.tj',
                'attestation_id' => config('app_settings.default_attestation_id'),
                'devices_json' => [
                    "id" => "41DC2FA0-9688-4DBF-AFF0-494774476B4112",
                    "name" => "iPhone",
                    "model" => "iPhone",
                    "type" => "iPhone",
                    "appVersion" => "1.0.1",
                    "appMenuVersion" => "1.0",
                    "os" => "10.3.3",
                    "platform" => "0",
                ],
                'is_active' => '1',
            ],
            [
                'id' => $system_user_id,
                'username' => '992000000000',
                'msisdn' => '992000000000',
                //'pin' => config('app_settings.default_code_apple'),
                //'is_auth' => true,
                'first_name' => 'SYSTEM',
                'last_name' => 'SYSTEM',
                'email' => 'system_ewallet@eskhata.tj',
                'attestation_id' => config('app_settings.default_attestation_id'),
                'devices_json' => [
                    "id" => "41DC2FA0-9688-4DBF-AFF0-494774476B4112",
                    "name" => "iPhone",
                    "model" => "iPhone",
                    "type" => "iPhone",
                    "appVersion" => "1.0.1",
                    "appMenuVersion" => "1.0",
                    "os" => "10.3.3",
                    "platform" => "0",
                ],
                'is_active' => '1',
                'is_admin' => '1',
            ],
            [
                'id' => $merchant_user_id,
                'username' => 'MERCHANT',
                'msisdn' => '992111111111',
                //'pin' => config('app_settings.default_code_apple'),
                //'is_auth' => true,
                'first_name' => 'MERCHANT',
                'last_name' => 'MERCHANT',
                'email' => 'merchant_ewallet@eskhata.tj',
                'attestation_id' => config('app_settings.legal_entity_attestation_id'),
                'devices_json' => [
                    "id" => "41DC2FA0-9688-4DBF-AFF0-494774476B4112",
                    "name" => "iPhone",
                    "model" => "iPhone",
                    "type" => "iPhone",
                    "appVersion" => "1.0.1",
                    "appMenuVersion" => "1.0",
                    "os" => "10.3.3",
                    "platform" => "0",
                ],
                'is_active' => '1',
                'is_admin' => '1',
            ],
            [
                'id' => $contact_center_user_id,
                'username' => 'CONTACT_CENTER',
                'msisdn' => '992111111112',
                //'pin' => config('app_settings.default_code_apple'),
                //'is_auth' => true,
                'first_name' => 'CONTACT_CENTER',
                'last_name' => 'CONTACT_CENTER',
                'email' =>  config('app_settings.contact_center_email'),  //'contactcenter@eskhata.tj',
                'attestation_id' => config('app_settings.default_attestation_id'),
                'devices_json' => [
                    "id" => "41DC2FA0-9688-4DBF-AFF0-494774476B4112",
                    "name" => "iPhone",
                    "model" => "iPhone",
                    "type" => "iPhone",
                    "appVersion" => "1.0.1",
                    "appMenuVersion" => "1.0",
                    "os" => "10.3.3",
                    "platform" => "0",
                ],
                'is_active' => '1',
                'is_admin' => '1',
            ],

        ];

        if (\App::environment() == 'production') {
            $session = [];
        } else {
            $session = [
                $test_client_id_1 => [
                    'id' => $test_client_id_1,
                    'user_id' => $test_client_id_1,
                    'access_token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa3htTUhsUGEwNHpaMnhaYkN0SmRHTXJNazVSZW5jOVBTSXNJblpoYkhWbElqb2liRVEzZDNZd1QyUktRV0k0ZWx3dmJrMXVRbVpZTWtoRllraDBjbHd2WlZ3dlZ6VkthR1JwU0V0Y0wyRm1RM1p3UkhKb2VrOW5kV1JGTldSR1hDOWlkRUV4VFVKTlNVbExiMFY2WWpSWFZtSlVRa1ZqYkhwVk5HUjBVMUpDYnpKaUswTTFOM1ZSU2s1T2QybEZLMVpHVW5GTWRuSjRhbTVZV0hRMFlrVm9kVXQ1VWt0RVJIQmliMWxtY1VWSk1rZDVWMkZEYkhCMlIzSkdPRWx4TkdoQk0yODRiMEpSYlVsSlhDOXZNMFF5WkRWalBTSXNJbTFoWXlJNkltRXlObVpqT0dJMk56YzRPVEJsTURnMk5qVTBZVEU0TXpSa01tTmhOekV6WkRNMk0yWXpaVFZrTnpBMU1UY3pObVV5WVRVek56WmpNamMyT1RaaVptTWlmUT09IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NTUyNjAzNDgsInN1YiI6IiIsImF1ZCI6IiJ9.Zo5jJq4ZFvnXXxNxX6eDlc0aRbyM1kskQADA5z3MOos',
                    'refresh_token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa3htTUhsUGEwNHpaMnhaYkN0SmRHTXJNazVSZW5jOVBTSXNJblpoYkhWbElqb2liRVEzZDNZd1QyUktRV0k0ZWx3dmJrMXVRbVpZTWtoRllraDBjbHd2WlZ3dlZ6VkthR1JwU0V0Y0wyRm1RM1p3UkhKb2VrOW5kV1JGTldSR1hDOWlkRUV4VFVKTlNVbExiMFY2WWpSWFZtSlVRa1ZqYkhwVk5HUjBVMUpDYnpKaUswTTFOM1ZSU2s1T2QybEZLMVpHVW5GTWRuSjRhbTVZV0hRMFlrVm9kVXQ1VWt0RVJIQmliMWxtY1VWSk1rZDVWMkZEYkhCMlIzSkdPRWx4TkdoQk0yODRiMEpSYlVsSlhDOXZNMFF5WkRWalBTSXNJbTFoWXlJNkltRXlObVpqT0dJMk56YzRPVEJsTURnMk5qVTBZVEU0TXpSa01tTmhOekV6WkRNMk0yWXpaVFZrTnpBMU1UY3pObVV5WVRVek56WmpNamMyT1RaaVptTWlmUT09IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1MzczNTAzNDgsInN1YiI6IiIsImF1ZCI6IiJ9.UXSsJMpYpofvIR_o8XkkErjWOrwRJtdBsk_5mFGSWpI',
                ],
                $test_client_id_2 => [
                    'id' => $test_client_id_2,
                    'user_id' => $test_client_id_2,
                    'access_token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbGRZU2pkWE5uVlNOaXRZUlVWb2NYWm9aM0ZWWW5jOVBTSXNJblpoYkhWbElqb2lWRE5rYWs5aE1EaDRWVWw2YWxsM01FdFhXa001WVZJM01pdEZkekJaZVU1Y0wwOVpORkZaYXpoWVFuQTVSRE16Tm1sbWJ6RTBNMVJPTmpoRFdHVTFYQzlaZVd3M2RXdzJPWE5JYjBjd2MwWldiRFJWTW1wSGVFRlNVMUExTW5WRVpGaHRWMU41V1RobVpVTmlhbHd2WmxwNVkxY3lUalpuWkRoSFV6QlZSRTFPZEdwc01UZHJhMk5HWWtOQ2QyUm5NbGRPVFRKM2NDc3pOVlZ6WTJ0MFRrMUJSMWM1ZEU0MFVEZHlXbVpqUFNJc0ltMWhZeUk2SW1FM05UTmtOalpqWm1KaU16VTBPRGN3TjJWaE0yTXdaakJsT1RaaE1HTmhNelV4TVdKa00yWXlaak5sTXpZek9EZzNabVZpTnpGbU5URTJOR1UwWXpnaWZRPT0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU1NTI2MTAzMiwic3ViIjoiIiwiYXVkIjoiIn0.sKPwXFoggw-Ff9RywkXivgELNpmkt9PrukPffx1u9QM',
                    'refresh_token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbGRZU2pkWE5uVlNOaXRZUlVWb2NYWm9aM0ZWWW5jOVBTSXNJblpoYkhWbElqb2lWRE5rYWs5aE1EaDRWVWw2YWxsM01FdFhXa001WVZJM01pdEZkekJaZVU1Y0wwOVpORkZaYXpoWVFuQTVSRE16Tm1sbWJ6RTBNMVJPTmpoRFdHVTFYQzlaZVd3M2RXdzJPWE5JYjBjd2MwWldiRFJWTW1wSGVFRlNVMUExTW5WRVpGaHRWMU41V1RobVpVTmlhbHd2WmxwNVkxY3lUalpuWkRoSFV6QlZSRTFPZEdwc01UZHJhMk5HWWtOQ2QyUm5NbGRPVFRKM2NDc3pOVlZ6WTJ0MFRrMUJSMWM1ZEU0MFVEZHlXbVpqUFNJc0ltMWhZeUk2SW1FM05UTmtOalpqWm1KaU16VTBPRGN3TjJWaE0yTXdaakJsT1RaaE1HTmhNelV4TVdKa00yWXlaak5sTXpZek9EZzNabVZpTnpGbU5URTJOR1UwWXpnaWZRPT0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTUzNzM1MTAzMiwic3ViIjoiIiwiYXVkIjoiIn0.t11fTK-dycfL0JZnKttNHnS9VkuFCLDPaDj1FEjWGpM',
                ],
            ];

            $users[] = [
                'id' => $test_client_id_1,
                'username' => '992927668874',
                'msisdn' => '992927668874',
                'pin' => '0258',
                'is_auth' => true,
                'first_name' => 'TEST_NAME_CLIENT_1',
                'last_name' => 'TEST_LASTNAME_CLIENT_1',
                'email' => '',
                'attestation_id' => 'cf8d53eb-a078-11e8-904b-b06ebfbfa715',
                'devices_json' => [
                    "id" => "41DC2FA0-9688-4DBF-AFF0-494774476B4112",
                    "name" => "iPhone",
                    "model" => "iPhone",
                    "type" => "iPhone",
                    "appVersion" => "1.0.1",
                    "appMenuVersion" => "1.0",
                    "os" => "10.3.3",
                    "platform" => "0",
                ],
                'is_active' => '1',
            ];
            $users[] = [
                'id' => $test_client_id_2,
                'username' => '992928553004',
                'msisdn' => '992928553004',
                'pin' => '0369',
                'is_auth' => true,
                'first_name' => 'TEST_NAME_CLIENT_2',
                'last_name' => 'TEST_LASTNAME_CLIENT_2',
                'email' => 'td.brainiac@gmail.com',
                'attestation_id' => config('app_settings.default_attestation_id'),
                'devices_json' => [
                    "id" => "41DC2FA0-9688-4DBF-AFF0-494774476B4112",
                    "name" => "iPhone",
                    "model" => "iPhone",
                    "type" => "iPhone",
                    "appVersion" => "1.0.1",
                    "appMenuVersion" => "1.0",
                    "os" => "10.3.3",
                    "platform" => "0",
                ],
                'is_active' => '1',
            ];

            //dd($users);
        }

        foreach ($users as $user) {
            try {

                //$user = User::updateOrCreate(['id' => $user['id']], $user);
                $user = User::create($user);

                if ($user->username == 'sadmin') {
                    $user->roles()->sync([$role_admin_id]);
                }
                if (\App::environment() == 'local') {
                    if (isset($session[$user->id])) {
                        \App\Models\User\UserSession\UserSession::create($session[$user->id]);
                    }
                }

            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
