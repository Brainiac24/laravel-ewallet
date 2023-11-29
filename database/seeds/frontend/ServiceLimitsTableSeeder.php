<?php

use App\Models\Service\ServiceLimit\ServiceLimit;
use Illuminate\Database\Seeder;

class ServiceLimitsTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vars = [
            [
                'id' => 'cb31282f-9fb7-11e8-904b-b06ebfbfa715',
                'code' => 'limit_1',
                'name' => 'Лимит на конвертацию иностранной валюты',
                'params_json' => [
                    [
                        "currency" => "972",
                        "balance" => [
                            "min" => 0,
                            "max" => null,
                        ],
                        "day" => [
                            "limit" => 1000,
                            "count" => 10,
                        ],
                        "week" => [
                            "limit" => 10000,
                            "count" => 999,
                        ],
                        "month" => [
                            "limit" => 10000,
                            "count" => 999,
                        ],
                    ],
                ],
            ],
        ];

        foreach ($vars as $var) {
            try {
                //TransactionStatus::create($var);
                ServiceLimit::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
