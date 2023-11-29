<?php


namespace App\Http\Controllers\Backend\Web\Cashback\BonusAccrual;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Cashback\BonusAccrual\IndexBonusAccrualRequest;
use App\Repositories\Backend\Cashback\BonusAccrual\BonusAccrualRepositoryContract;
use App\Repositories\Backend\Cashback\BonusAccrual\BonusAccrualStatus\BonusAccrualStatusRepositoryContract;
use App\Repositories\Backend\Cashback\CashbackRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class BonusAccrualController extends Controller
{
    private $bonusAccrualRepositoryContract;

    private $bonusAccrualStatusRepositoryContract;

    private $cashbackRepositoryContract;

    public function __construct(
        BonusAccrualRepositoryContract $bonusAccrualRepositoryContract,
        BonusAccrualStatusRepositoryContract $bonusAccrualStatusRepositoryContract,
        CashbackRepositoryContract $cashbackRepositoryContract
    )
    {
        $this->middleware('bonus.accrual.can-list', ['only' => ['index']]);
        $this->middleware('bonus.accrual.can-show', ['only' => ['show']]);

        $this->bonusAccrualRepositoryContract=$bonusAccrualRepositoryContract;
        $this->bonusAccrualStatusRepositoryContract=$bonusAccrualStatusRepositoryContract;
        $this->cashbackRepositoryContract=$cashbackRepositoryContract;
    }

    public function index(IndexBonusAccrualRequest $request)
    {
        $data = $request->validated();

        $filterBonusAccrualStatus = $this->bonusAccrualStatusRepositoryContract->getAll('')->pluck('name','id')->toArray();
        $filterCashback = $this->cashbackRepositoryContract->all('')->pluck('name','id')->toArray();
        $bonusAccruals = $this->bonusAccrualRepositoryContract->paginate($data);
        return view('backend.cashback.bonusAccrual.bonusAccrual.index', compact('bonusAccruals', 'data', 'filterCashback', 'filterBonusAccrualStatus'));
    }

    public function show($id)
    {
        $data = $this->bonusAccrualRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.bonusAccrual.show', $data);
        return view('backend.cashback.bonusAccrual.bonusAccrual.show', compact('data'));
    }
}