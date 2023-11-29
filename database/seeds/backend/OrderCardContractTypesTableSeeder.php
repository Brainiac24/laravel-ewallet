<?php

use App\Models\OrderCardContractType\OrderCardContractType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class OrderCardContractTypesTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => 'ea9b1f85-4aaf-4c04-9e5f-ba3c02293400',
                'code_map' => '339434697',
                'name' => 'Сберегательный счет по ПК_TJS_3% (мизочон)',
                'percentage' => '3',
                'month' => '12',
            ],
            [
                'id' => '20befa8c-d1ce-4e72-b741-d3451c41e617',
                'code_map' => '339434990',
                'name' => 'Сберегательный счет по ПК_USD',
                'percentage' => null,
                'month' => null,
            ],
            [
                'id' => 'fd139e64-db49-46ce-b0c1-50365e9797e7',
                'code_map' => '10665294652',
                'name' => 'Корти ягонаи интиколи пули 3%',
                'percentage' => null,
                'month' => null,
            ],
        ];

        foreach ($vars as $var) {
            try {
                OrderCardContractType::create(['id' => $var['id']], $var);
                //TransactionSyncRule::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
