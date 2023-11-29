<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 15:40
 */

namespace App\Repositories\Backend\TransferList;


use App\Models\TransferList\TransferList;

class TransferListEloquentRepository implements TransferListRepositoryContract
{

    /**
     * @var TransferList
     */
    private $transferList;

    public function __construct(TransferList $transferList)
    {
        $this->transferList = $transferList;
    }

    public function all($data=[],$columns = ['*'])
    {
        $transferLists = $this->transferList->orderBy('created_at', 'desc')->get($columns);
        return $transferLists;
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->transferList->select($columns)->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->transferList->create($data);
    }

    public function update(array $data, $id)
    {
        $transferList = $this->transferList->findOrFail($id);
        $transferList->setOldAttributes($transferList->getAttributes());
        $transferList->update($data);
        return $transferList;
    }

    public function destroy($id)
    {
        $transferList = $this->transferList->findOrFail($id);
        $transferList->is_active = 0;
        $transferList->save();
        return $transferList;
    }
}