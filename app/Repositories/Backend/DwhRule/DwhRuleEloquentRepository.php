<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 25.08.2021
 * Time: 22:41
 */

namespace App\Repositories\Backend\DwhRule;


use App\Models\DwhRule\DwhRule;
use App\Models\DwhRule\Filters\DwhRuleFilter;

class DwhRuleEloquentRepository implements DwhRuleRepositoryContract
{
    /**
     * @var DwhRule $dwhRule
     */
    private $dwhRule;

    public function __construct(DwhRule $dwhRule)
    {
        $this->dwhRule = $dwhRule;
    }

    public function all($data)
    {
       return $this->dwhRule->orderBy('table')->filterBy(new DwhRuleFilter($data))->get();
    }

    public function paginate($data, $perPage = 60)
    {
        return $this->dwhRule->orderBy('table')->filterBy(new DwhRuleFilter($data))->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->dwhRule::findOrFail($id);
    }

    public function getAllByTable($table)
    {
        return $this->dwhRule::where('table', $table)->get();
    }

    public function destroy($id)
    {
        $gateway = $this->dwhRule->findOrFail($id);
        $gateway->setOldAttributes($gateway->getAttributes());
        $gateway->delete();

        return $gateway;
    }

    public function create(array $dwhRule){
        return $this->dwhRule::create($dwhRule);
    }

    public function update(array $data, $id)
    {
        $dwhRule = $this->dwhRule::findOrFail($id);
        $dwhRule->setOldAttributes($dwhRule->getAttributes());
        $dwhRule->update($data);

        return $dwhRule;
    }
    
    

}