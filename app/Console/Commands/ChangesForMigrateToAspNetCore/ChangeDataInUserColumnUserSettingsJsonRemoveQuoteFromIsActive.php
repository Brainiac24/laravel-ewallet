<?php

namespace App\Console\Commands\ChangesForMigrateToAspNetCore;

use App\Repositories\Backend\User\UserRepositoryContract;
use Illuminate\Console\Command;

class ChangeDataInUserColumnUserSettingsJsonRemoveQuoteFromIsActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:change-user-settings-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update data in table User column UserSettingsJson remove quotes from property is_active';


    protected $userRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryContract $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $users = $this->userRepository->getAllUserWhereNotNullUserSettingsJson();

        foreach ($users as $user) {

            $userSettingsJson = $user->user_settings_json;

            foreach ($userSettingsJson as $key => $value) {
                if ($userSettingsJson[$key]["is_active"] === "1") {
                    $userSettingsJson[$key]["is_active"] = 1;
                } elseif ($userSettingsJson[$key]["is_active"] === "0") {
                    $userSettingsJson[$key]["is_active"] = 0;
                }
            }

            $user->user_settings_json = $userSettingsJson;

            $user->save();
        }

    }
}
