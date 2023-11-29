<?php

namespace App\Console\Commands;

use App\Models\JobLog\JobLog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveRowsFromTableJobLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remove_rows_from_table_job_logs {date_to} {limit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var JobLog
     */
    private $jobLog;

    private $logger;

    /**
     * RemoveRowsFromTableJobLogs constructor.
     * @param JobLog $jobLog
     * @throws \Exception
     */
    public function __construct(JobLog $jobLog)
    {
        parent::__construct();

        //$this->logger = new Logger('commands', 'CREATE_BONUS_ACCOUNTS');
        $this->jobLog = $jobLog;
    }

    /***
     * @throws \Exception
     */
    public function handle()
    {
        $job_ids = $this->jobLog
            ->where('created_at', '<=', Carbon::parse($this->argument('date_to') . ' 23:59:59')->toDateTimeString())
            ->take($this->argument('limit'))
            ->pluck('id')
            ->toArray();

        $count = count($job_ids);
        echo "Кол-во записей для удаления: {$count } \n";

        if ($count > 0) {
            $result = $this->jobLog->whereIn('id', $job_ids)->delete();
            echo "Результат удаленных записей: {$result}";
        }
    }
}
