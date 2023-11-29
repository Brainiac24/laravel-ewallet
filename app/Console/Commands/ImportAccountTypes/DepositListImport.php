<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14.06.2019
 * Time: 10:30
 */

namespace App\Console\Commands\ImportAccountTypes;


use App\Models\Account\AccountType\AccountType;
use App\Repositories\Backend\Account\AccountType\AccountTypeRepositoryContract;
use App\Services\Common\Helpers\AccountCategoryTypes;
use App\Services\Common\Helpers\Gateway;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Ramsey\Uuid\Uuid;

class DepositListImport implements ToModel, WithBatchInserts
{
    public $head = true;
    public $tempUserRepository = true;
    public $terminalsCount = 0;
    public $loadedTerminalsCount = 0;

    public function model(array $row)
    {
        $accountTypeRepository = \Illuminate\Container\Container::getInstance()->make(AccountTypeRepositoryContract::class);

        if ($this->head) {
            if (!empty($row[0])) {
                $accountType = $accountTypeRepository->getIdByCodeMap($row[0]);
                $this->terminalsCount++;
                if ($accountType == null) {
                    $this->loadedTerminalsCount++;
                    return new AccountType(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'code' => trim($row[1]),
                            'code_map' => trim($row[0]),
                            'name' => trim($row[2]),
                            'img_uncolored' => '',
                            'img_colored' => '',
                            'gateway_id' => Gateway::ABS,
                            'account_category_type_id' => AccountCategoryTypes::DEPOSIT_ID,
                            'parent_id' => config('app_settings.default_account_category_type_id'),
                        ]
                    );
                }
            }
        }
        $this->head = true;
    }

    public function noHeader()
    {
        $this->head = false;
        return $this;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}