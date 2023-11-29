<?php

namespace App\Console\Commands\ReportBuilder;

use App\Exports\ReportExports\ReportExport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class BuildReportOn00hr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:build-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Excell Report at 00 HR. Balances Remain';

    public function __construct()
    {

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '999M');

        $dateResult = Carbon::now();
        $dateResult = str_replace(' ', '', str_replace('-', '', str_replace(':', '', $dateResult)));
        $filename = sprintf('Report_on_00HR_%s_%s.xlsx', $dateResult, Uuid::uuid4());
        $result = (new ReportExport())->store($filename, 'report');
        $path = public_path(DIRECTORY_SEPARATOR . 'reports' . DIRECTORY_SEPARATOR);
        if (!\File::isDirectory($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }
        $copyResult = \File::copy(storage_path() . DIRECTORY_SEPARATOR . 'reports' . DIRECTORY_SEPARATOR . $filename, public_path(DIRECTORY_SEPARATOR . 'reports' . DIRECTORY_SEPARATOR . $filename));
        if ($result) {
            echo "Report Success!";
        } else {
            echo "report Failed";
        }

    }
}
