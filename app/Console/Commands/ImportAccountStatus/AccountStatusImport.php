<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 20.06.2019
 * Time: 14:40
 */

namespace App\Console\Commands\ImportAccountStatus;

use App\Models\Account\AccountStatus\AccountStatus;
use App\Repositories\Backend\Account\AccountStatus\AccountStatusRepositoryContract;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Ramsey\Uuid\Uuid;

class AccountStatusImport implements ToModel, WithBatchInserts
{
    public $head = true;
    public $tempUserRepository = true;
    public $terminalsCount = 0;
    public $loadedTerminalsCount = 0;

    public function model(array $row)
    {
        $accountStatusRepository = \Illuminate\Container\Container::getInstance()->make(AccountStatusRepositoryContract::class);

        if ($this->head) {
            if (!empty($row[0])) {
                $accountType = $accountStatusRepository->getIdByCodeMap($row[0]);
                $this->terminalsCount++;
                if ($accountType == null) {
                    $this->loadedTerminalsCount++;
                    return new AccountStatus(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'code' => trim($row[1]),
                            'code_map' => trim($row[0]),
                            'name' => trim($row[2]),
                            'is_active' => '1',
                        ]
                    );
                }
            }
        }
        $this->head = true;
    }

    /**
     * @return $this
     */
    public function noHeader()
    {
        $this->head = false;
        return $this;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }
}