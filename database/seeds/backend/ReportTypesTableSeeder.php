<?php

use App\Models\ReportType\ReportType;

class ReportTypesTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ["id" => "f600b3a3-19ca-11eb-8056-92baed747b10", "code" => "Clients", "name" => "Клиенты"],
            ["id" => "f9676dd6-19ca-11eb-8056-92baed747b10", "code" => "Merchants", "name" => "Список Мерчантов"],
            ["id" => "fc73fd2e-19ca-11eb-8056-92baed747b10", "code" => "RemoteIdentifications", "name" => "Список заявок на Удаленную Идентификации"],
            ["id" => "ffa43f17-19ca-11eb-8056-92baed747b10", "code" => "Transactions", "name" => "Транзакция"],
            ["id" => "da0bae1d-19e1-11eb-8056-92baed747b10", "code" => "MerchantQrTransactions", "name" => "Мерчант(Транзакция по QR оплатам)"],
            ["id" => "cdaa87b3-1cdb-11eb-b8f7-7d5e5db9887c", "code" => "BeetweenEwalletEskhataTransactions", "name" => "Транзакция между кошельками"],
            ["id" => "qaaf89b3-0cdb-11eq-b8g7-7d5e5df9807c", "code" => "ReplenishmentEwalletEskhataTransactions", "name" => "Пополнение Эсхата онлайн"],
            ["id" => "da0bae1d-1cgb-11ab-56f7-7d5e5db9887c", "code" => "TransactionAnalysisEwalletEskhata", "name" => "Электронный кошелек для анализа транзакций"],
            ["id" => "4b10f854-9c8d-4af1-a25e-50f8f162752d", "code" => "DepositOpeningOrders", "name" => "Заявки на открытие депозита"],
            ["id" => "13cdabb9-42a6-11ec-bde1-0068eb77ce29", "code" => "KortiMilliTransactions", "name" => "Транзакции - Корти милли других банков"],
        ];

        foreach ($items as $item) {
            try {
                ReportType::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
