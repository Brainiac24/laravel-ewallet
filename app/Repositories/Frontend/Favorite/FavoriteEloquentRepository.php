<?php

namespace App\Repositories\Frontend\Favorite;

use App\Events\Frontend\User\UserHistory\UserModifiedEvent;
use App\Exceptions\Frontend\Api\LogicException;
use App\Models\Favorite\Favorite;
use App\Repositories\Frontend\Favorite\FavoriteRepositoryContract;
use App\Repositories\Frontend\Service\ServiceRepositoryContract;
use App\Services\Common\Helpers\Events;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class FavoriteEloquentRepository implements FavoriteRepositoryContract
{

    protected $favorite;
    protected $serviceRepository;

    public function __construct(Favorite $favorite, ServiceRepositoryContract $serviceRepository)
    {
        $this->favorite = $favorite;
        $this->serviceRepository = $serviceRepository;
    }

    public function all($columns = ['*'])
    {
        return $this->favorite->with(['service', 'user'])->get($columns);
    }

    public function paginate($perPage = 10, $columns = ['*'])
    {
        return $this->favorite->with(['service.categories'])->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById($id, $columns = ['*'])
    {
        $favorite = $this->favorite->with(['service.currency'])->where('id', $id)->first();
        if ($favorite == null) {
            throw new LogicException(trans('favorite.errors.not_found'));
        }
        return $favorite;
    }

    public function save($data)
    {
        $favorite = new Favorite();
        $service = $this->serviceRepository->findById($data['service_id']);
        if ($service == null) {
            throw new LogicException(trans('service.errors.code_not_found'));
        }
        $favorite->name = $data['name']??null;
        $favorite->service_id = $service->id;
        $favorite->value = $data['amount'];
        $favorite->params_json = $this->setIsMainParam($data['params'], $service->params_json);

        $favorite->user_id = Auth::user()->id;

        $favorite->save();
        $favorite->setChanges($favorite->getAttributes());
        event(new UserModifiedEvent($favorite, Events::FAVORITE_CREATED));
        return $favorite;

    }

    public function saveFromCreateTransaction($data, $service, $user)
    {
        $favorite = new Favorite();
        $favorite->name = $data['name'];
        $favorite->service_id = $data['service_id'];
        $favorite->value = $data['amount'];
        $favorite->params_json = $this->setIsMainParam($data['params'], $service->params_json);

        $favorite->user_id = $user->id;
        $favorite->save();
        $favorite->setChanges($favorite->getAttributes());
        event(new UserModifiedEvent($favorite, Events::FAVORITE_CREATED));
        return $favorite;

    }

    public function saveFromShowTransaction($data)
    {

    }

    public function update($id, $data)
    {
        $favorite = $this->favorite->where('id', $id)->first();

        if ($favorite == null) {
            throw new LogicException(trans('favorite.errors.not_found'));
        }

        //$favorite = $this->favorite->with(['service.currency'])->where('id', $id)->first();
        /*$service = $this->serviceRepository->findById($data['service_id']);
        if ($service == null) {
        throw new LogicException(trans('service.errors.code_not_found'));
        }*/
        $favorite->name = $data['name'];
        /*$favorite->service_id = $service->id;
        $favorite->value = $data['amount'];
        $favorite->params_json = $this->setIsMainParam($data['params'], $service->params_json);

        $favorite->user_id = Auth::user()->id;*/
        $favorite->setOldAttributes($favorite->getAttributes());
        $favorite->save();
        event(new UserModifiedEvent($favorite, Events::FAVORITE_UPDATED));
        return $favorite;

    }

    public function delete($id)
    {
        $favorite = $this->favorite->find($id);
        if ($favorite == null) {
            throw new LogicException(trans('favorite.errors.not_found'));
        }
        //dd($favorite);
        $favorite->setOldAttributes($favorite->getAttributes());
        $favorite->delete();
        event(new UserModifiedEvent($favorite, Events::FAVORITE_DELETED));
        return $favorite;
    }

    public function setIsMainParam($favorites_params, $service_params)
    {
        foreach ($service_params as $ser_param) {
            foreach ($favorites_params as &$fav_param) {
                if (isset($ser_param['input_name']) && isset($fav_param['key'])) {
                    if ($ser_param['input_name'] == $fav_param['key']) {
                        if (isset($ser_param['is_main'])) {
                            if ($ser_param['is_main'] != 0) {
                                $fav_param['is_main'] = $ser_param['is_main'];
                            }
                        } else {
                            if (isset($fav_param['is_main'])) {
                                unset($fav_param['is_main']);
                            }
                        }
                    }

                }
            }
        }
        return array_values($favorites_params);
    }

}
