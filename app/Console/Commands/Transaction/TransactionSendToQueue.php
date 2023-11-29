<?php

namespace App\Console\Commands\Transaction;

use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Services\Common\Gateway\Queue\QueueHandlerEnum;
use App\Services\Common\Gateway\Queue\QueueTransporterContract;
use App\Services\Common\Helpers\TransactionQueuedStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;

class TransactionSendToQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:send-to-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $transactionRepository;
    protected $queueTransporter;
    protected $logger;

    /**
     * TransactionSendToQueue constructor.
     * @param TransactionRepositoryContract $transactionRepository
     * @param QueueTransporterContract $queueTransporter
     * @throws \Exception
     */
    public function __construct(TransactionRepositoryContract $transactionRepository, QueueTransporterContract $queueTransporter)
    {
        parent::__construct();

        $this->transactionRepository = $transactionRepository;
        $this->queueTransporter = $queueTransporter;
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

        $transactions = $this->transactionRepository->getAllByNotSendToQueue();

        $this->logger->info("Количество отправляемых транзакции: {$transactions->count()}");


        foreach ($transactions as $transaction) {

            try {

                $payload = [
                    'id' => $transaction->id,
                    'session_number' => (string)$transaction->session_number,
                    'amount' => (string)$transaction->amount,
                    'processing_code' => (string)$transaction->service->processing_code,
                    'account' => (string)$this->getMainParamValue($transaction),
                    'status' => $transaction->transaction_status_id,
                    'push_token' => $transaction->from_account_without_g_scopes->user->devices_json['push_token'] ?? null,
                ];

                $queue = $this->queueTransporter->send($payload, QueueHandlerEnum::PROCESSING);

                $transaction->is_queued = TransactionQueuedStatus::ERROR_SEND;

                if (isset($queue['success']) && $queue['success'])
                    $transaction->is_queued = TransactionQueuedStatus::SENT;

                $transaction->save();

            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $transaction->is_queued = TransactionQueuedStatus::ERROR_SEND;
                $transaction->save();
            } catch (\Throwable $e) {
                $this->logger->error($e->getMessage());
                $transaction->is_queued = TransactionQueuedStatus::ERROR_SEND;
                $transaction->save();
            }
        }

        $this->logger->info(' Finished: ' . __CLASS__);
    }

    protected function getMainParamValue($transaction)
    {
        $params_value = null;
        foreach ($transaction->service->params_json as $value) {

            foreach ($transaction->params_json as $value2) {
                //dd($value2);
                if (isset($value['is_main'])) {
                    if ($value['is_main'] == 1 && $value['input_name'] == $value2['key']) {
                        $params_value = $value2;
                    }
                }
            }
        }

        if ($params_value == null) {
            if (isset($transaction->params_json[0])) {
                $params_value = $transaction->params_json[0];
            }
        }

        return $params_value['value'];
    }
}
