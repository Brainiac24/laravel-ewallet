<?php

namespace App\Http\Controllers\Backend\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;

class DashboardController extends Controller
{
    public $transactionRepository;
    
    public function __construct(TransactionRepositoryContract $transactionRepository)
    {
        $this->middleware('auth');
        $this->middleware('dashboard.can-show-list', ['only' => ['index']]);

        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countNotVerified = $this->transactionRepository->countNotVerifiedByDaysAgo(config('app_settings.widgets_days'));
        $countRejected = $this->transactionRepository->countRejectedByDaysAgo(config('app_settings.widgets_days'));
        $countOnQueue = $this->transactionRepository->countOnQueueByDaysAgo(config('app_settings.widgets_days'));
        $countErrorQueue = $this->transactionRepository->countErrorQueueByDaysAgo(config('app_settings.widgets_days'));
        $countErrorBus = $this->transactionRepository->countErrorBusByDaysAgo(config('app_settings.widgets_days'));
        $countGroupInProcess = $this->transactionRepository->countGroupInProcessByDaysAgo(config('app_settings.widgets_days'));

        return view('backend.dashboard', compact(['countNotVerified', 'countRejected', 'countOnQueue', 'countErrorQueue', 'countErrorBus', 'countGroupInProcess']));
    }

    /**
     * @return mixed
     */
    public function redirectFromIndexPage()
    {
        return redirect()->route('admin.dashboard');
    }
}
