<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 10:07
 */

namespace App\Repositories\Backend\News;


use App\Models\News\Filters\NewsFilter;
use App\Models\News\News;

class NewsEloquentRepository implements NewsRepositoryContract
{

    /**
     * @var News
     */
    private $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }


    public function all($search)
    {
        return $this->news->where('title', 'like', '%' . $search . '%')->orderBy('title')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->news->select($columns)->filterBy(new NewsFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->news->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $news = $this->news->findOrFail($id);
        $news->setOldAttributes($news->getAttributes());
        $news->update($data);
        return $news;
    }

    public function destroy($id)
    {
        $news = $this->news->findOrFail($id);
        $news->is_active = 0;
        $news->save();
        return $news;
    }

    public function create(array $data)
    {

        return $this->news->create($data);
    }

    public function deleteImage($id)
    {
        $news = $this->findById($id);
        $news->image_name = null;
        $news->save();
        return $news;
    }
}