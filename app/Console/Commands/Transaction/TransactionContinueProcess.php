<?php

namespace App\Console\Commands\transaction;

use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Services\Common\Helpers\TransactionQueuedStatus;
use Illuminate\Console\Command;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

class TransactionContinueProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:continue-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will continue transaction when is_queued == -1';

    protected $transactionRepository;
    protected $logger;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TransactionRepositoryContract $transactionRepository)
    {
        parent::__construct();

        $this->transactionRepository = $transactionRepository;

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
        $this->info(' Started: ' . __CLASS__);

        $transactions = $this->transactionRepository->getAllByWillContinueProcess();

        $this->logger->info("Количество отправляемых транзакции: {$transactions->count()}");
        $this->info("Количество отправляемых транзакции: {$transactions->count()}");

        $client = new Client();

        $i=0;

        foreach ($transactions as $transaction) {
            try {
                $i++;

                $this->logger->info("$i - транзакция отправлено: {$transaction['id']}");
                $this->info("$i - транзакция отправлено: {$transaction['id']}");

                $response = $client->request('POST', config('queue_transporter.queue_callback_url') , ['json' => ['transaction_id' =>  $transaction->id]]);

                $body = $response->getBody();

                $data = json_decode($body->getContents(), true);

                if ( isset($data['success']) && $data['success'] === false){
                    $this->logger->error($data['message']);
                    $this->error($data['message']);
                    $transaction->is_queued = TransactionQueuedStatus::ERROR_SEND;
                    $transaction->save();
                }

                if (isset($data['success']) && $data['success'] === true){
                    $this->logger->info("$i - транзакция получено: ".$data['message']);
                    $this->info("$i - транзакция получено:  ".$data['message']);
                }

            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->error($e->getMessage());
                $transaction->is_queued = TransactionQueuedStatus::ERROR_SEND;
                $transaction->save();
            } catch (\Throwable $e) {
                $this->logger->error($e->getMessage());
                $this->error($e->getMessage());
                $transaction->is_queued = TransactionQueuedStatus::ERROR_SEND;
                $transaction->save();
            }
        }

        $this->logger->info(' Finished: ' . __CLASS__);
        $this->info(' Finished: ' . __CLASS__);
    }
}
