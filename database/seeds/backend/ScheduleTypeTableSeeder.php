<?php


use Database\Seeds\BaseSeeder;
use App\Services\Common\Helpers\ScheduleType;

class ScheduleTypeTableSeeder extends Database\Seeds\BaseSeeder
{

    public function run()
    {
        $items = [
            [
                'id' => 'b4723afb-c33f-445f-bb2a-dd96c7b052ef',
                'name' => 'Отправить отчет по мерчантам в почту',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\Merchant\SendEmailReportMerchantCommand::class,
            ],
            [
                'id' => '76ebd196-f754-4c32-8bcc-f444efd05cb5',
                'name' => 'Получить курс валюты',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\CurrencyRate\GetCurrencyRate::class,
            ],
            [
                'id' => 'f2f52fcd-01cc-4992-9ffc-377e0a02957f',
                'name' => 'Получить курс валюты для перевода',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\CurrencyRate\GetCurrencyRateCategoryCommand::class,
            ],
            [
                'id' => '212d7fbf-d80e-4145-9ad5-499c1c517fad',
                'name' => 'Команда отправки транзакций в систему abs для синхронизации',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\AbsTasks\AbsCreateTransactionCommand::class,
            ],
            [
                'id' => 'eb447c85-28b0-431d-846d-3f81379fc0f5',
                'name' => 'Команда вывода денег на мерчант аккаунт',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\AbsTasks\WithdrawMoneyToMerchantAccountCommand::class,
            ],
            [
                'id' => '932799d1-4c88-4090-ac86-1e65e64e46f1',
                'name' => 'Создать отчет Excell в 00:00 ч. Остаток остатков',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\AccountingReport\BuildReportOn00hr::class,
            ],
            [
                'id' => 'fd04fd0c-4a84-4986-bbf8-9783a4d351f6',
                'name' => 'Обновить данные в таблице Пользовательский столбец UserSettingsJson удалить кавычки из свойства активен',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ChangesForMigrateToAspNetCore\ChangeDataInUserColumnUserSettingsJsonRemoveQuoteFromIsActive::class,
            ],
            [
                'id' => 'ffc52b64-af44-4c4e-895a-7ff7a014c810',
                'name' => 'Идентифицирует существующих пользователей из таблицы temp_users ',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\IdentificateExistedUsers\IdentificateExistedUsers::class,
            ],
            [
                'id' => '79cacce7-0f16-4749-9171-732765a53b73',
                'name' => 'Загружает данные терминала в таблицу account_status',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportAccountStatus\AccountStatusImporter::class,
            ],
            [
                'id' => '713b98f2-d600-49ab-baa1-8a229fe54653',
                'name' => 'Загружает данные терминала в таблицу account_types (account_list)',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportAccountTypes\AccountListAccountTypesImporter::class,
            ],
            [
                'id' => 'db0c697b-24e0-4ad7-9796-8989517b2556',
                'name' => 'Загружает данные терминала в таблицу account_types (credit_list)',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportAccountTypes\CreditListAccountTypesImporter::class,
            ],
            [
                'id' => 'b6f59589-6f42-42d2-90b6-39a959b2a938',
                'name' => 'Загружает данные терминала в таблицу account_types (deposit_list)',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportAccountTypes\DepositListAccountTypesImporter::class,
            ],
            [
                'id' => '7df58244-4117-4136-9a3e-abaa9164a0df',
                'name' => 'Загружает данные областей в таблицу',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportAreas\AreaImporter::class,
            ],
            [
                'id' => '04266ed1-3059-4eb8-a4f2-d380c430e8e6',
                'name' => 'Загружает данные банкоматов в таблицу Coordin_points',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportBankomats\BankomatCoordinatePointsImporter::class,
            ],
            [
                'id' => '65a4fc35-2464-4b79-b8f8-797e4361df91',
                'name' => 'Загружает данные терминала в таблицу банков',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportBanks\BankImporter::class,
            ],
            [
                'id' => '8193f4ef-95f6-4bf0-997f-5822fb46bf56',
                'name' => 'Загружает данные о городах в таблицу',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportCities\AreaImporter::class,
            ],
            [
                'id' => 'b83eb891-e9f5-4345-90b8-e0ef6238b984',
                'name' => 'Загружает данные о регионах в таблицу',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportRegions\RegionImporter::class,
            ],
            [
                'id' => '437c8cf2-009b-4da8-8790-db4c8d75f694',
                'name' => 'Загружает данные о филиалах в таблицу coordinate_points',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportFilials\FilialCoordinatePointsImporter::class,
            ],
            [
                'id' => '0283d4ea-94b5-4091-9f25-ff560b57363d',
                'name' => 'Загружает данные терминала в таблицу Coordin_points',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ImportTerminalCoordinatePoints\TerminalCoordinatePointsImporter::class,
            ],
            [
                'id' => 'eec29fa2-871d-4fd0-938a-d485a9709976',
                'name' => 'Импортирует данные о местонахождении из файла Excel с именем: location.xlsx.',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\LocationsDataImporter\LocationsDataImporter::class,
            ],
            [
                'id' => 'd888e0c9-2db3-43a1-8653-67dca91b70d5',
                'name' => 'Команда для создания бонусных счетов для всех клиентов',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\OneTimeCommands\CreateBonusAccountsCommand::class,
            ],
            [
                'id' => '0713419f-276b-4538-8f41-dd10f1d55fad',
                'name' => 'Команда для создания аккаунтов для всех торговцев',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\OneTimeCommands\CreateMerchantAccountsCommand::class,
            ],
            [
                'id' => '1bf8fd64-cd33-4b6f-ad19-6644079905b2',
                'name' => 'Проверка учетных записей',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\Order\IdentificationAccountsCheck::class,
            ],
            [
                'id' => 'e793caf8-31e4-4840-a7dd-5319e7e7d2d2',
                'name' => 'Продолжит заявку, когда is_queued == -1',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\Order\OrderContinueProcess::class,
            ],
            [
                'id' => '1bf8fd64-cd33-4b6f-ad19-6644079905b2',
                'name' => 'Ранее идентифицированные пользователи',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\PreviouslyIdentifiedUsers\PreviouslyIdentifiedUsers::class,
            ],
            [
                'id' => 'e793caf8-31e4-4840-a7dd-5319e7e7d2d2',
                'name' => 'Команда отчета о назначении разделителя',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ReportBuilder\BuildDelimiterPurposeReportCommand::class,
            ],
            [
                'id' => 'b9351e10-89b5-4f7d-891f-2812408b703d',
                'name' => 'Создать отчет Excell в 00:00 ч. Остаток остатков',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\ReportBuilder\BuildReportOn00hr::class,
            ],
            [
                'id' => '5fce6689-f7c7-4347-bd0d-b33b4f379bc8',
                'name' => 'Загружает временных пользователей в таблицу temp_users',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\TempUserLoader\TempUserLoader::class,
            ],
            [
                'id' => '1316911b-40d6-4ec1-a43f-f3d44bd6c313',
                'name' => 'Продолжит транзакцию, когда is_queued == -1',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\transaction\TransactionContinueProcess::class,
            ],
            [
                'id' => '78053a6e-4792-41e7-8ce5-10f8284efb92',
                'name' => 'Продолжит транзакцию мерчанта, когда is_queued == -1',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\transaction\TransactionMerchantContinueProcess::class,
            ],
            [
                'id' => '53c40ecc-4d17-47dd-9944-893dc0117c15',
                'name' => 'Транзакция отправить ​​в очередь',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\Transaction\TransactionSendToQueue::class,
            ],
            [
                'id' => '53c40e89-4d17-47dd-9944-893dc0117c15',
                'name' => 'JobLogs - копирование в DWH и удаление устаревших записей',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\JobLogs\RemoveOutdatedJobLogRecords::class,
            ],
             [
                'id' => '53c40ecc-4d99-47dd-9944-893dc0117c15',
                'name' => 'UserHistory - копирование в DWH и удаление устаревших записей',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\UserHistory\RemoveOutdatedUserHistoryRecords::class,
            ],
            [
                'id' => '53c40e1c-4d54-47dd-9944-893dc0117c15',
                'name' => 'TransactionHistory - копирование в DWH и удаление устаревших записей',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\Transaction\TransactionHistory\RemoveOutdatedTransactionHistoryRecords::class,
            ],
            [
                'id' => '53c40e0c-4d57-47dd-9944-893dc0117c15',
                'name' => 'Удаление устаревших записей из DWH таблиц',
                'type' => ScheduleType::COMMAND,
                'value' => \App\Console\Commands\DwhRules\RemoveOutdatedFromDwhTables::class,
            ],
            [
                'id' => '43ada483-29ed-4db9-9b63-f19144190f2a',
                'name' => 'Включить и отключить шлюз',
                'type' => ScheduleType::JOB,
                'value' => \App\Jobs\Gateway\GatewayOnOffJob::class,
                'fields' => json_encode([
                    [
                        'entity' => \App\Repositories\Backend\Gateway\GatewayRepositoryContract::class,
                        'type' => 'select',
                        'name' => 'gateway_id',
                        'label' => 'Шлюз'
                    ],
                    [
                        'entity' => '',
                        'type' => 'select',
                        'name' => 'is_active',
                        'label' => 'Статус'
                    ],
                ]),
            ],
            [
                'id' => '6a3635f4-657e-4df3-b9c6-84039cd364d6',
                'name' => 'Включить и отключить сервис',
                'type' => ScheduleType::JOB,
                'value' => \App\Jobs\Service\ServiceOnOffJob::class,
                'fields' => json_encode([
                    [
                        'entity' => \App\Repositories\Backend\Service\ServiceRepositoryContract::class,
                        'type' => 'select',
                        'name' => 'service_id',
                        'label' => 'Сервис'
                    ],
                    [
                        'entity' => '',
                        'type' => 'select',
                        'name' => 'is_active',
                        'label' => 'Статус'
                    ],
                ]),
            ],
            [
                'id' => '2106dd0e-bcc8-4050-92fb-90dc7af75195',
                'name' => 'Включить и отключить тип карты',
                'type' => ScheduleType::JOB,
                'value' => \App\Jobs\CardType\CardTypeOnOffJob::class,
                'fields' => json_encode([
                    [
                        'entity' => \App\Repositories\Backend\OrderCardType\OrderCardTypeRepositoryContract::class,
                        'type' => 'select',
                        'name' => 'card_type_id',
                        'label' => 'Тип карты'
                    ],
                    [
                        'entity' => '',
                        'type' => 'select',
                        'name' => 'is_active',
                        'label' => 'Статус'
                    ],
                ]),
            ]
        ];

        try{

            foreach ($items as $item) {
                try {
                    \App\Models\Schedule\ScheduleType\ScheduleType::create($item);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }

    }
}