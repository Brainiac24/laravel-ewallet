<?php


namespace App\Repositories\Backend\Transaction\TransactionContinueRule;


use App\Models\Transaction\TransactionContinueRule\Filters\TransactionContinueRuleFilter;
use App\Models\Transaction\TransactionContinueRule\TransactionContinueRule;

class TransactionContinueRuleEloquentRepository implements TransactionContinueRuleRepositoryContract
{
    private $transactionContinueRule;

    public function __construct(TransactionContinueRule $transactionContinueRule)
    {
        $this->transactionContinueRule=$transactionContinueRule;
    }

    public function all($search)
    {
        return $this->transactionContinueRule
            ->where('id', 'like', '%' . $search . '%')
            ->with(['transaction_status', 'transaction_sync_status', 'from_gateway', 'to_gateway'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findById($id)
    {
        return $this->transactionContinueRule
            ->with(['transaction_status', 'transaction_sync_status', 'from_gateway', 'to_gateway'])
            ->findOrFail($id);
    }

    public function paginate($data=[], $perPage = 30, $columns = ['*'])
    {
        return $this->transactionContinueRule
            ->select($columns)
            ->filterBy(new TransactionContinueRuleFilter($data))
            ->with(['transaction_status', 'transaction_sync_status', 'from_gateway', 'to_gateway', 'transaction_continue_rule_accordance'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function update(array $data, $id)
    {
        $transactionContinueRule=$this->transactionContinueRule->findOrFail($id);
        $transactionContinueRule->setOldAttributes($transactionContinueRule->getAttributes());
        $transactionContinueRule->update($data);
        return $transactionContinueRule;
    }

    public function create(array $data)
    {
       return $this->transactionContinueRule->create($data);
    }

    public function destroy($id)
    {
        $transactionContinueRule=$this->transactionContinueRule->findOrFail($id);
        $transactionContinueRule->is_active=0;
        $transactionContinueRule->save();
        return $transactionContinueRule;
    }

    public function getFirst($data=[])
    {
        return $this->transactionContinueRule
            ->select('*')
            ->filterBy(new TransactionContinueRuleFilter($data))
//            ->with(['transaction_status', 'transaction_sync_status', 'from_gateway', 'to_gateway'])
            ->first();
    }
}