<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.12.2019
 * Time: 14:38
 */

namespace App\Http\Controllers\Backend\Web\Cashback\CashbackItem;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Cashback\CashbackItem\StoreCashbackItemRequest;
use App\Http\Requests\Backend\Web\Cashback\CashbackItem\UpdateCashbackItemRequest;
use App\Http\Requests\Backend\Web\Cashback\StoreCashbackRequest;
use App\Repositories\Backend\Cashback\CashbackItem\CashbackItemRepositoryContract;
use App\Repositories\Backend\Cashback\CashbackRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\DB;

class CashbackItemController extends Controller
{
    private $cashbackItemRepository;
    /**
     * @var CashbackRepositoryContract
     */
    private $cashbackRepository;
    /**
     * @var MerchantRepositoryContract
     */
    private $merchantRepository;

    /**
     * CashbackItemController constructor.
     * @param CashbackItemRepositoryContract $cashbackItemRepository
     * @param CashbackRepositoryContract $cashbackRepository
     * @param MerchantRepositoryContract $merchantRepository
     */
    public function __construct(CashbackItemRepositoryContract $cashbackItemRepository,
                                CashbackRepositoryContract $cashbackRepository,
                                MerchantRepositoryContract $merchantRepository)
    {
        $this->middleware('cashback.item.can-list', ['only' => ['index']]);
        $this->middleware('cashback.item.can-show', ['only' => ['show']]);
        $this->middleware('cashback.item.can-create', ['only' => ['create', 'store']]);
        $this->middleware('cashback.item.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('cashback.item.can-delete', ['only' => ['destroy']]);

        $this->cashbackItemRepository = $cashbackItemRepository;
        $this->cashbackRepository = $cashbackRepository;
        $this->merchantRepository = $merchantRepository;
    }

    public function index()
    {
        $data = $this->cashbackItemRepository->all();
        return view('backend.cashback.cashbackItem.index', compact('data'));
    }

    public function show($cashback_id, $id)
    {
        $data = $this->cashbackItemRepository->findById($id);

        //Breadcrumbs::setCurrentRoute('admin.cashback.items.show', $cashback_id,$data);
        return view('backend.cashback.cashbackItem.show', compact('data'));
    }

    public function create($id)
    {
        $cashback = $this->cashbackRepository->findById($id);

        $maxValue = $this->cashbackItemRepository->GetMaxValueFromColumnMaxByCashbackId($id);
        $maxValue = $maxValue+0.01;
        $data = $this->cashbackItemRepository->all()->pluck('name', 'id')->prepend('', '');

        return view('backend.cashback.cashbackItem.create', compact('data','cashback','id','maxValue'));
    }

    public function store(StoreCashbackItemRequest $request, $cashback_id)
    {
        //
        try{
            DB::beginTransaction();
            $data = $request->validated();

            $maxValue = $this->cashbackItemRepository->GetMaxValueFromColumnMaxByCashbackId($cashback_id);
            if($data['min']>=$data['max'] || $data['min']<=$maxValue){
                session()->flash('flash_message_error', trans('Задан ошибочный интервал!'));
                return redirect()->route('admin.cashback.items.create',$cashback_id);
            }

            $data['cashback_id']=$cashback_id;
            $cashback = $this->cashbackItemRepository->create($data);

            $merchants = $this->merchantRepository->GetAllMerchantByCashbackId($cashback_id);
            foreach ($merchants as $merchant)
            {
                $value = $this->cashbackItemRepository->GetMaxValueFromColumnValueByCashbackId($merchant['merchant_cashback_id'],$merchant['bank_cashback_id']);
                $this->merchantRepository->updateHighestCashbackValue($merchant['id'], $value);
            }

            $cashback->setChanges($cashback->getAttributes());

            event(new UserModifiedEvent($cashback, Events::CREATED));
            session()->flash('flash_message', trans('alerts.general.success_add'));
            DB::commit();
            return redirect()->route('admin.cashbacks.show',$cashback_id);
        }
        catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' .$e->getMessage(). $e->getCode()));
            return redirect()->route('admin.cashbacks.show', $cashback_id);
        }
    }

    public function edit($cashback_id, $id)
    {
        $data = $this->cashbackItemRepository->findById($id);

        Breadcrumbs::setCurrentRoute('admin.cashback.items.edit',$cashback_id, $data);
        return view('backend.cashback.cashbackItem.edit', compact('data','cashback_id'));
    }

    public function update(UpdateCashbackItemRequest $request, $cashback_id,$cashback_item_id)
    {
        ini_set('max_execution_time', '900');
        try{
            DB::beginTransaction();
            $data = $request->validated();

//            if($data['min']>=$data['max']){
//
//                session()->flash('flash_message_error', trans('Задан ошибочный интервал!'));
//                return redirect()->back();//
//            }

            $data = $this->cashbackItemRepository->update($data, $cashback_item_id);
            $merchants = $this->merchantRepository->GetAllMerchantByCashbackId($cashback_id);
            foreach ($merchants as $merchant)
            {
                $value = $this->cashbackItemRepository->GetMaxValueFromColumnValueByCashbackId($merchant['merchant_cashback_id'],$merchant['bank_cashback_id']);
                $this->merchantRepository->updateHighestCashbackValue($merchant['id'], $value);
            }

            event(new UserModifiedEvent($data, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));

            DB::commit();
            return redirect()->route('admin.cashbacks.show', $cashback_id);
        }
        catch (\Exception $e) {
            DB::rollBack();
        session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' .$e->getMessage(). $e->getCode()));
        return redirect()->route('admin.cashbacks.show', $cashback_id);
        }
    }

    public function destroy($cashback_id, $id)
    {
        //
        try {
            DB::beginTransaction();
            $data = $this->cashbackItemRepository->destroy($id);
            $merchants = $this->merchantRepository->GetAllMerchantByCashbackId($cashback_id);
            foreach ($merchants as $merchant)
            {
                $value = $this->cashbackItemRepository->GetMaxValueFromColumnValueByCashbackId($merchant['merchant_cashback_id'],$merchant['bank_cashback_id']);
                $this->merchantRepository->updateHighestCashbackValue($merchant['id'], $value);
            }
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            DB::commit();
            return redirect()->route('admin.cashbacks.show', $cashback_id);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.red' . $e->getCode()));
            return redirect()->route('admin.cashbacks.show', $cashback_id);
        }
    }
}