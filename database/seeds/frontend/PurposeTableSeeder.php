<?php

use App\Models\Purpose\Purpose;
use App\Services\Common\Helpers\PurposeTypes;
use Illuminate\Database\Seeder;

class PurposeTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vars = [
            [
                'id' => '7bc649f2-0aaa-4591-85a9-a0cc765a519b',
                'code' => 'CURRENT_NEEDS',
                'code_map' => '11267404',
                'name' => 'Барои харочоти чори',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ],
            [
                'id' => '1837e74b-b41a-4b7f-bd38-c5dfa7352261',
                'code' => 'RETURN_PAYMENT',
                'code_map' => '22795551',
                'name' => 'Бозгашти маблаги интиколгардида',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ],
            [
                'id' => 'beb75b42-4398-4764-a7ea-3e4eaa147d88',
                'code' => 'RETURN_BALANCE_CACH',
                'code_map' => '56612874',
                'name' => 'Баргашти маблагхои бокимондаи хазина',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ],
            [
                'id' => 'dd1a5400-fcca-40f3-91bd-e6208ae8bb1b',
                'code' => 'REVENUE_RAILWAY',
                'code_map' => '83154488',
                'name' => 'Маблаг аз фуруши коди рохи охан',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ],
            [
                'id' => '4827d9c6-376e-46a6-ab2f-a54826edf432',
                'code' => 'PRESENT',
                'code_map' => '54558114',
                'name' => 'Тухфа',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ],
            [
                'id' => '01ab7cb0-8f94-48b2-a708-295d1588b5b8',
                'code' => 'PROFIT_SALE',
                'code_map' => '54558351',
                'name' => 'Дахл аз фуруши махсулот',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ],
            [
                'id' => 'a643e4a2-5904-48d2-b911-dc09bec856bf',
                'code' => 'CURRENT_COSTS',
                'code_map' => '476473',
                'name' => 'Барои харочоти чори',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ],
            [
                'id' => '873f0397-c2ba-46d5-a8ef-e1f113acabbb',
                'code' => 'SALARY',
                'code_map' => '476474',
                'name' => 'Маблаги музди мехнат',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ],
            [
                'id' => 'dc71755b-670b-4efb-b3a9-3c4bcb7e6ebc',
                'code' => 'PAYMENT_TREATMENT',
                'code_map' => '476476',
                'name' => 'Пардохти табобати шахсони вокеи',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ]
            ,
            [
                'id' => '1844fc96-f88e-417a-a29b-f4faf1aeeb15',
                'code' => 'HOUSING',
                'code_map' => '476477',
                'name' => 'Барои зист',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ],
            [
                'id' => '96d3e152-6a9c-4c40-bce8-534eadd584a8',
                'code' => 'ALLOWANCES',
                'code_map' => '476478',
                'name' => 'Кумакпули',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ],
            [
                'id' => '60c3fad7-1862-40ee-a5a2-5399121a4d37',
                'code' => 'PAYMENT_LEARNING',
                'code_map' => '476479',
                'name' => 'Пардохти тахсил',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ]
            ,
            [
                'id' => 'f5848dfb-b8bb-4544-b93d-ac66ddef5b45',
                'code' => 'TRAVELING_EXPENSES',
                'code_map' => '2006691',
                'name' => 'Барои рохкиро',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ],
            [
                'id' => '1a0b4b33-6519-41d7-817f-ed6b9fb42338',
                'code' => 'MATERIAL_ASSISTANCE',
                'code_map' => '959559',
                'name' => 'Ёрии модди',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ],
            [
                'id' => '489097c8-73e5-4ab9-8995-8d6a712dbef0',
                'code' => 'PAYMENT_COMMUNICATION',
                'code_map' => '812298',
                'name' => 'Барои хизмати алока',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ]
            ,
            [
                'id' => '598c5710-d005-4b4c-b5ee-104c64aa1fb4',
                'code' => 'PENSION',
                'code_map' => '959560',
                'name' => 'Нафака',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ],
            [
                'id' => 'fabd5687-05c6-4213-8a8a-ee4edc60fd45',
                'code' => 'SUPPLEMENT_ACCOUNT',
                'code_map' => '974995',
                'name' => 'Пур кардани суратхисоб',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ],
            [
                'id' => 'de049b36-50cd-4fe7-8bc3-228071dc9a0b',
                'code' => 'RETURN',
                'code_map' => '831290',
                'name' => 'Баргашт',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ],
            [
                'id' => '4a487798-13ae-4d9c-8b16-86808618d781',
                'code' => 'PAYMENT_SERVICE',
                'code_map' => '84130998',
                'name' => 'Пардохти ичроиши корхо/хизмат-хо',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '0',
            ],
            [
                'id' => 'e20a4b62-17e6-480c-8a0f-634ab1321c7f',
                'code' => 'PAYMENT_ALIMENTED',
                'code_map' => '84131028',
                'name' => 'Пардохти алимент',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::TRANSFER,
                'is_active' => '1',
            ],
            [
                'id' => '79be7f52-3ad7-4689-a4a5-07b3a12205b7',
                'code' => 'FOR_USE',
                'code_map' => '1',
                'name' => 'С потребительской целью',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::CREDIT,
                'is_active' => '1',
            ],
            [
                'id' => 'cce55fae-7f5a-4513-a06d-556133449464',
                'code' => 'FOR_BUSINESS',
                'code_map' => '2',
                'name' => 'С целью развития бизнеса',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::CREDIT,
                'is_active' => '1',
            ],
            [
                'id' => '8615a568-39eb-4f12-b67b-71e447e5fec0',
                'code' => 'FOR_AGRICULTURE',
                'code_map' => '3',
                'name' => 'С целью развития сельского хозяйства',
                'desc' => '',
                'purpose_type_id' => PurposeTypes::CREDIT,
                'is_active' => '1',
            ],
        ];

        foreach ($vars as $var) {
            try {
                //TransactionStatus::create($var);
                Purpose::create(['id' => $var['id']], $var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
