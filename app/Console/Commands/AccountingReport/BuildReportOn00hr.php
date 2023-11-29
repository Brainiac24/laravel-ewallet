<?php

namespace App\Console\Commands\AccountingReport;

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
    protected $signature = 'command:accounting-report';

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
        try{
        $dateResult = Carbon::now()->format('Y-m-d');
        $dateResult = str_replace(' ', '', str_replace('-', '', str_replace(':', '', $dateResult)));
        $filename = sprintf('Report_on_accounting_00HR_%s_%s.csv', $dateResult, Uuid::uuid4());
        $dateReportResult = (string)Carbon::now()->format('d.m.Y');
        //header
        $reportContent=$dateReportResult.";".$dateReportResult."\n";
        $sqlReportSource = '
        SELECT s.name , SUM(t.commission) com
        FROM transactions t , services s 
        WHERE t.service_id= s.id
        AND t.transaction_type_id NOT IN ("5bf88042-a9e3-11e8-904b-b06ebfbfa715")  
        AND t.created_at BETWEEN STR_TO_DATE("'.$dateReportResult." 00:00:00".'", "%d.%m.%Y %H:%i:%s") AND STR_TO_DATE("'.$dateReportResult." 23:59:59".'", "%d.%m.%Y %H:%i:%s") GROUP BY s.name   HAVING SUM(t.commission) > 0';
        //echo $sqlReportSource;
        $path = public_path(DIRECTORY_SEPARATOR . 'reports' . DIRECTORY_SEPARATOR);
        if (!\File::isDirectory($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        $reportData= \DB::select($sqlReportSource);
        foreach ($reportData as &$value) {
            $reportContent = $reportContent.sprintf("300005;%s;2;%s\n", $value->name,$value->com); ;
        }

        \Storage::disk('report')->put($filename, $reportContent);
            $copyResult = \File::copy(storage_path() . DIRECTORY_SEPARATOR . 'reports' . DIRECTORY_SEPARATOR . $filename, public_path(DIRECTORY_SEPARATOR . 'reports' . DIRECTORY_SEPARATOR . $filename));
            echo "Done!";
        }catch (\Exception $e){
            echo "[MISTAKE] ". $e->getMessage();
        }
    }
}
