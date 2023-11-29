<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute all sub folder for migrate';

    protected $path_migration = 'database\migrations\\';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
        $this->info("Migration starting");

        \Artisan::call('migrate', ['--path' => "{$this->path_migration}*"]);
        echo \Artisan::output();

        $this->info("Migration finished");
    }
}
