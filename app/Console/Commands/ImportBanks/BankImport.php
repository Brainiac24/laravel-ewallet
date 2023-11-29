<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:21
 */

namespace App\Console\Commands\ImportBanks;


use App\Models\Bank\Bank;
use App\Repositories\Backend\Bank\BankRepositoryContract;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Ramsey\Uuid\Uuid;

class BankImport implements ToModel, WithBatchInserts
{
    public $head = true;
    public $tempUserRepository = true;
    public $terminalsCount = 0;
    public $loadedTerminalsCount = 0;

    public function model(array $row)
    {
        $banksRepository = \Illuminate\Container\Container::getInstance()->make(BankRepositoryContract::class);

        if ($this->head) {
            if (!empty($row[0])) {
                $accountType = $banksRepository->getIdByCodeMap($row[0]);
                $this->terminalsCount++;
                if ($accountType == null) {
                    $this->loadedTerminalsCount++;
                    return new Bank(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'code' => trim($row[0]),
                            'code_map' => trim($row[1]),
                            'name' => trim($row[2]),
                            'desc' => trim($row[3]),
                            'bic' => trim($row[4]),
                            'corr_acc' => trim($row[5]),
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