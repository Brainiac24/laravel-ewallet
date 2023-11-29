<?php

use App\Models\PurposeType\PurposeType;
use App\Services\Common\Helpers\PurposeTypes;
use Illuminate\Database\Seeder;

class PurposeTypesTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => PurposeTypes::TRANSFER,
                'code' => 'TRANSFER',
                'name' => 'Назначение перевода',
                'is_active' => '1',
            ],
            [
                'id' => PurposeTypes::CREDIT,
                'code' => 'CREDIT',
                'name' => 'Цель кредита',
                'is_active' => '1',
            ],
            
        ];

        foreach ($vars as $var) {
            try {
                PurposeType::create(['id' => $var['id']], $var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
