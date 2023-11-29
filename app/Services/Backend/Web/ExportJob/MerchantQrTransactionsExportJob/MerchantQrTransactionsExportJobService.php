<?php

namespace App\Services\Backend\Web\ExportJob\MerchantQrTransactionsExportJob;


use App\Exceptions\Backend\Web\ForbiddenException;
use App\Services\Common\Helpers\JobHistoryType;
use DB;
use Carbon\Carbon;
use App\Jobs\ExportToCsvJob;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use App\Exports\MerchantQrTransactions\MerchantQrTransactionsExportCsv;

class MerchantQrTransactionsExportJobService implements MerchantQrTransactionsExportJobServiceContract
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
                $data["merchant_branches_id"] = \Auth::user()->branches()->pluck("id")->toArray();

            $jobHistoryData["name"] = "MerchantQrTransactionsExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "MerchantQrTransactions_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistoryData["type"] = JobHistoryType::EXPORT;
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new MerchantQrTransactionsExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}