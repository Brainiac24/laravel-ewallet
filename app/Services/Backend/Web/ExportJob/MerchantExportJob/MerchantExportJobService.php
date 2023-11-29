<?php

namespace App\Services\Backend\Web\ExportJob\MerchantExportJob;

use App\Exceptions\Backend\Web\ForbiddenException;
use App\Services\Common\Helpers\JobHistoryType;
use DB;
use Carbon\Carbon;
use App\Jobs\ExportToCsvJob;
use App\Exports\Merchant\MerchantExportCsv;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;

class MerchantExportJobService implements MerchantExportJobServiceContract
{
    private $jobHistoryRepository;

    public function __construct(JobHistoryRepositoryContract $jobHistoryRepository)
    {
        $this->jobHistoryRepository = $jobHistoryRepository;
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            if(!\Auth::user()->ability(["sadmin"],["merchant-can-by-user-branch","merchant-can-all-branch"])) {
                throw new ForbiddenException("У Вас нету право для записи этого филиала");
            }

            if(!\Auth::user()->ability("sadmin", "merchant-can-all-branch") &&
                \Auth::user()->can("merchant-can-by-user-branch"))
                $data["branches_id"] = \Auth::user()->branches()->pluck("id")->toArray();

            $jobHistoryData["name"] = "MerchantExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "Merchant_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistoryData["type"] = JobHistoryType::EXPORT;
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new MerchantExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}