<?php

namespace App\Http\Controllers\Frontend\Api\Account;

use App\Exceptions\Frontend\Api\LogicException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\Api\Account\AccountBalanceResource;
use App\Http\Resources\Frontend\Api\Account\AccountBalanceWithLimitsResource;
use App\Models\Account\Account;
use App\Repositories\Frontend\Account\AccountRepositoryContract;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected $accountRepository;
    protected $accountService;

    public function __construct(AccountRepositoryContract $accountRepository, AccountServiceContract $accountService)
    {
        $this->accountRepository = $accountRepository;
        $this->accountService = $accountService;
    }

    public function getBalanceByNumber($account_number)
    {
        $code = '0';
        $account = $this->accountRepository->getBalanceByNumber($account_number);
        if ($account == null) {
            throw new LogicException(trans('accounts.errors.account_by_number_not_found'));
        }
        $data = new AccountBalanceResource($account);
        return \response()->apiSuccess(compact('code', 'data', 'meta'));
    }

    public function getBalanceWithLimitsByAccountNumber($account_number)
    {
        $code = '0';
        $data = new AccountBalanceWithLimitsResource($this->accountRepository->getBalanceByNumber($account_number));

        //$meta = Auth::user();
        //$this->createDefaultAccount();
        //$this->addBalance(1, 100);
        return \response()->apiSuccess(compact('code', 'data', 'meta'));
    }

    

}
