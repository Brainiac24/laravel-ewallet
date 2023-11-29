<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 13:21
 */

namespace App\Http\Controllers\Backend\Web\Transaction\TransactionStatusGroup;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Transaction\TransactionStatusGroup\TransactionStatusGroupRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class TransactionStatusGroupController extends Controller
{
    /**
     * @var TransactionStatusGroupRepositoryContract
     */
    private $groupRepositoryContract;

    public function __construct(TransactionStatusGroupRepositoryContract $groupRepositoryContract)
    {
        $this->middleware('transaction.status.group.can-list', ['only' => ['index']]);
        $this->middleware('transaction.status.group.can-show', ['only' => ['show']]);
        
        $this->groupRepositoryContract = $groupRepositoryContract;
    }

    public function index()
    {
        $data = $this->groupRepositoryContract->all();
        return view('backend.transaction.transactionStatusGroup.index', compact('data'));
    }

    public function show($id)
    {
        $data = $this->groupRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transactions.status-group.show', $data);
        return view('backend.transaction.transactionStatusGroup.show',compact('data'));
    }
}