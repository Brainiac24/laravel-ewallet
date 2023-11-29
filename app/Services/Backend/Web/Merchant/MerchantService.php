<?php

namespace App\Services\Backend\Web\Merchant;

use App\Exceptions\Backend\Web\ForbiddenException;
use App\Http\Requests\Backend\Web\Merchant\StoreMerchantRequest;
use App\Http\Requests\Backend\Web\Merchant\UpdateMerchantRequest;
use App\Models\Merchant\Merchant;
use App\Repositories\Backend\Branch\BranchRepositoryContract;
use App\Repositories\Backend\Cashback\CashbackItem\CashbackItemRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Image\ImageServiceContract;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;

class MerchantService implements MerchantServiceContract
{
    private $merchantRepository;
    private $branchRepository;
    private $accountService;
    private $cashbackItemRepository;
    private $imageService;

    public function __construct(MerchantRepositoryContract $merchantRepository,
                                BranchRepositoryContract $branchRepository,
                                AccountServiceContract $accountService,
                                CashbackItemRepositoryContract $cashbackItemRepository,
                                ImageServiceContract $imageService)
    {
        $this->merchantRepository = $merchantRepository;
        $this->branchRepository = $branchRepository;
        $this->accountService = $accountService;
        $this->cashbackItemRepository = $cashbackItemRepository;
        $this->imageService = $imageService;
    }

    public function store(StoreMerchantRequest $request)
    {
        $data = $request->validated();
        $data['parent_id'] = '00000000-0000-0000-0000-000000000000';
        $this->checkAccess();
        $this->checkAccessBranchId($data['branch_id']);


       if(!$this->getAuthUser()->ability(["sadmin"],["merchant-can-change-is-verified"])){
           $data['is_verified'] = 0;
           $data['is_active'] = 0;
        }

        if(!isset($data['merchant_category_ids']) || $data['merchant_category_ids'] === null)
        {
            throw new \Exception('Категория мерчанта не может быть пустым. Укажите, пожалуйста категорию для мерчанта!');
        }

        if(isset($data["is_active"]) && isset($data["is_verified"]) &&
            $data["is_active"] ==1 && $data["is_verified"] == 0){
            throw new \Exception("Что бы статус мерчанта был \"Доступным\" измените поле проверки на \"Да\"");
        }

        try {
            DB::beginTransaction();
            $account = $this->accountService->createMerchantAccount();
            $data['account_id'] = $account['account_id'];
            $data['transit_account_id'] = $account['transit_account_id'];

            $merchant_cashback_id = $data['merchant_cashback_id'];
            $bank_cashback_id = $data['bank_cashback_id'];

            $data['highest_cashback_value'] = $this->cashbackItemRepository->GetMaxValueFromColumnValueByCashbackId($merchant_cashback_id, $bank_cashback_id);

            $folder = '/imgs/cashback/';


            if ($request->has('img_logo')) {
                $image_format = 'jpg';
                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4() . '_' . $timestamp . '.' . $image_format;

                $image = $request->file('img_logo');
                $this->imageService->saveWithParamAndWithPlatform($image, 64, 64, $folder, $name, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 64, 64, $folder, $name, 'ios', $image_format);

                $data['img_logo'] = $name;
            }

            if ($request->has('img_ad')) {
                $image_format = 'png';

                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4() . '_' . $timestamp . '.' . $image_format;

                $image = $request->file('img_ad');
                $this->imageService->saveWithParamAndWithPlatform($image, 122, 136, $folder, $name, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 122, 136, $folder, $name, 'ios', $image_format);

                $data['img_ad'] = $name;
            }

            if ($request->has('img_detail')) {
                $image_format = 'jpg';
                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4() . '_' . $timestamp . '.' . $image_format;

                $image = $request->file('img_detail');
                $this->imageService->saveWithParamAndWithPlatform($image, 360, 220, $folder, $name, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 360, 220, $folder, $name, 'ios', $image_format);

                $data['img_detail'] = $name;
            }
            $data['contract_file'] = $this->uploadContract($request);
            //Кто создал Мерчант
            $data["created_by_user_id"] = $this->getAuthUser()->id;

            $merchant = $this->merchantRepository->create($data);
            $merchant->setChanges($merchant->getAttributes());
            event(new UserModifiedEvent($merchant, Events::CREATED));

            DB::commit();
        }catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(UpdateMerchantRequest $request, $id)
    {
        $data = $request->validated();
        $data['parent_id'] = '00000000-0000-0000-0000-000000000000';
        $this->checkAccess();
        $this->checkAccessBranchId($data['branch_id']);

        if($this->getAuthUser()->can("merchant-can-only-change-is-verified"))
        {
            $is_verified = $data["is_verified"];
            $is_active = $data["is_active"];

            $data = [];
            $data["is_verified"] = $is_verified;
            $data["is_active"] = $is_active;

            $merchant = $this->merchantRepository->findById($id);

            $data['merchant_category_ids'] = $merchant->categories->pluck("id")->toArray();
            $data['merchant_cashback_id'] = $merchant->merchant_cashback_id;
            $data['bank_cashback_id'] = $merchant->bank_cashback_id;
        }


        if(!$this->getAuthUser()->ability(["sadmin"],["merchant-can-change-is-verified","merchant-can-only-change-is-verified"])){
            unset($data["is_verified"]);
            unset($data["is_active"]);
        }


        if(!isset($data['merchant_category_ids']) || $data['merchant_category_ids'] === null)
        {
            throw new \Exception("Категория мерчата не может быть пустым. Укажите, пожалуйста категорию для мерчанта!");
        }

        if(!$this->isEditable($this->merchantRepository->findById($id)))
        {
            throw new \Exception("Этого Мерчанта невозможно изменить!");
        }


        if(isset($data["is_active"]) && isset($data["is_verified"]) &&
            $data["is_active"] ==1 && $data["is_verified"] == 0){
            if ($this->merchantRepository->findById($id)->is_active == 1)
            {
                throw new \Exception("Невозможно изменить статус проверки на \"нет\" при статусе мерчанта \"Доступный\"");
            }else{
                throw new \Exception("Что бы изменит статус мерчанта на \"Доступным\" измените поле проверки на \"Да\"");
            }
        }

        try{
            DB::beginTransaction();
            $folder= '/imgs/cashback/';

            if ($request->has('img_logo') && $data['img_logo']!=null) {
                $image_format = 'jpg';
                $name = $this->findById($id)->img_logo;
                $this->deleteImage($name);

                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4(). '_' . $timestamp.'.'.$image_format;

                $image = $request->file('img_logo');
                $this->imageService->saveWithParamAndWithPlatform($image,64,64,$folder,$name,'android',$image_format);
                $this->imageService->saveWithParamAndWithPlatform($image,64,64,$folder,$name,'ios',$image_format);

                $data['img_logo']=$name;
            }

            if ($request->has('img_ad') && $data['img_ad']!=null) {
                $name = $this->findById($id)->img_ad;
                $this->deleteImage($name);

                $image_format='png';
                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4(). '_' . $timestamp.'.'.$image_format;

                $image = $request->file('img_ad');
                $this->imageService->saveWithParamAndWithPlatform($image,122,136,$folder,$name,'android',$image_format);
                $this->imageService->saveWithParamAndWithPlatform($image,122,136,$folder,$name,'ios',$image_format);

                $data['img_ad']=$name;
            }

            if ($request->has('img_detail') && $data['img_detail']!=null) {
                $name = $this->findById($id)->img_detail;
                $this->deleteImage($name);

                $image_format = 'jpg';
                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4(). '_' . $timestamp.'.'.$image_format;

                $image = $request->file('img_detail');
                $this->imageService->saveWithParamAndWithPlatform($image,360,220,$folder,$name,'android',$image_format);
                $this->imageService->saveWithParamAndWithPlatform($image,360,220,$folder,$name,'ios',$image_format);

                $data['img_detail']=$name;
            }
            $data['contract_file'] = $this->uploadContract($request);

            $merchant_cashback_id = $data['merchant_cashback_id'];
            $bank_cashback_id = $data['bank_cashback_id'];

            $data['highest_cashback_value'] = $this->cashbackItemRepository->GetMaxValueFromColumnValueByCashbackId($merchant_cashback_id, $bank_cashback_id);

            // Кто обновил Мерчант
            $data["updated_by_user_id"] = \Auth::user()->id;
            $merchant = $this->merchantRepository->update($data, $id);

            event(new UserModifiedEvent($merchant, Events::UPDATED));
            DB::commit();
        }catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
    }

    public function destroy($id)
    {
        $merchant = $this->findById($id);
        $merchant->is_active = 0;
        $merchant->save();
        return $merchant;
    }

    public function getTableList(&$filter)
    {
        $this->checkAccess();
        if(!$this->getAuthUser()->ability("sadmin", "merchant-can-all-branch") &&
           $this->getAuthUser()->can("merchant-can-by-user-branch"))
            $filter["branches_id"] = $this->getAuthUser()->branches()->pluck("id")->toArray();

        $merchantList = $this->merchantRepository->paginate($filter);
        $merchantList->appends($filter);
        unset($filter["branches_id"]);

        return $merchantList;
    }

    public function branchList()
    {
        if($this->getAuthUser()->ability(["sadmin"],["merchant-can-all-branch"])) {
            $branchs = $this->branchRepository->listsAll()
                ->prepend('', '');
        }elseif($this->getAuthUser()->can("merchant-can-by-user-branch")){
            $branchs = $this->branchRepository->listsByIds($this->getAuthUser()->branches()->pluck("id")->toArray())
                ->prepend('', '');
        }else{
            $branchs = [];
        }

        return $branchs;
    }

    public function checkAccess()
    {
        if(!$this->getAuthUser()->ability(["sadmin"],["merchant-can-by-user-branch","merchant-can-all-branch"])) {
            throw new ForbiddenException("У Вас нету право для записи этого филиала");
        }
    }

    public function checkAccessBranchId($branch_id)
    {
        if(!$this->getAuthUser()->ability(["sadmin"],["merchant-can-all-branch"]) &&
            $this->getAuthUser()->can("merchant-can-by-user-branch")) {
            if(!in_array($branch_id, $this->getAuthUser()->branches()->pluck("id")->toArray()))
                throw new ForbiddenException("У Вас нету право для записи этого филиала");

        }
    }

    public function findById($id)
    {
        $this->checkAccess();
        $model = $this->merchantRepository->findById($id);
        $this->checkAccessBranchId($model->branch_id);
        return $model;
    }

    public function deleteImage($name)
    {
        if($name!=null)
        {
            $folder = public_path(str_replace('/',DIRECTORY_SEPARATOR,'imgs/cashback/'));
            $this->imageService->delete($folder.'1', $name.'.jpg');
            $this->imageService->delete($folder.'2', $name.'.jpg');
            $this->imageService->delete($folder.'3', $name.'.jpg');
            $this->imageService->delete($folder.'hdpi', $name.'.jpg');
            $this->imageService->delete($folder.'ldpi', $name.'.jpg');
            $this->imageService->delete($folder.'mdpi', $name.'.jpg');
            $this->imageService->delete($folder.'xhdpi', $name.'.jpg');
            $this->imageService->delete($folder.'xxhdpi', $name.'.jpg');
            $this->imageService->delete($folder.'xxxhdpi', $name.'.jpg');
        }
    }

    public function isEditable(Merchant $merchant)
    {
        if(!$merchant->is_verified || $this->getAuthUser()->ability(["sadmin"],["merchant-can-change-is-verified", "merchant-can-only-change-is-verified"])) {
            return true;
        }

        return false;
    }

    public function getAuthUser()
    {
        return \Auth::user();
    }

    protected function uploadContract($request){
        if ($request->has('contract_file')) {
            $file = $request->file('contract_file');
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
            $filename = Uuid::uuid4(). '_' . $timestamp.'.'.$file->getClientOriginalExtension();
            $path = storage_path('app/merchant_contracts');
            if (!\File::exists($path)) {
                \File::makeDirectory($path, 0777, true);
            }
            $path = $file->storeAs('/merchant_contracts', $filename);
            return $filename;
        }
        return null;
    }
}
