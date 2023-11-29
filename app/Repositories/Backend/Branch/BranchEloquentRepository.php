<?php
/**
 * Created by PhpStorm.
 * User: D_Mamadjonov
 * Date: 14.07.202020
 * Time: 12:00
 */

namespace App\Repositories\Backend\Branch;

use App\Models\Branch\Branch;

class BranchEloquentRepository implements BranchRepositoryContract
{
    /**
     * @var Branch
     */
    private $branch;

    /**
     * BranchEloquentRepository constructor.
     * @param Branch $branchs
     */
    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }

    public function all($search)
    {
        return $this->branch->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->branch->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);

    }

    public function getById($id)
    {
        return $this->branch->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $branchs = $this->branch->findOrFail($id);
        $branchs->setOldAttributes($branchs->getAttributes());
        $branchs->update($data);
        return $branchs;
    }

    public function destroy($id)
    {
        $branch = $this->branch->findOrFail($id);
        $branch->is_active = 0;
        $branch->save();
        return $branch;
    }

    public function create(array $data)
    {
        return $this->branch->create($data);
    }

    public function listsAll()
    {
        return $this->branch->orderBy('name')->get()->pluck('name', 'id');
    }

    public function listsByIds($ids)
    {
        return $this->branch->whereIn("id", $ids)->orderBy('name')->get()->pluck('name', 'id');
    }
}