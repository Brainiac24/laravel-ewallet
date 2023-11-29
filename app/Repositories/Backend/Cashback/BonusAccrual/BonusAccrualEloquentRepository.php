<?php


namespace App\Repositories\Backend\Cashback\BonusAccrual;



use App\Models\Cashback\BonusAccrual\BonusAccrual;
use App\Models\Cashback\Filters\BonusAccrualFilter;

class BonusAccrualEloquentRepository implements BonusAccrualRepositoryContract
{
    private $bonusAccrual;

    public function __construct(BonusAccrual $bonusAccrual)
    {
        $this->bonusAccrual=$bonusAccrual;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->bonusAccrual->select($columns)
            ->with('user','cashback','bonus_accrual_status')
            ->filterBy(new BonusAccrualFilter($data))->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->bonusAccrual->with('user','cashback','bonus_accrual_status')->where('id', $id)->first();
    }
}