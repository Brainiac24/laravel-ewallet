<?php

namespace App\Console\Commands\PreviouslyIdentifiedUsers;

use DB;
use App\Models\User\User;
use Illuminate\Console\Command;

class PreviouslyIdentifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:previously-identified-users';

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
        $users = DB::table('users')
            ->join("transactions",function($join){
                $join->on('users.id', '=', 'transactions.created_by_user_id');
            })
            ->join("services",function($join){
                $join->on('transactions.service_id', '=', 'services.id');
            })
            ->where('users.attestation_id', '=', "0ee95dcb-a078-11e8-904b-b06ebfbfa715")
            ->where(function($q){
                $q->where('services.is_enabled','=','0')
                  ->orWhere('transactions.service_id', '=', 'b1b1a032-d18f-460d-9203-910cf1d62cc8');
            })
            ->whereNotNull("users.verification_params_json")
            ->where('users.verification_params_json', 'NOT LIKE', '%is_previously_identified%')
            ->groupBy(["users.id"])
            ->get(["users.id"]);

        $totalFound = $users->count();

        // Прогресс бар start
        $this->output->progressStart($totalFound);

        $totalChange = 0;
        $users->each(function($user)use(&$totalChange){

            $userModel = User::find($user->id);
            $verificationParamsJson = $userModel->verification_params_json;
            $verificationParamsJson["is_previously_identified"] = true;
            $userModel->verification_params_json = $verificationParamsJson;
            $userModel->save();

            $totalChange++;
            $this->output->progressAdvance();
        });

        $this->output->progressFinish();

        $this->output->text([
            "Found users: $totalFound",
            "Add field \"previously identified\": $totalChange"
        ]);
    }
}
