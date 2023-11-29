<?php

namespace App\Console\Commands\Order;

use App\Repositories\Backend\Order\OrderRepositoryContract;
use App\Services\Common\Helpers\OrderQueuedStatus;
use Illuminate\Console\Command;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

class OrderContinueProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:continue-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will continue order when is_queued == -1';
    /**
     * @var OrderRepositoryContract
     */
    protected $orderRepository;
    protected $logger;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OrderRepositoryContract $orderRepositoryContract)
    {
        parent::__construct();


        $this->orderRepository = $orderRepositoryContract;
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

        $orders = $this->orderRepository->getAllByWillContinueProcess();

        $this->logger->info("Количество отправляемых заявки: {$orders->count()}");
        $this->info("Количество отправляемых заявки: {$orders->count()}");

        $client = new Client();

        $i=0;

        foreach ($orders as $order) {
            try {
                $i++;

                $this->logger->info("$i - заявка отправлено: {$order['id']}");
                $this->info("$i - заявка отправлено: {$order['id']}");

                $response = $client->request('POST', config('queue_transporter.queue_callback_url') , ['json' => ['order_id' =>  $order->id]]);

                $body = $response->getBody();

                $data = json_decode($body->getContents(), true);

                if ( isset($data['success']) && $data['success'] === false){
                    $this->logger->error($data['message']);
                    $this->error($data['message']);
                    $order->is_queued = OrderQueuedStatus::ERROR_SEND;
                    $order->save();
                }

                if (isset($data['success']) && $data['success'] === true){
                    $this->logger->info("$i - заявка получено: ".$data['message']);
                    $this->info("$i - заявка получено:  ".$data['message']);
                }

            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->error($e->getMessage());
                $order->is_queued = OrderQueuedStatus::ERROR_SEND;
                $order->save();
            } catch (\Throwable $e) {
                $this->logger->error($e->getMessage());
                $this->error($e->getMessage());
                $order->is_queued = OrderQueuedStatus::ERROR_SEND;
                $order->save();
            }
        }

        $this->logger->info(' Finished: ' . __CLASS__);
        $this->info(' Finished: ' . __CLASS__);
    }
}
