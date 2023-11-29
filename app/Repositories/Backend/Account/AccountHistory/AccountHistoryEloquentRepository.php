<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Account\AccountHistory;

use App\Models\Account\AccountHistory\AccountHistory;
use App\Models\Account\AccountHistory\Filters\AccountHistoryFilter;

class AccountHistoryEloquentRepository implements AccountHistoryRepositoryContract
{
    protected $accountHistory;

    public function __construct(AccountHistory $accountHistory)
    {
        $this->accountHistory = $accountHistory;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        return $accountHistory = $this->accountHistory->get($columns);
    }

    public function paginate($data=[], $perPage = 30, $columns = ['*'])
    {
        return $this->accountHistory->select($columns)->filterBy(new AccountHistoryFilter($data))->with('account_histories','account_type', 'transaction_status.transaction_status_group', 'transaction_type', 'user', 'currency', 'transaction')->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findByNumberWithPaginate($number, $perPage = 30, $columns = ['*'])
    {
        return $this->accountHistory->select($columns)->where('number', $number)->with('account_histories','account_type', 'transaction_status.transaction_status_group', 'transaction_type', 'user', 'currency', 'transaction')->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->accountHistory->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        return $this->accountHistory->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->accountHistory->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $accountHistory = $this->accountHistory->findOrFail($id);
        return $accountHistory->update($data);
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        return $this->accountHistory->findOrFail($id)->delete();
    }

}