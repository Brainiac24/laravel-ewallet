<?php

namespace App\Console\Commands\CurrencyRate;

use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Services\Common\Gateway\Queue\QueueHandlerEnum;
use App\Services\Common\Gateway\Queue\QueueTransporterContract;
use App\Services\Common\Helpers\CurrencyRateCategory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;

class GetCurrencyRate extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-currency_rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get currency rates with queue callback';

    protected $currencyRepository;
    protected $queueTransport;
    protected $logger;


    public function __construct(CurrencyRepositoryContract $currencyRepository, QueueTransporterContract $queueTransporter)
    {
        parent::__construct();
        $this->currencyRepository = $currencyRepository;
        $this->queueTransport = $queueTransporter;
//        Log::useDailyFiles(storage_path() . '/logs/schedules/schedule-' . Carbon::now()->toDateString() . '.log');

        $this->logger = new \Monolog\Logger($this->signature);
        $folder = 'schedules';
        $this->logger->pushHandler(new StreamHandler(sprintf('%s/logs/%s/info-%s.log', storage_path(), $folder, \Carbon\Carbon::now()->toDateString()), \Monolog\Logger::INFO));
        $this->logger->pushHandler(new StreamHandler(sprintf('%s/logs/%s/error-%s.log', storage_path(), $folder, \Carbon\Carbon::now()->toDateString()), \Monolog\Logger::ERROR));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->logger->info(' Started: ' . __CLASS__);

        $currencies = $this->currencyRepository->allExceptTJS();

        $this->logger->info("Количество отправляемых курсов: {$currencies->count()}");

        foreach ($currencies as $item) {
            try {
                $payload = [
                    'date' => Carbon::now()->format('Y.m.d'),
                    'code_iso' => (string)$item->code,
                    'cur_iso' => $item->iso_name,
                    'type_rate' => CurrencyRateCategory::DEFAULT_CODE_MAP,
                ];

                $this->queueTransport->send($payload, QueueHandlerEnum::ABS_CURRENCY_RATE);
            } catch (\Exception $e) {
                $this->logger->info($e->getMessage());
            } catch (\Throwable $e) {
                $this->logger->info($e->getMessage());
            }
        }

        $this->logger->info(' Finished: ' . __CLASS__);
    }
}
