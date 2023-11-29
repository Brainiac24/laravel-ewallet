<?php


namespace App\Services\Backend\Web\ExportJob\ReplenishmentEwalletEskhataTransactionsExportJob;


use App\Exports\ReplenishmentEwalletEskhataTransactions\ReplenishmentEwalletEskhataTransactionsExportCsv;
use App\Jobs\ExportToCsvJob;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use Carbon\Carbon;

class ReplenishmentEwalletEskhataTransactionsExportJobService implements ReplenishmentEwalletEskhataTransactionsExportJobServiceContract
{
    private $jobHistoryRepository;

    public function __construct(JobHistoryRepositoryContract $jobHistoryRepository)
    {
        $this->jobHistoryRepository = $jobHistoryRepository;
    }

    public function create($data)
    {
        \DB::beginTransaction();
        try {
            $jobHistoryData["name"] = "ReplenishmentEwalletEskhataTransactionsExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "Clients_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new ReplenishmentEwalletEskhataTransactionsExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            \DB::rollBack();
            throw $e;
        }
    }
}