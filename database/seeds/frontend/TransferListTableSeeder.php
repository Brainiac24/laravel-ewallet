<?php

use App\Models\TransferList\TransferList;
use Illuminate\Database\Seeder;

class TransferListTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => '167ef477-97e3-49c3-825b-a6af03e40869',
                'code' => 'SONIYA',
                'code_map' => '437637',
                'name' => 'Интиколи дохили',
                'icon_url'=> 'paysend_sendcash.png',
                'desc' => '',
                'is_active' => '1',
            ],
            [
                'id' => '3c5633b1-4f4e-46f3-90b3-df541172b7cb',
                'code' => 'BEST',
                'code_map' => '113214199',
                'name' => 'БЭСТ',
                'icon_url'=>'form_best.png',
                'desc' => '',
                'is_active' => '1',
            ],
            [
                'id' => 'ceaa338f-bd71-4ac2-be8f-2f181f68f306',
                'code' => 'BEGOM',
                'code_map' => '9960470',
                'name' => 'BeGom',
                'icon_url'=> null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '562c7272-7f93-4e4f-ab08-50b3ee3b987f',
                'code' => 'SONIYA_PAYMENT_TEL',
                'code_map' => '19678589',
                'name' => 'СОНИЯ-кабули пардохт тел. мобили',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => 'd77886f4-a113-4f97-bef2-c84a1636e507',
                'code' => 'EXCHANGE_OLD_NOTES',
                'code_map' => '122301592',
                'name' => 'обмен ветхих купюр',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => 'd763dda8-a25f-4375-8db8-6e09acce2ad5',
                'code' => 'POS',
                'code_map' => '10938351',
                'name' => 'Pos-terminal',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '708148fb-2028-4ed0-a159-e6313f2820b8',
                'code' => 'PRIVAT_MONEY',
                'code_map' => '11012556',
                'name' => 'Privat Money',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '44b2ca66-1b69-4e89-9d8b-68b3c3ca89f8',
                'code' => 'F5',
                'code_map' => '86989675',
                'name' => 'F5',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '1d4b7866-540a-4973-a2e9-c433972f4c36',
                'code' => 'MIGOM',
                'code_map' => '476368',
                'name' => 'Мигом',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '6a169a18-6791-460b-9cde-be56341af9a5',
                'code' => 'ANELIK',
                'code_map' => '476318',
                'name' => 'Анелик',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => 'e30b98a4-1f64-4997-8892-bed37a6160c1',
                'code' => 'CONTACT',
                'code_map' => '476376',
                'name' => 'Контакт',
                'icon_url'=>'form_contact.png',
                'desc' => '',
                'is_active' => '1',
            ],
            [
                'id' => '023daced-6350-41d4-9731-57454c9a440a',
                'code' => 'UNISTREAM',
                'code_map' => '476397',
                'name' => 'Юнистрим',
                'icon_url'=>'form_unistream.png',
                'desc' => '',
                'is_active' => '1',
            ],
            [
                'id' => '00cf110a-cdc8-438a-aa6b-5965293be361',
                'code' => 'BLIZKO',
                'code_map' => '476409',
                'name' => 'Близко',
                'icon_url'=>'form_blizko.png',
                'desc' => '',
                'is_active' => '1',
            ],
            [
                'id' => 'aa6caae1-7a75-4d0d-bd0e-79c3110a4ada',
                'code' => 'ZOLOTAYA_KORONA',
                'code_map' => '476424',
                'name' => 'Золотая Корона',
                'icon_url'=>'form_zolotayakorona.png',
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '5d21bd5c-1784-4d05-81cb-58c99778f255',
                'code' => 'INTEREXPRESS',
                'code_map' => '476432',
                'name' => 'Интер Экспресс',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '6b1e5985-c4cd-4fd8-b912-31375b063389',
                'code' => 'LIDER',
                'code_map' => '476447',
                'name' => 'Лидер',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '2c174c4b-58e2-49eb-a1f0-474634deaf14',
                'code' => 'MONEYGRAM',
                'code_map' => '476455',
                'name' => 'МонейГрам',
                'icon_url'=>'form_moneygramm.png',
                'desc' => '',
                'is_active' => '1',
            ],
            [
                'id' => '2853d78b-f025-45e5-84c9-41d288fefd2b',
                'code' => 'SONIYA_PAYMENT',
                'code_map' => '1097066',
                'name' => 'Денежные переводы на оплату услуг',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '571b9723-36b0-4d98-8276-e665ce2ce956',
                'code' => 'SONIYA_ACCOUNT',
                'code_map' => '939454',
                'name' => 'Денежные переводы на тер. РТ пополнение счета',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => 'db8e4972-b95c-416c-a4b4-cd1cb8f88a04',
                'code' => 'INTELEXPRESS',
                'code_map' => '1717920',
                'name' => 'ИнтелЭкспресс',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '7946f703-7e23-4520-af5c-b5c813a0de72',
                'code' => 'BTF_SOUZ',
                'code_map' => '1717923',
                'name' => 'БТФ-СОЮЗ',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => '06f38459-4c28-4e0a-b2e2-7ee3c64ee4ce',
                'code' => 'WU',
                'code_map' => '98964',
                'name' => 'Western Union',
                'icon_url'=>'form_westernunion.png',
                'desc' => '',
                'is_active' => '1',
            ],
            [
                'id' => '1e97c58b-bc46-4130-991d-8d9828907dee',
                'code' => 'BP',
                'code_map' => '98965',
                'name' => 'Быстрая почта',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
            [
                'id' => 'df7cb5be-342d-4fb8-969c-9ecdd9f46c17',
                'code' => 'PROCESSING',
                'code_map' => '3418161',
                'name' => 'Прием платежей',
                'icon_url'=>null,
                'desc' => '',
                'is_active' => '0',
            ],
        ];

        foreach ($vars as $var) {
            try {
                TransferList::create($var);
//                TransferList::updateOrCreate(['id' => $var['id']], $var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
