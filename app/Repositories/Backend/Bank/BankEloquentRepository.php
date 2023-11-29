<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:40
 */

namespace App\Repositories\Backend\Bank;


use App\Models\Bank\Bank;
use App\Models\Bank\Filters\BankFilter;
use Illuminate\Support\Facades\DB;

class BankEloquentRepository implements BankRepositoryContract
{
    /**
     * @var Bank
     */
    private $bank;

    /**
     * BankEloquentRepository constructor.
     * @param Bank $bank
     */
    public function __construct(Bank $bank)
    {
        $this->bank = $bank;
    }

    public function getIdByName($name)
    {
        return $this->bank->where('name', $name)->first();
    }

    public function getIdByCodeMap($codeMap)
    {
        return $this->bank->where('code_map', $codeMap)->first();
    }

    public function all($search)
    {
        return $this->bank->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->bank->select($columns)->filterBy(new BankFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);

    }

    public function getById($id)
    {
        return $this->bank->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $banks = $this->bank->findOrFail($id);
        $banks->setOldAttributes($banks->getAttributes());
        $banks->update($data);
        return $banks;
    }

    public function destroy($id)
    {
        $banks = $this->bank->findOrFail($id);
        $banks->is_active = 0;
        $banks->save();
        return $banks;
    }

    public function create(array $data)
    {
        return $this->bank->create($data);
    }

    /**
     * Get max value for Position add +1
     * @return int
     */
    public function getMaxPosition()
    {
         return $this->bank->max('position') + 1;
    }
}