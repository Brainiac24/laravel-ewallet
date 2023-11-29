<?php


namespace App\Repositories\Backend\Cashback\BonusAccrual\BonusAccrualStatus;



use App\Models\Cashback\BonusAccrual\BonusAccrualStatus\BonusAccrualStatus;

class BonusAccrualStatusEloquentRepository implements BonusAccrualStatusRepositoryContract
{
    private $bonusAccrualStatus;

    public function __construct(BonusAccrualStatus $bonusAccrualStatus)
    {
        $this->bonusAccrualStatus=$bonusAccrualStatus;
    }

    public function getAll($search)
    {
        return $this->bonusAccrualStatus->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this->bonusAccrualStatus->where('id', $id)->first();
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->bonusAccrualStatus->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function update(array $data, $id)
    {
        $bonusAccrualStatus = $this->bonusAccrualStatus->findOrFail($id);
        $bonusAccrualStatus->setOldAttributes($bonusAccrualStatus->getAttributes());
        $bonusAccrualStatus->update($data);
        return $bonusAccrualStatus;
    }

    public function create(array $data)
    {
        return $this->bonusAccrualStatus->create($data);
    }

    public function destroy($id)
    {
        $bonusAccrualStatus = $this->bonusAccrualStatus->findOrFail($id);
        $bonusAccrualStatus->is_active = 0;
        $bonusAccrualStatus->save();
        return $bonusAccrualStatus;
    }
}