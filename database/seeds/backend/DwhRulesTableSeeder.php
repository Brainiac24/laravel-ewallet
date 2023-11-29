<?php

use Illuminate\Database\Seeder;

class DwhRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dwhRules = [];
        $jobLogTypes = config('job_log_type_helper.types') ?? [];
        foreach ($jobLogTypes as $logType => $description) {
            $dwhRules[] = [
                'id' => Ramsey\Uuid\Uuid::uuid4(),
                'table' =>'job_logs',
                'job_log_type' => $logType,

            ];
        }
        $dwhRules[] = [
            'id' => Ramsey\Uuid\Uuid::uuid4(),
            'table' =>'user_histories',
            'job_log_type' => null,
        ];
        $dwhRules[] = [
            'id' => Ramsey\Uuid\Uuid::uuid4(),
            'table' =>'transaction_histories',
            'job_log_type' => null,
        ];

        \App\Models\DwhRule\DwhRule::insert($dwhRules);

    }
}
