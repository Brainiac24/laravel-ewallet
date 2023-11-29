<?php

namespace App\Console\Commands\Order;

use App\Services\Common\EwalletApi\EwalletApiClientServiceContract;
use App\Services\Common\Helpers\EwalletApiExceptionHelper;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class IdentificationAccountsCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'identification:accounts-check';

    private $ewalletApiClientServiceContract;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EwalletApiClientServiceContract $ewalletApiClientServiceContract)
    {
        $this->ewalletApiClientServiceContract = $ewalletApiClientServiceContract;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $response = $this->ewalletApiClientServiceContract->getHttpClient()->get("api/v2.2/identification/accounts/check");
            echo $response->getBody()->getContents();
        }
        catch (ClientException $e)
        {
            throw new \Exception(EwalletApiExceptionHelper::getMessage($e));
        }

    }
}
