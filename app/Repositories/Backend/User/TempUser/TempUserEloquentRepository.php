<?php

namespace App\Repositories\Backend\User\TempUser;

use App\Models\TempUser\Filters\TempUserFilter;
use App\Models\TempUser\TempUser;

class TempUserEloquentRepository implements TempUserRepositoryContract
{

    protected $tempUser;

    public function __construct(TempUser $tempUser)
    {
        $this->tempUser = $tempUser;
    }

    public function all($columns = ['*'])
    {
        return $this->tempUser->get($columns);
    }

    public function getIdByCodeMap($code)
    {
        $item = $this->tempUser->where('code_map', $code)->first();
        return $item != null ? $item->id : null;
    }

    public function findByMSISDN($msisdn)
    {
        return $this->tempUser->where('msisdn', $msisdn)->first();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->tempUser->select($columns)->with('country', 'country_born', 'region', 'area', 'city', 'document_type')->filterBy(new TempUserFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->tempUser->with('country', 'country_born', 'region', 'area', 'city', 'document_type')->where('id', $id)->first();
    }
}
