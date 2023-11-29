<?php

namespace App\Console\Commands\Merchant;

use App\Jobs\Merchant\SendEmailReportMerchantJob;
use App\Models\Merchant\Merchant;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use App\Services\Common\Helpers\JobHistoryType;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendEmailReportMerchantCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_email_report_merchant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $merchant;
    protected $jobHistoryRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->merchant = new Merchant();
        $this->jobHistoryRepository = \App::make(JobHistoryRepositoryContract::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('handling send email command');
        $this->merchant->where('generate_report', 1)
            ->with('merchant_items')
            ->where('is_active', 1)
            ->each(function ($item) {
                Log::info('here merchant which have generate_report=1 '.$item->name);
                try{
                    $dateLast = Carbon::parse($item->params_json['report']['last_send'])
                        ->addDay($item->params_json['report']['interval'])->format('Y-m-d');
                    $dateNow = Carbon::now()->format('Y-m-d');
                    if ($dateLast <= $dateNow){
                        $data['from_date_finish'] = $this->getPeriod($item->params_json['report']['period']);
                        $data['to_date_finish'] = $dateNow;
                        if ($item->params_json['report']['is_send_to_merchant']??false){
                            Log::info('is_send_to_merchant, sending to job');
                            $data['merchant_id'] = $item->id;
                            $this->sendToJob($data, $item->email, $item->id);
                        }
                        if($item->params_json['report']['is_send_to_all_mechant_item']??false){
                            unset($data['merchant_id']);
                            Log::info('is_send_to_all_mechant_item, sending all merchant items');
                            foreach ($item->merchant_items as $merchant_item){
                                $data['merchant_item_id'] = $merchant_item->id;
                                $this->sendToJob($data,  $merchant_item->email, $item->id);
                            }
                        }elseif(isset($item->params_json['report']['merchant_items'])){
                            unset($data['merchant_id']);
                            foreach ($item->merchant_items as $merchant_item){
                                if (in_array($merchant_item->id, $item->params_json['report']['merchant_items'])){
                                    $data['merchant_item_id'] = $merchant_item->id;
                                    $this->sendToJob($data, $merchant_item->email, $item->id);
                                }
                            }
                        }
                    }
                }catch (\Exception $ex){
                    \Log::error(json_encode($ex->getTrace()));
                }

            },1000);
    }

    private function sendToJob($data, $emails='test@mail.ru', $merchant_id)
    {
        \DB::beginTransaction();
        try {
            $jobHistoryData["name"] = "SendEmailReportMerchantCommand";
            $jobHistoryData["filename"] = "Merchant_transactions".$data['from_date_finish'].'-'.$data['to_date_finish'].microtime().".csv";
            $jobHistoryData["type"] = JobHistoryType::EXPORT;
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            Log::info('created job history record, dispatching send email job');
            SendEmailReportMerchantJob::dispatch($data, $jobHistoryData["filename"], $jobHistory->id, $emails, $merchant_id)->onQueue('emails');
            \DB::commit();
        }catch (\Exception $ex){
            \DB::rollBack();
            \Log::error(json_encode($ex->getTrace()));
        }
    }

    private function getPeriod($period)
    {
        $data = explode(':', $period);
        $date = Carbon::now();
        if (count($data)==3){
            $date->subDay(abs($this->getNumeric($data[0])))->subMonth(abs($this->getNumeric($data[1])))->subYear(abs($this->getNumeric($data[2])));
        }
        return $date->format('Y-m-d');
    }

    private function getNumeric($str)
    {
        return (int)str_replace('x','', $str);
    }


}
