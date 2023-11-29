<?php

namespace App\Http\Controllers\Frontend\Api\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\Favorites\StoreFavoriteRequest;
use App\Http\Resources\Frontend\Api\Favorite\FavoriteListResource;
use App\Http\Resources\Frontend\Api\Favorite\FavoriteResource;
use App\Repositories\Frontend\Favorite\FavoriteRepositoryContract;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\Api\Favorites\UpdateFavoriteRequest;

class FavoriteController extends Controller
{
    public $favoriteRepository;

    public function __construct(FavoriteRepositoryContract $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function index()
    {
        $code = 0;
//dd($this->favoriteRepository->paginate());
        $data = FavoriteListResource::collection($this->favoriteRepository->paginate(10));

        return \response()->apiSuccess(compact('code', 'data'));
    }

    public function show($id)
    {
        $code = 0;
        //dd($this->favoriteRepository->getById($id));
        $data = new FavoriteResource($this->favoriteRepository->getById($id));

        return \response()->apiSuccess(compact('code', 'data'));
        
    }
    

    public function store(StoreFavoriteRequest $request)
    {
        $this->favoriteRepository->save($request->validated());
        
        $code = 0;
        $data = ['OK'];
        return \response()->apiSuccess(compact('code', 'data'));
    }


    public function update(UpdateFavoriteRequest $request, $id)
    {
        $this->favoriteRepository->update($id, $request);
        
        $code = 0;
        $data = ['OK'];
        return \response()->apiSuccess(compact('code', 'data'));
    }


    public function destroy($id)
    {
        $this->favoriteRepository->delete($id);

        $code = 0;
        $data = ['OK'];
        return \response()->apiSuccess(compact('code', 'data'));
    }
}
