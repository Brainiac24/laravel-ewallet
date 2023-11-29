<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 04.11.2019
 * Time: 13:58
 */

namespace App\Http\Controllers\Backend\Web\Merchant\MerchantItem;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Merchant\MerchantItem\ChangeAccCodeMerchantItemRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantItem\IndexMerchantItemRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantItem\StoreMerchantItemRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantItem\UpdateMerchantItemRequest;
use App\Repositories\Backend\Account\AccountRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantItem\MerchantItemRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\Helper;
use App\Services\Common\Helpers\Service;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\DB;
use ReallySimpleJWT\Helper\Base64;

class MerchantItemController extends Controller
{
    /**
     * @var MerchantItemRepositoryContract
     */
    private $merchantItemRepository;
    /**
     * @var MerchantRepositoryContract
     */
    private $merchantRepository;
    /**
     * @var AccountServiceContract
     */
    private $accountService;
    /**
     * @var AccountRepository
     */
    private $accountRepository;

    /**
     * MerchantItemController constructor.
     * @param MerchantItemRepositoryContract $merchantItemRepositoryContract
     * @param MerchantRepositoryContract $merchantRepositoryContract
     * @param AccountServiceContract $accountServiceContract
     * @param AccountRepositoryContract $accountRepositoryContract
     */
    public function __construct(MerchantItemRepositoryContract $merchantItemRepositoryContract,
                                MerchantRepositoryContract $merchantRepositoryContract,
                                AccountServiceContract $accountServiceContract,
                                AccountRepositoryContract $accountRepositoryContract)
    {
        $this->middleware('merchant.item.can-list', ['only' => ['index']]);
        $this->middleware('merchant.item.can-show', ['only' => ['show']]);
        $this->middleware('merchant.item.can-create', ['only' => ['create', 'store']]);
        $this->middleware('merchant.item.can-edit', ['only' => ['edit', 'update','generateHash','settingJson']]);
        $this->middleware('merchant.item.can-delete', ['only' => ['destroy']]);
        $this->middleware('merchant.item.can-changeAccountNumber', ['only' => ['changeAccountNumber']]);

        $this->merchantItemRepository = $merchantItemRepositoryContract;
        $this->merchantRepository = $merchantRepositoryContract;
        $this->accountService = $accountServiceContract;
        $this->accountRepository = $accountRepositoryContract;
    }

    public function index(IndexMerchantItemRequest $request)
    {
        $data = $request->validated();
        $merchantItemList = $this->merchantItemRepository->paginate($data);
        $merchantItemList->appends($request->validated());
        $merchantItems = $merchantItemList;
        $filterMerchants = $this->merchantRepository->allParent('')->pluck('name', 'id')->toArray();
        return view('backend.merchant.merchantItem.index', compact('merchantItems', 'data', 'filterMerchants'));
    }
//cashbacks/80ab5f60-c90c-4517-89c8-97e7f1a5e859/items/de9f5bc3-ca62-4228-91a1-ca3cb539f828
    public function show($merchant_id, $id)
    {
        //

        $merchantItem = $this->merchantItemRepository->findById($id);

        $qr_code = [
            "v" => 1,
            "srv" => [
                "id" => Service::MERCHANT,
                "attr" => [
                    "to_account" => $merchantItem->id
                ]
            ]
        ];

        $qr_code_base64 = base64_encode(json_encode($qr_code));
        $qr_photo_base64 = Helper::generateQrCodeWithBase64($qr_code_base64);
        //$qr_code_base64 = json_encode($qr_code);
        Breadcrumbs::setCurrentRoute('admin.merchants.items.show', $merchant_id, $merchantItem);
        return view('backend.merchant.merchantItem.show', compact('merchantItem', 'qr_code_base64', 'qr_photo_base64'));
    }

    public function create($merchant_id)
    {
        //
        //$filterMerchants = $this->merchantRepository->allParent('')->pluck('name', 'id')->prepend('', '')->toArray();
        //$merchantItems = $this->merchantItemRepository->all('')->pluck('name', 'id');
        //dd($merchant_id);
        $merchant = $this->merchantRepository->findById($merchant_id);
        //dd($merchant);
        $merchant_name=$merchant->name;
        return view('backend.merchant.merchantItem.create', compact('merchant_id','merchant_name'));
    }

    public function store(StoreMerchantItemRequest $request, $merchant_id)
    {
        //
        $data = $request->validated();

//        if (!isset($data['account_number'])) {
//            $merchant = $this->merchantRepository->findById($data['merchant_id']);
//            $data['account_number'] = $merchant['account_number'];
//        }

//        $account = $this->accountService->createMerchantAccount($data['account_number']);
//
//        $data['account_id'] = $account['id'];
        $data['merchant_id']=$merchant_id;


        $merchantItem = $this->merchantItemRepository->create($data);
        $merchantItem->setChanges($merchantItem->getAttributes());
        event(new UserModifiedEvent($merchantItem, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.merchants.show',$merchant_id);
    }

    public function edit($merchant_id, $id)
    {
        //dd($merchant_id.' '.$id);
        $merchantItem = $this->merchantItemRepository->findByIdWithoutGlobal($id);

        //dd($merchantItem);
//        $filterMerchants = $this->merchantRepository->allParent('')->pluck('name','id')->toArray();
        Breadcrumbs::setCurrentRoute('admin.merchants.items.edit',$merchant_id, $merchantItem);
        return view('backend.merchant.merchantItem.edit', compact('merchantItem','merchant_id'));
    }

    public function update(UpdateMerchantItemRequest $request, $merchant_id, $id)
    {
        $merchantItem = $this->merchantItemRepository->update($request->validated(), $id);

        event(new UserModifiedEvent($merchantItem, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.merchants.show',$merchant_id);
    }

    public function destroy($merchant_id, $id)
    {
        //
        try {
            $merchantItem = $this->merchantItemRepository->destroy($id);
            event(new UserModifiedEvent($merchantItem, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.merchants.items.index');
//            return redirect()->route('admin.merchants.show', $merchant_id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.merchants.show', $merchant_id);
        }
    }

    public function changeAccCode(ChangeAccCodeMerchantItemRequest $request, $id)
    {
        try {

            DB::beginTransaction();

            $data = $request->validated();
            $merchant = $this->merchantItemRepository->findById($id);

            $this->merchantItemRepository->updateAccountNumber($id, $data['account_number']);
            $this->accountRepository->updateAccCode($merchant['account_id'], $data['account_number']);

            event(new UserModifiedEvent($merchant, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));

            DB::commit();

            return redirect()->route('admin.merchants.items.edit', $id);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.merchants.items.edit', $id);
        }
    }

    public function generateHash($merchant_id, $id)
    {
        $merchantItem=$this->merchantItemRepository->generateHash($id);
        if ($merchantItem!=null){
            event(new UserModifiedEvent($merchantItem, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));
        }
        return redirect()->route('admin.merchants.items.edit', ['merchant_id'=>$merchant_id, 'id'=>$id]);
    }

    public function settingJson($merchant_id, $id)
    {
        $result=$this->merchantItemRepository->generateSettingsJson($id);
        if ($result==null){
            session()->flash('flash_message_error', trans('merchantItem.alert.empty_hash_or_login'));
            return redirect()->route('admin.merchants.items.edit', ['merchant_id'=>$merchant_id, 'id'=>$id]);
        }
        $fileName = 'settings.json';
        $headers = [
            'Content-Disposition' => 'attachment; filename='. $fileName,
        ];
        return response()->stream(function() use ($result){
            echo $result;
        }, 200, $headers);
    }
}