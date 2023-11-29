<?php


namespace App\Repositories\Backend\Cashback\CashbackType;



use App\Models\Cashback\CashbackType\CashbackType;

class CashbackTypeEloquentRepository implements CashbackTypeRepositoryContract
{
    private $cashbackType;

    public function __construct(CashbackType $cashbackType)
    {
        $this->cashbackType=$cashbackType;
    }

    public function getAll($search)
    {
        return $this->cashbackType->where('name', 'like', '%'.$search.'%')->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this->cashbackType->where('id', $id)->first();
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->cashbackType->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function update(array $data, $id)
    {
        $cashbackType=$this->cashbackType->findOrFail($id);
        $cashbackType->setOldAttributes($cashbackType->getAttributes());
        $cashbackType->update($data);
        return $cashbackType;
    }

    public function create(array $data)
    {
        return $this->cashbackType->create($data);
    }

    public function destroy($id)
    {
        $cashbackType=$this->cashbackType->findOrFail($id);
        $cashbackType->is_active=0;
        $cashbackType->save();
        return $cashbackType;
    }
}