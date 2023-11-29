<?php

namespace App\Repositories\Backend\User\Client;


use App\Exceptions\Backend\Web\ForbiddenException;
use App\Models\Account\Account;
use App\Models\Account\Scopes\OwnUserIdScope;
use App\Models\User\Filters\ClientFilter;
use App\Models\User\User;
use App\Services\Common\Helpers\Attestation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 19.07.2017
 * Time: 11:12
 */
class ClientEloquentRepository implements ClientRepositoryContract
{
    protected $client;


    public function __construct(User $client)
    {
        $this->client = $client;
    }

    public function getForDataTable()
    {

    }

    public function all($data = [], $columns = ['*'])
    {
        $client = $this->client->with(['accounts' => function ($q) {
            $q->with('currency')->where('account_type_id', config('app_settings.default_wallet_account_type_id'))->withoutGlobalScope(OwnUserIdScope::class);
        }])->
        orderBy('created_at', 'desc')->isClient()->with('attestation', 'user_histories')->filterBy(new ClientFilter($data))->get($columns);
//        if ($users->isEmpty())
//            throw new ModelNotFoundException();
        return $client;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
//        dd(config('app_settings.default_wallet_account_type_id'));

        return $this->client->isClient()->select($columns)
            ->with(['accounts' => function ($q) {
                $q->with('currency')->where('account_type_id', config('app_settings.default_wallet_account_type_id'))->withoutGlobalScope(OwnUserIdScope::class);
            }])
            ->with('attestation','document_type','country','region','area','city','country_born')
            ->filterBy(new ClientFilter($data))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->client->isClient()->with('attestation', 'accounts.currency', 'user_histories.user_events')->get()->pluck('full_name', 'id');
    }

    public function create(array $data)
    {
        DB::transaction(function () use ($data, &$client) {
            $this->client->isClient()->fill($data);
            $client = $this->client->save();
            if (isset($data['roles_id']))
                ($data['roles_id'] === null) ? $client->roles()->sync([]) : $client->roles()->sync($data['roles_id']);
        });
        return $client;
    }

    public function findById($id, $columns = ['*'])
    {
//        $user = User::with('roles', 'stores')->select(['roles.display_name'])->findOrFail($id);
        $client = $this->client->with('user_session')->isClient()->select($columns)->findOrFail($id);
        return $client;
    }

    public function findByMSISDN($msisdn, $columns = ['*'])
    {
        $client = $this->client->isClient()->with('attestation')->with(['accountsWithoutGlobalScope' => function ($q) {
            $q->where('account_type_id', '=', config('app_settings.default_wallet_account_type_id'));
        }])->where('msisdn', $msisdn)->first();

//        dd($user->accountsWithoutGlobalScope);
        return $client;
    }

    public function update(array $data, $id)
    {
        $client = $this->client->isClient()->findOrFail($id);
        empty($data['password']) ?: $client->password = $data['password'];
        DB::transaction(function () use ($client, $data) {
            // если юзер садмин то невозможно изменить роля
            // if ($user->id!==USER::SADMIN)
            //{
            if (isset($data['roles_id']))
                ($data['roles_id'] === null) ? $client->roles()->sync([]) : $client->roles()->sync($data['roles_id']);
            //}
            $client->update($data);
        });
        return $client;
    }

    public function lastLoginUpdate($id)
    {
        $client = $this->isClient()->findById($id);
        $client->last_login_at = Carbon::now()->format('Y-m-d H:i:s');
        $client->save();
        return $client;
    }

    public function destroy($id)
    {

        $client = $this->findById($id);
        $client->is_active = 0;
        $client->save();
        return $client;
    }

    public function unlock($id)
    {
        $client = $this->findById($id);
        $client->is_active = 1;
        $client->blocked_count = 0;
        $client->sms_confirm_try_count = 0;
        $client->email_confirm_try_count = 0;
        $client->unblock_at = Carbon::now();
        $client->save();
        return $client;
    }

    public function identificate(array $data, $id)
    {
        $client = $this->findById($id);
        $client->first_name = $data['first_name'];
        $client->middle_name = $data['middle_name'];
        $client->last_name = $data['last_name'];
        $client->document_type_id = $data['document_type_id'];
        $client->country_id = $data['country_id'];
        $client->country_born_id = $data['country_born_id'];
        $client->region_id = $data['region_id'];
        $client->area_id = $data['area_id'];
        $client->city_id = $data['city_id'];
        $array = $client->contacts_json ?? [];
        $client->contacts_json = array_replace($array, $data['contacts_json']);
        $client->attestation_id = Attestation::NOT_IDENTIFIED;
        $verificationData=[];
        $verificationData['is_verified']= 2;
        $verificationData['id']= (string)Uuid::uuid4();
        $verificationData['verify_user_id']=Auth::user()->id;
        $verificationData['verify_user_login']=Auth::user()->username;
        $verificationData['verify_date']=(string)Carbon::now();
        $verificationData['verify_by_system']='Admin Panel';
        $client->verification_params_json = $verificationData;
        $client->save();
        return $client;
    }

    public function identificateEdit(array $data, $id)
    {
        $client = $this->findById($id);
        $client->first_name = $data['first_name'];
        $client->middle_name = $data['middle_name'];
        $client->last_name = $data['last_name'];
        $client->document_type_id = $data['document_type_id'];
        $client->country_id = $data['country_id'];
        $client->country_born_id = $data['country_born_id'];
        $client->region_id = $data['region_id'];
        $client->area_id = $data['area_id'];
        $client->city_id = $data['city_id'];
        $array = $client->contacts_json ?? [];
        $client->contacts_json = array_replace($array, $data['contacts_json']);
        //$client->attestation_id = Attestation::NOT_IDENTIFIED;
        $verificationData = [];
        //$verificationData['is_verified']= 2;
        $verificationData['id'] = (string)Uuid::uuid4();
        $verificationData['verify_user_id'] = Auth::user()->id;
        $verificationData['verify_user_login'] = Auth::user()->username;
        $verificationData['verify_date'] = (string)Carbon::now();
        $verificationData['verify_by_system'] = 'Admin Panel';
        $client->verification_params_json = $verificationData;
        $client->save();
        return $client;
    }

    public function updateLite(array $data, $id)
    {
        $client = $this->findById($id);
        $client->country_id = $data['country_id'];
        $client->region_id = $data['region_id'];
        $client->area_id = $data['area_id'];
        $client->city_id = $data['city_id'];

        $form_contacts_json = [];

        foreach (["street","house","flat","documentCreateDate"] as $field)
        {
            if(array_key_exists($field,$data['contacts_json']))
            {
                $form_contacts_json[$field] = $data['contacts_json'][$field];
            }
        }

        $array = $client->contacts_json ?? [];
        $client->contacts_json = array_replace($array, $form_contacts_json);
        $client->country_born_id = $data['country_born_id'];

        $client->save();
        return $client;
    }

    public function block($id)
    {
        $client = $this->findById($id);
        $client->is_active = 0;
        $client->blocked_at = Carbon::now();
        $client->blocked_count = $client->blocked_count + 1;
        $client->save();
        return $client;
    }

    public function addCodeMap($id, $code_map)
    {
        $client = $this->findById($id);

        if (!empty($client->code_map))
            throw new ForbiddenException("АБС код уже существует, невозможно добавить!");

        $client->code_map = $code_map;
        $client->save();
        return $client;
    }

    public function deleteCodeMap($id)
    {
        $client = $this->findById($id);
        $client->code_map = null;
        $client->card_last_sync_at = null;
        $client->account_last_sync_at = null;
        $client->credit_last_sync_at = null;
        $client->deposit_last_sync_at = null;
        $client->card_last_update_balance_sync_at = null;
        $client->save();
        return $client;
    }

    public function resetPassword($id)
    {
        $client = $this->findById($id);
        $client->password_params_json = null;
        $client->save();
        return $client;
    }

    public function deletePin($id)
    {
        $client = $this->findById($id);
        $client->pin_params_json = null;
        $devices = $client->devices_json;
        $devices['old_device'] = "";
        $client->devices_json = $devices;
        //$client->is_auth = 0; Конфликт дод temp_users кади уже пользователь хай гуфт. Камол кади Зум карда дидим коди ASP я 0 кардан даркор не шуд.
        $client->blocked_at = null;
        $client->unblock_at = null;
        $client->save();
        return $client;
    }

    public function deleteEmail($id)
    {
        $client = $this->findById($id);
        $client->email = null;
        $client->save();
        return $client;
    }

    public function resetIdentification($id)
    {
        $client = $this->findById($id);
        $client->attestation_id = '0ee95dcb-a078-11e8-904b-b06ebfbfa715';
        $client->contacts_json = null;
        $client->first_name = null;
        $client->last_name = null;
        $client->middle_name = null;
        $client->country_id = null;
        $client->country_born_id = null;
        $client->region_id = null;
        $client->area_id = null;
        $client->city_id = null;
        $client->document_type_id = null;
        $client->code_map = null;
        $client->card_last_sync_at = null;
        $client->account_last_sync_at = null;
        $client->credit_last_sync_at = null;
        $client->deposit_last_sync_at = null;
        $client->card_last_update_balance_sync_at = null;
        $arr = $client->verification_params_json;
        $arr['is_verified'] = 0;
        $arr['verify_user_id'] = Auth::id();
        $arr['verify_user_login'] = Auth::user()->username;
        $arr['verify_date'] = Carbon::now()->format('Y-m-d H:i:s');
        $arr['verify_by_system'] = 'Admin panel';
        $client->verification_params_json = $arr;
        $client->email = null;
        $client->save();
        return $client;
    }
}