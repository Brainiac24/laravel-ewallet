<?php

namespace App\Http\Controllers\Frontend\Api\Transaction;

use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\Transaction\ConfirmSmsTransactionRequest;
use App\Http\Requests\Frontend\Api\Transaction\IndexTransactionRequest;
use App\Http\Requests\Frontend\Api\Transaction\RetrySerndSmsTransactionRequest;
use App\Http\Requests\Frontend\Api\Transaction\ServiceBalanceRequest;
use App\Http\Requests\Frontend\Api\Transaction\StoreTransactionRequest;
use App\Http\Resources\Frontend\Api\Transaction\TransactionListResource;
use App\Http\Resources\Frontend\Api\Transaction\TransactionReceipt\TransactionByIdResource;
use App\Http\Resources\Frontend\Api\Transaction\TransactionReceipt\TransactionReceiptResource;
use App\Repositories\Frontend\Transaction\TransactionRepositoryContract;
use App\Services\Frontend\Api\Transaction\TransactionServiceContract;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $transactionRepository;

    public function __construct(TransactionServiceContract $transactionService, TransactionRepositoryContract $transactionRepository)
    {
        $this->transactionService = $transactionService;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @param StoreTransactionRequest $request
     * @return mixed
     * @throws ValidationException
     */
    public function create(StoreTransactionRequest $request)
    {

        //throw new ValidationException("Сервис оплаты временно не доступен.");

        $transaction = $this->transactionService->create($request->validated());
        $code = 0;
        $data = ['transaction_id' => $transaction->id];

        return \response()->apiSuccess(compact('code', 'data'));
    }


    public function getById($id)
    {
        $code = 0;
        $transaction = $this->transactionRepository->getByIdForShow($id);
        //dd($transaction );
        if ($transaction == null) {
            throw new LogicException(trans('transactions.errors.not_found'));
        }
        $data = new TransactionByIdResource($transaction);

        return \response()->apiSuccess(compact('code', 'data'));
    }
    
    public function getList(IndexTransactionRequest $request)
    {
        $code = 0;
        $transaction = $this->transactionRepository->allNotVerified($request->validated());
//        dd($transaction);
//        if ($transaction == null) {
//            throw new LogicException(trans('transactions.errors.list_not_found'));
//        }
        $data = TransactionListResource::collection($transaction);

        return \response()->apiSuccess(compact('code', 'data'));
    }

    public function checkBalanceFromProcessing(ServiceBalanceRequest $request)
    {
        //dd($request->validated());
        $req = $request->validated();

        $serviceBalance = $this->transactionService->checkBalanceFromProcessing($req['service_id'], $req['number']);
        $code = 0;
        $data = $serviceBalance;

        return \response()->apiSuccess(compact('code', 'data'));
    }

    public function confirm(ConfirmSmsTransactionRequest $request)
    {
        $res = $this->transactionService->ConfirmSmsAndChangeStatus($request->validated());
        $code = 0;
        $user = (Auth::user()->load('accounts'));
        $data = [
            //ХАРДКОД - account [0];
            "balance" => $user->accounts[0]['balance_all'],
        ];
        $message = trans('transactions.messages.accepted');
        return \response()->apiSuccess(compact('code', 'data','message'));
    }

    public function retrySendSMS($id)
    {
        //dd($id);
        $res = $this->transactionService->retrySendSMS($id);
        $code = 0;
        
        return \response()->apiSuccess(compact('code', 'data','message'));
    }

    public function getByIdForReciept($id)
    {
        $code = 0;
        $transaction = $this->transactionRepository->getById($id);
        if ($transaction == null) {
            throw new LogicException(trans('transactions.errors.not_found'));
        }
        $data = new TransactionReceiptResource($transaction);

        return \response()->apiSuccess(compact('code', 'data'));
    }

}
