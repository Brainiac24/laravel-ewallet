<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.08.2019
 * Time: 9:46
 */

namespace App\Repositories\Backend\Purpose;


use App\Models\Purpose\Filters\PurposeFilter;
use App\Models\Purpose\Purpose;

class PurposeEloquentRepository implements PurposeRepositoryContract
{

    /**
     * @var Purpose
     */
    private $purpose;

    public function __construct(Purpose $purpose)
    {

        $this->purpose = $purpose;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->purpose->with('purpose_type')->select($columns)->filterBy(new PurposeFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->purpose->with('purpose_type')->where('id', $id)->first();
    }
}