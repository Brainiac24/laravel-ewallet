<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 14:44
 */

namespace App\Http\Controllers\Backend\Web\Transaction\TransactionSyncStatus;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Transaction\TransactionSyncStatus\TransactionSyncStatusRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class TransactionSyncStatusController extends Controller
{
    /**
     * @var TransactionSyncStatusRepositoryContract
     */
    private $transactionSyncStatusRepositoryContract;

    public function __construct(TransactionSyncStatusRepositoryContract $transactionSyncStatusRepositoryContract)
    {
        $this->middleware('transaction.sync.status.can-list', ['only' => ['index']]);
        $this->middleware('transaction.sync.status.can-show', ['only' => ['show']]);
        $this->transactionSyncStatusRepositoryContract = $transactionSyncStatusRepositoryContract;
    }

    public function index()
    {
        $data = $this->transactionSyncStatusRepositoryContract->all();
        return view('backend.transaction.transactionSyncStatus.index', compact('data'));
    }

    public function show($id)
    {
        $data = $this->transactionSyncStatusRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transactions.sync-status.show', $data);
        return view('backend.transaction.transactionSyncStatus.show',compact('data'));
    }
}