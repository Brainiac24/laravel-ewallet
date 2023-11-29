<?php


namespace App\Repositories\Backend\Transaction\TransactionContinueRuleAccordance;


use App\Models\Transaction\TransactionContinueRuleAccordance\TransactionContinueRuleAccordance;

class TransactionContinueRuleAccordanceEloquentRepository implements TransactionContinueRuleAccordanceRepositoryContract
{
    private $transactionContinueRuleAccordance;

    public function __construct(TransactionContinueRuleAccordance $transactionContinueRuleAccordance)
    {
        $this->transactionContinueRuleAccordance=$transactionContinueRuleAccordance;
    }

    public function all($search)
    {
        return $this->transactionContinueRuleAccordance
            ->where('id', 'like', '%' . $search . '%')
            ->with(['transaction_status', 'transaction_sync_status', 'transaction_continue_rule'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findById($id)
    {
        return $this->transactionContinueRuleAccordance->findOrFail($id);
    }

    public function paginate($data=[], $perPage = 30, $columns = ['*'])
    {
        return $this->transactionContinueRuleAccordance
            ->select($columns)
            ->with(['transaction_status', 'transaction_sync_status', 'transaction_continue_rule'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function update(array $data, $id)
    {
        $transactionContinueRuleAccordance=$this->transactionContinueRuleAccordance->findOrFail($id);
        $transactionContinueRuleAccordance->setOldAttributes($transactionContinueRuleAccordance->getAttributes());
        $transactionContinueRuleAccordance->update($data);
        return $transactionContinueRuleAccordance;
    }

    public function create(array $data)
    {
        return $this->transactionContinueRuleAccordance->create($data);
    }

    public function destroy($id)
    {
        $transactionContinueRuleAccordance=$this->transactionContinueRuleAccordance->findOrFail($id);
        $transactionContinueRuleAccordance->is_active=0;
        $transactionContinueRuleAccordance->save();
        return $transactionContinueRuleAccordance;
    }

    public function findByTransactionContinueRuleId($id)
    {
        return $this
            ->transactionContinueRuleAccordance
            ->where('transaction_continue_rule_id', $id)
            ->first();
    }

    public function getAllByTransactionContinueRuleId($transaction_continue_rule_id)
    {
        return $this
            ->transactionContinueRuleAccordance
            ->where('transaction_continue_rule_id',$transaction_continue_rule_id)
            ->with(['transaction_status', 'transaction_sync_status', 'transaction_continue_rule'])
            ->orderBy('created_at')
            ->get();
    }

    public function getAllListByTransactionContinueRuleId($transaction_continue_rule_id)
    {
        return $this
            ->transactionContinueRuleAccordance
            ->where('transaction_continue_rule_id',$transaction_continue_rule_id)
            ->with(['transaction_status'])
            ->get();
    }

    public function setAllowedUsersTransactionContinueRule($transactionContinueRuleId, $allowedUsers)
    {
        $transactionContinueRuleAccordances = $this->getAllListByTransactionContinueRuleId($transactionContinueRuleId);
        foreach ($transactionContinueRuleAccordances as $key => $item){
            $transactionContinueRuleAccordances[$key]->allowed_users = $allowedUsers[$item->id]??[];
            $transactionContinueRuleAccordances[$key]->save();
        }
    }

}