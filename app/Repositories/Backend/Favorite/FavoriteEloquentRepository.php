<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Favorite;


use App\Models\Account\Scopes\OwnUserIdScope;
use App\Models\Favorite\Favorite;
use App\Models\User\Filters\FavoriteFilter;

class FavoriteEloquentRepository implements FavoriteRepositoryContract
{
    protected $favorite;

    public function __construct(Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $favorite = $this->favorite->get($columns);
        return $favorite;
    }

    public function paginate($data=[],$perPage = 30, $columns = ['*'])
    {
        //dd(123);
        return $this->favorite->select($columns)->filterBy(new FavoriteFilter($data))->with('user', 'service')->orderBy('created_at', 'desc')->withoutGlobalScope(OwnUserIdScope::class)->withTrashed()->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->favorite->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        return $this->favorite->create($data);
    }

    public function findById($id, $columns = ['*'])
    {

        return $this->favorite->select($columns)->withoutGlobalScopes()->with('service','user')->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $favorite = $this->favorite->withoutGlobalScopes()->findOrFail($id);
        $favorite->setOldAttributes($favorite->getAttributes());
        $favorite->update($data);
        return $favorite;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $favorite = $this->favorite->withoutGlobalScopes()->findOrFail($id);
        $favorite->setOldAttributes($favorite->getAttributes());
        $favorite->delete();
        return $favorite;
    }

    public function restore($id)
    {
        $favorite = $this->favorite->withoutGlobalScopes()->findOrFail($id);
        $favorite->setOldAttributes($favorite->getAttributes());
        $favorite->restore();
        return $favorite;
    }
}