<?php


namespace App\Repositories\Backend\Transaction\TransactionContinueRuleAccordance;


interface TransactionContinueRuleAccordanceRepositoryContract
{
    public function all($search);

    public function findById($id);

    public function paginate($data=[], $perPage = 30, $columns = ['*']);

    public function update(array $data, $id);

    public function create(array $data);

    public function destroy($id);

    public function findByTransactionContinueRuleId($id);

    public function getAllByTransactionContinueRuleId($transaction_continue_rule_id);

    public function getAllListByTransactionContinueRuleId($transaction_continue_rule_id);

    public function setAllowedUsersTransactionContinueRule($transactionContinueRuleId, $availableUsers);
}