<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.07.2019
 * Time: 16:10
 */

namespace App\Repositories\Backend\Color;


use App\Models\Color\Color;

class ColorEloquentRepository implements ColorRepositoryContract
{

    /**
     * @var Color
     */
    private $color;

    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function all($search)
    {
        return $this->color->where('code', 'like', '%' . $search . '%')->orderBy('code')->get();
    }

    public function findById($id)
    {
        return $this->color->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $color = $this->color->findOrFail($id);
        $color->setOldAttributes($color->getAttributes());
        $color->update($data);
        return $color;
    }

    public function create(array $data)
    {
        return $this->color->create($data);
    }

    public function destroy($id)
    {
        $color = $this->color->findOrFail($id);
        $color->is_active = 0;
        $color->save();
        return $color;
    }
}