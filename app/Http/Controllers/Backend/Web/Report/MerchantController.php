<?php

namespace App\Http\Controllers\Backend\Web\Report;

use App\Http\Controllers\Controller;
use App\Models\Merchant\Merchant;
use App\Models\Transaction\Transaction;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Services\Backend\Api\Transaction\TransactionServiceContract;
use DB;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public $transactionRepository;
    public $transactionService;
    public function __construct(TransactionRepositoryContract $transactionRepository, TransactionServiceContract $transactionService)
    {
        $this->middleware('reportMerchant.can-list', ['only' => ['index']]);
        $this->transactionRepository = $transactionRepository;
        $this->transactionService = $transactionService;
    }

    public function index(Request $request)
    {
        //$data = $request->all();
        ini_set('memory_limit', '4096M');
        ini_set('max_execution_time', '900');
        $transactions = $this->transactionRepository->allForReport();
        $data = [];
        foreach ($transactions as $transaction) {

            $merchant_name = '';
            $merchant_id = '';

            //dd($transaction->merchant_item_by_to_account_id);
            if (empty($transaction->merchant_item_by_to_account_id) && $transaction->merchant_item_by_to_account_id['account_id'] != null) {
                $merchant_id = $transaction->merchant_item_by_to_account_id->merchant['id'];
                $merchant_name = $transaction->merchant_item_by_to_account_id->merchant['name'];
            } elseif (empty($transaction->merchant_by_to_account_id) && $transaction->merchant_by_to_account_id['account_id'] != null) {
                //dd($transaction->merchant_by_to_account_id);
                $merchant_id = $transaction->merchant_by_to_account_id['id'];
                $merchant_name = $transaction->merchant_by_to_account_id['name'];
            }

            if (empty($merchant_id)) {
                $merchant_id = 'null_merchant';
                $merchant_name = 'null_merchant';
            }

            $data_childs = [];

            try {



                $transaction_childs = $transaction->children;

                foreach ($transaction_childs as $transaction_child) {
                    $data_childs[] = [
                        "doc_num" => $transaction_child->session_number,
                        "doc_date" => $transaction_child->finished_at,
                        "amount" => $transaction_child->amount,
                        "service" => $transaction_child->service->name,
                        "from_account_gateway" => ($transaction_child->from_account_without_g_scopes != null ? $transaction_child->from_account_without_g_scopes->account_type->gateway->code  : ""),
                        "from_account" => $this->transactionService->extractAccountNumberValue($transaction_child),
                        "to_account_gateway" => ($transaction_child->to_account_without_g_scopes != null ? $transaction_child->to_account_without_g_scopes->account_type->gateway->code : $transaction_child->service->gateway->code),
                        "to_account" => $this->transactionService->extractAccountNumberValueWithServiceConditions($transaction_child),
                        "status" => $transaction_child->transaction_status->code,
                    ];
                }


                $data[$merchant_id]['transactions'][] = [
                    "doc_num" => $transaction->session_number,
                    "doc_date" => $transaction->finished_at,
                    "amount" => $transaction->amount,
                    "service" => $transaction->service->name,
                    "from_account_gateway" => ($transaction->from_account_without_g_scopes != null ? $transaction->from_account_without_g_scopes->account_type->gateway->code  : ""),
                    "from_account" => $this->transactionService->extractAccountNumberValue($transaction),
                    "to_account_gateway" => ($transaction->to_account_without_g_scopes != null ? $transaction->to_account_without_g_scopes->account_type->gateway->code : $transaction->service->gateway->code),
                    "to_account" => $this->transactionService->extractAccountNumberValueWithServiceConditions($transaction),
                    "status" => $transaction->transaction_status->code,
                    "transaction_childs" => $data_childs,
                ];
                $data[$merchant_id]['name'] = $merchant_name;
            } catch (\Throwable $th) {
            }
        }

        //$merchantList = Merchant::orderBy('name')->get()->pluck('name', 'id')->prepend("","");

        return view('backend.reports.merchant.index', compact('data'));
    }
}
