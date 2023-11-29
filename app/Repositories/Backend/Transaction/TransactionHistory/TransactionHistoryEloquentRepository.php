<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Transaction\TransactionHistory;

use App\Models\Transaction\TransactionHistory\TransactionHistory;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Illuminate\Support\Facades\Log;

class TransactionHistoryEloquentRepository implements TransactionHistoryRepositoryContract
{

    protected $transactionHistory;

    private $logger;

    public function __construct(TransactionHistory $transactionHistory)
    {
        $this->transactionHistory = $transactionHistory;
        $this->logger = new DwhRulesLogger();
    }

    public function getForDataTable()
    {
    }

    public function all($columns = ['*'])
    {
        $transactionHistory = $this->transactionHistory->orderBy('created_at', 'desc')->get($columns);
        return $transactionHistory;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->transactionHistory->select($columns)->with('TransactionStatusDetail','TransactionStatus','TransactionType','CreatedUser','from_account','to_account','service')->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->transactionHistory->with('TransactionStatusDetail', 'TransactionStatus', 'TransactionType', 'CreatedUser')->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        return $this->transactionHistory->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->transactionHistory->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $transactionHistory = $this->transactionHistory->findOrFail($id);
        $transactionHistory->setOldAttributes($transactionHistory->getAttributes());
        $transactionHistory->update($data);
        return $transactionHistory;
    }

    public function lastLoginUpdate($id)
    {
    }

    public function destroy($id)
    {
        $this->transactionHistory->findOrFail($id)->delete();
        return $this->transactionHistory;
    }

    public function findByTransactionId($id)
    {
        return $this->transactionHistory->where('transaction_id',$id)->get();
    }

    public function recordsBeforeDate($date)
    {
        $limit = config('app_settings.transaction_history_select_max_rows_for_dwh', null);

        if ($limit){
            return $this->transactionHistory->where('created_at','<', $date)->limit($limit)->get();
        }
        $this->logger->warning("select limit from transaction history table is not set in .env");

        return [];
    }

}