<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Transaction;


interface TransactionRepositoryContract
{
    public function getForDataTable();

    /**
     * @param array $data
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($data=[],$columns = ['*']);

    public function allByStartDateAndEndDate($start_date, $end_date, $columns = ['*']);
    public function allForReport($columns = ['*']);

    public function allNotSynced($columns = ['*']);

    /**
     * @param array $data
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($data = [], $perPage = 60, $columns = ['*']);

    public function getByParentId($parent_id, $columns = ['*']);

    /**
     * @return mixed
     */
    public function listsAll();

    /**
     * @param array $data
     */
    public function create(array $data);

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = ['*']);

    public function resend($id);

    public function continue_process($id);

    public function editStatus($id, $transaction_status_id, $comment);

    public function findBySessionIn($id, $columns = ['*']);

    /**
     * @param array $data
     * @param $id
     */
    public function update(array $data, $id);

    public function lastLoginUpdate($id);

    /**
     *
     */
    public function destroy($id);

    public function getAllByNotSendToQueue();

    public function getAllByWillContinueProcess();

    public function changeTransactionSyncStatus($transaction_sync_status_id, $id);

    public function countNotVerifiedByDaysAgo($count_day);

    public function countRejectedByDaysAgo($count_day);

    public function countOnQueueByDaysAgo($count_day);

    public function countErrorQueueByDaysAgo($count_day);

    public function countErrorBusByDaysAgo($count_day);

    public function countGroupInProcessByDaysAgo($count_day);

    public function getByIdNotSyncedAndLockForUpdate($id);

    public function findLastWithdrawByMerchantId($merchant_account_id);

    public function findProblemTransactionsWithUnionSummByMerchantIdAndDate($merchant_transit_account_id, $merchant_last_withdraw_date);

    public function getSummForWithdrawToMerchantByMerchantIdAndDate($merchant_transit_account_id, $merchant_last_withdraw_date);


}