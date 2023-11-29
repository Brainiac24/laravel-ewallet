<?php

namespace App\Console;

//use App\Console\Commands\CurrencyRate\GetCurrencyRate;
use App\Console\Commands\CurrencyRate\GetCurrencyRate;
use App\Console\Commands\MigrateCommand;
use App\Console\Commands\Transaction\TransactionSendToQueue;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class,
        GetCurrencyRate::class,
        TransactionSendToQueue::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:get-currency_rates')
            ->everyFifteenMinutes();

        $schedule->command('command:get_currency_rate_esh_transfer')
            ->everyFifteenMinutes();

        $schedule->command('transaction:send-to-queue')
            ->everyFifteenMinutes();

        $schedule->command('command:build-report')
            ->dailyAt('23:59');

        $schedule->command('command:build-report')
            ->dailyAt('00:00');

        $schedule->command('backup:run --only-db')
            ->dailyAt('23:10');

        $schedule->command('backup:run --only-files')
            ->weeklyOn(1, '03:00');

        $schedule->command('backup:clean')
            ->weeklyOn(1, '01:00');

        $schedule->command('backup:monitor')
            ->dailyAt('06:50');

        $schedule->command('identification:accounts-check')
            ->dailyAt('12:00');

        $schedule->command('identification:accounts-check')
            ->dailyAt('18:00');

        $schedule->command('command:abs_account-to-account_sync_abs_command')
            ->everyFifteenMinutes()->unlessBetween('01:50', '03:30');

        $schedule->command('schedule:process')
            ->everyMinute();
        $schedule->command('command:withdraw_money_to_merchant_account')
            ->dailyAt('08:00');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
