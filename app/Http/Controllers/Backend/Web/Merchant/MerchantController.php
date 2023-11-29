<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 13:20
 */

namespace App\Http\Controllers\Backend\Web\Merchant;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Exceptions\Backend\Web\ForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Merchant\IndexMerchantRequest;
use App\Http\Requests\Backend\Web\Merchant\StoreMerchantRequest;
use App\Http\Requests\Backend\Web\Merchant\UpdateMerchantRequest;
use App\Models\Merchant\Merchant;
use App\Repositories\Backend\Bank\BankRepositoryContract;
use App\Repositories\Backend\Branch\BranchRepositoryContract;
use App\Repositories\Backend\Cashback\CashbackItem\CashbackItemRepositoryContract;
use App\Repositories\Backend\Cashback\CashbackRepositoryContract;
use App\Repositories\Backend\City\CityRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantCategory\MerchantCategoryRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantCategoryMerchant\MerchantCategoryMerchantRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantCommission\MerchantCommissionRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantItem\MerchantItemRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantWorkdays\MerchantWorkdaysRepositoryContract;
use App\Services\Backend\Web\Merchant\MerchantServiceContract;
use App\Services\Backend\Web\ExportJob\MerchantExportJob\MerchantExportJobService;
use App\Services\Backend\Web\ExportJob\MerchantExportJob\MerchantExportJobServiceContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Image\ImageServiceContract;
use App\Services\Frontend\Api\Account\AccountService;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class MerchantController extends Controller
{
    /**
     * @var MerchantRepositoryContract
     */
    private $merchantRepository;
    /**
     * @var MerchantCategoryRepositoryContract
     */
    private $merchantCategoryRepository;
    /**
     * @var CityRepositoryContract
     */
    private $cityRepository;
    /**
     * @var MerchantWorkdaysRepositoryContract
     */
    private $merchantWorkdaysRepository;
    /**
     * @var CashbackRepositoryContract
     */
    private $cashbackRepository;
    /**
     * @var MerchantCategoryMerchantRepositoryContract
     */
    private $merchantCategoryMerchantRepository;
    /**
     * @var BankRepositoryContract
     */
    private $bankRepository;
    /**
     * @var AccountService
     */
    private $accountService;
    /**
     * @var MerchantCommissionRepositoryContract
     */
    private $merchantCommissionRepository;
    /**
     * @var CashbackItemRepositoryContract
     */
    private $cashbackItemRepository;
    /**
     * @var MerchantItemRepositoryContract
     */
    private $merchantItemRepository;
    /**
     * @var ImageServiceContract
     */
    private $imageService;

    /**
     * @var BranchRepositoryContract
     */
    private $branchRepository;

    /**
     * @var MerchantServiceContract
     */
    private $merchantService;

    private $merchantExportJobService;

    /**
     * @param MerchantRepositoryContract $merchantRepository
     * @param MerchantCategoryRepositoryContract $merchantCategoryRepository
     * @param CityRepositoryContract $cityRepository
     * @param MerchantWorkdaysRepositoryContract $merchantWorkdaysRepository
     * @param CashbackRepositoryContract $cashbackRepository
     * @param MerchantCategoryMerchantRepositoryContract $merchantCategoryMerchantRepository
     * @param BankRepositoryContract $bankRepository
     * @param AccountServiceContract $accountService
     * @param MerchantCommissionRepositoryContract $merchantCommissionRepository
     * @param CashbackItemRepositoryContract $cashbackItemRepository
     * @param MerchantItemRepositoryContract $merchantItemRepository
     * @param ImageServiceContract $imageService
     * @param BranchRepositoryContract $branchRepository
     * @param MerchantServiceContract $merchantService
     */
    public function __construct(
                                MerchantRepositoryContract $merchantRepository,
                                MerchantCategoryRepositoryContract $merchantCategoryRepository,
                                CityRepositoryContract $cityRepository,
                                MerchantWorkdaysRepositoryContract $merchantWorkdaysRepository,
                                CashbackRepositoryContract $cashbackRepository,
                                MerchantCategoryMerchantRepositoryContract $merchantCategoryMerchantRepository,
                                BankRepositoryContract $bankRepository,
                                AccountServiceContract $accountService,
                                MerchantCommissionRepositoryContract $merchantCommissionRepository,
                                CashbackItemRepositoryContract $cashbackItemRepository,
                                MerchantItemRepositoryContract $merchantItemRepository,
                                ImageServiceContract $imageService,
                                BranchRepositoryContract $branchRepository,
                                MerchantServiceContract $merchantService,
                                MerchantExportJobServiceContract $merchantExportJobService)
    {
        $this->middleware('merchant.can-list', ['only' => ['index']]);
        $this->middleware('merchant.can-show', ['only' => ['show']]);
        $this->middleware('merchant.can-create', ['only' => ['create', 'store']]);
        $this->middleware('merchant.can-edit', ['only' => ['edit', 'update', 'generateLogin']]);
        $this->middleware('merchant.can-delete', ['only' => ['destroy']]);
        $this->middleware('merchant.can-delete-contract', ['only' => ['deleteContract']]);

        $this->merchantRepository = $merchantRepository;
        $this->merchantCategoryRepository = $merchantCategoryRepository;
        $this->cityRepository = $cityRepository;
        $this->merchantWorkdaysRepository = $merchantWorkdaysRepository;
        $this->cashbackRepository = $cashbackRepository;
        $this->merchantCategoryMerchantRepository = $merchantCategoryMerchantRepository;
        $this->bankRepository = $bankRepository;
        $this->accountService = $accountService;
        $this->merchantCommissionRepository = $merchantCommissionRepository;
        $this->cashbackItemRepository = $cashbackItemRepository;
        $this->merchantItemRepository = $merchantItemRepository;
        $this->imageService = $imageService;
        $this->branchRepository = $branchRepository;
        $this->merchantService = $merchantService;
        $this->merchantExportJobService = $merchantExportJobService;
    }

    public function index(IndexMerchantRequest $request)
    {
        $data = $request->validated();
        if ($request->export ?? false == true) {
            try{
                $this->merchantExportJobService->create($data);
                session()->flash('flash_message', "Задача для формирование отчета создано. Вы сможете найти свою выгрузку в разделе \"Задачи\"");
                return redirect()->route('admin.merchants.index');
            }catch (\Exception $e)
            {
                session()->flash('flash_message_error', $e->getMessage());
                return redirect()->route('admin.merchants.index');
            }
        } else {
            $merchants = $this->merchantService->getTableList($data);
            $branchs = $this->merchantService->branchList();
            return view('backend.merchant.merchant.index', compact('merchants', 'data', 'branchs'));
        }
    }

    public function show($id)
    {
        $this->merchantService->checkAccess();
        $merchant = $this->merchantRepository->findById($id);
        $this->merchantService->checkAccessBranchId($merchant->branch_id);

        $merchantItems = $this->merchantItemRepository->GetAllByMerchantId($id);

        Breadcrumbs::setCurrentRoute('admin.merchants.show', $merchant);
        return view('backend.merchant.merchant.show', compact('merchant','merchantItems'));
    }

    public function create()
    {
        //
        $this->merchantService->checkAccess();
        $merchants = $this->merchantRepository->all('')->pluck('name', 'id');
        $merchantCategories = $this-> merchantCategoryRepository->all()->pluck('name', 'id')->toArray();
        $cities = $this->cityRepository->all('')->pluck('name', 'id')->prepend('', '');
        $merchantWorkdays = $this->merchantWorkdaysRepository->all('')->pluck('name', 'id')->prepend('', '');
        $cashbacks = $this->cashbackRepository->all('')->pluck('name', 'id')->prepend('', '');
        $banks = $this->bankRepository->all('')->pluck('name', 'id')->prepend('', '');
        $merchantCommissions = $this->merchantCommissionRepository->all('')->pluck('name', 'id')->prepend('', '');
        $branchs = $this->merchantService->branchList();
        $branchSelected = "";
        $merchantItems = $this->merchantItemRepository->all('')->pluck('name', 'id');

        if($this->merchantService->getAuthUser()->branches()->count() > 0) {
            foreach ($branchs as $bKey => $branch) {
                if ($bKey != "") {
                    $branchSelected = $bKey;
                    break;
                }
            }
        }

        return view('backend.merchant.merchant.create', compact('merchants','merchantCategories','cities','merchantWorkdays','cashbacks','banks','merchantCommissions', 'branchs','branchSelected',
            'merchantItems'));
    }

    /**
     * @param StoreMerchantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function store(StoreMerchantRequest $request)
    {

        try{
            $this->merchantService->store($request);
            session()->flash('flash_message', trans('alerts.general.success_add'));
            return redirect()->route('admin.merchants.index');
        }
        catch (Exception $e)
        {
            session()->flash('flash_message_error', trans($e->getMessage()));
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->route('admin.merchants.index');
        }
    }

    public function edit($id)
    {
        $this->merchantService->checkAccess();
        $merchant = $this->merchantRepository->findById($id);

        if(!$this->merchantService->isEditable($merchant)) {
            session()->flash('flash_message_error', trans('Этого мерчанта невозможно редактировать'));
            return redirect()->route('admin.merchants.index');
        }

        $this->merchantService->checkAccessBranchId($merchant->branch_id);
        $merchantCategories = $this->merchantCategoryRepository->all()->pluck('name', 'id')->toArray();
        $selectedPerms = $this->merchantCategoryMerchantRepository->GetAllByMerchantId($id)->pluck('merchant_category_id')->toArray();

        $cities = $this->cityRepository->all('')->pluck('name','id')->prepend('', '');
        $merchantWorkdays = $this->merchantWorkdaysRepository->all('')->pluck('name','id')->prepend('', '');
        $cashbacks = $this->cashbackRepository->all('')->pluck('name','id')->prepend('', '');
        $bankCashbacks = $this->cashbackRepository->all('')->pluck('name','id')->prepend('', '');
        $banks = $this->bankRepository->all('')->pluck('name','id')->prepend('', '');
        $merchantCommissions = $this->merchantCommissionRepository->all('')->pluck('name','id')->prepend('', '');
        $merchantItems = $this->merchantItemRepository->GetAllByMerchantId($merchant->id)->pluck('name', 'id');

        $branchs = $this->merchantService->branchList();
        $selectedMerchantItems=$merchant->params_json['report']['merchant_items']??[];
        Breadcrumbs::setCurrentRoute('admin.merchants.edit', $merchant);
        return view('backend.merchant.merchant.edit', compact('merchant',
            'merchantCategories','selectedPerms',
            'cities',
            'merchantWorkdays',
            'cashbacks',
            'bankCashbacks',
            'banks',//'selectedBank',
            'merchantCommissions',
            'branchs',
            'merchantItems',
            'selectedMerchantItems'
        ));
    }

    public function update(UpdateMerchantRequest $request, $id)
    {
        try
        {
            $this->merchantService->update($request, $id);
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->route('admin.merchants.index');
        }
        catch (Exception $e)
        {
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.merchants.edit', $id);
        }
    }

    public function deleteImageLogo($id)
    {
        $merchantModel = $this->merchantService->findById($id);
        if(!$this->merchantService->isEditable($merchantModel)) {
            session()->flash('flash_message_error', trans('Этого Мерчанта невозможно редактировать!'));
            return redirect()->route('admin.merchants.edit',$id);
        }

        try{
           $name = $merchantModel->img_logo;
           $this->merchantService->deleteImage($name);

           $merchant = $this->merchantRepository->deleteImageLogo($id);
           event(new UserModifiedEvent($merchant, Events::UPDATED));
           session()->flash('flash_message', trans('alerts.general.success_delete'));
           return redirect()->route('admin.merchants.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getMessage()));
            return redirect()->route('admin.merchants.edit', $id);
        }
    }

    public function deleteImageAd($id)
    {
        $merchantModel = $this->merchantService->findById($id);
        if(!$this->merchantService->isEditable($merchantModel)) {
            session()->flash('flash_message_error', trans('Этого Мерчанта невозможно редактировать!'));
            return redirect()->route('admin.merchants.edit',$id);
        }

        try{
            $name = $merchantModel->img_ad;
            $this->merchantService->deleteImage($name);

            $merchant = $this->merchantRepository->deleteImageAd($id);
            event(new UserModifiedEvent($merchant, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.merchants.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.merchants.edit', $id);
        }
    }

    public function deleteImageDetail($id)
    {
        $merchantModel = $this->merchantService->findById($id);
        if(!$this->merchantService->isEditable($merchantModel)) {
            session()->flash('flash_message_error', trans('Этого Мерчанта невозможно редактировать!'));
            return redirect()->route('admin.merchants.edit',$id);
        }

        try{
            $name = $merchantModel->img_detail;
            $this->merchantService->deleteImage($name);

            $merchant = $this->merchantRepository->deleteImageDetail($id);
            event(new UserModifiedEvent($merchant, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.merchants.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.merchants.edit', $id);
        }
    }

    public function destroy($id)
    {
        try {
            $merchant = $this->merchantService->destroy($id);
            event(new UserModifiedEvent($merchant, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.merchants.index');
        } catch (Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.merchants.index');
        }
    }

    function buildTree($flat, $pidKey, $idKey = null)
    {
        $arrlength = count($flat);
        for($x = 0; $x < $arrlength; $x++) {

            //dd('1');
            $flat[$x]['is_active2']=trans('InterfaceTranses.status.'.$flat[$x]['is_active']);
            //$flat[$x]['is_enabled2']=trans('InterfaceTranses.enabled.'.$flat[$x]['is_enabled']);
        }

        $grouped = array();
        foreach ($flat as $sub){
            $grouped[$sub[$pidKey]][] = $sub;

        }
        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if(isset($grouped[$id])) {
                    $sibling['w2ui']['children'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;

            }

            return $siblings;
        };
        $tree = $fnBuilder($grouped['00000000-0000-0000-0000-000000000000']);


        return $tree;
    }
    public function generateLogin($id)
    {
        $merchant=$this->merchantRepository->generateLogin($id);
        if ($merchant!=null){
            event(new UserModifiedEvent($merchant, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));
        }
        return redirect()->route('admin.merchants.edit', ['id'=>$id]);
    }

    public function downloadContract($id, $file)
    {
        $path = storage_path('app/merchant_contracts/'.$file);
        if(\File::isFile($path)) {
            return response()->download($path);
        }
        return redirect()->route('admin.merchants.edit', ['id'=>$id]);
    }

    public function deleteContract($id, $file)
    {
        $path = storage_path('app/merchant_contracts/'.$file);
        if(\File::exists($path)){
            \File::delete($path);
            $this->merchantRepository->deleteContract($id, $file);
            session()->flash('flash_message', trans('alerts.general.success_edit'));

        }
        return redirect()->route('admin.merchants.edit', ['id'=>$id]);
    }
}