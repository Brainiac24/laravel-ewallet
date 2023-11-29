<?php
namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Services\Common\Helpers\Logger\Logger;

class BaseSeeder extends Seeder
{
    protected $logger;

    public function __construct()
    {
        //Log::useDailyFiles(storage_path().'/logs/database/seeding.log');
        $this->logger = new Logger("database/seeding", 'seeding');
    }
}
