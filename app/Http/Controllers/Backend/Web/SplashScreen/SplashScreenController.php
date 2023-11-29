<?php


namespace App\Http\Controllers\Backend\Web\SplashScreen;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\SplashScreen\StoreSplashScreenRequest;
use App\Repositories\Backend\SplashScreen\SplashScreenEloquentRepository;
use App\Services\Common\Helpers\Events;

class SplashScreenController extends Controller
{
    protected $screenEloquentRepository;

    public function __construct(SplashScreenEloquentRepository $screenEloquentRepository)
    {
        $this->screenEloquentRepository=$screenEloquentRepository;
        $this->middleware('splashScreen.can-show', ['only' => ['index']]);
        $this->middleware('splashScreen.can-create', ['only' => ['store']]);

    }

    public function index()
    {
        $splashScreens=$this->screenEloquentRepository->listAll();
        $splashScreen=$this->screenEloquentRepository->getOneSplashScreen();
        return view('backend.splashScreen.index',compact('splashScreen', 'splashScreens'));
    }

    public function store(StoreSplashScreenRequest $request)
    {
        $data = $request->validated();
        try {
            if ($request->has('icon_file') && !empty($request->icon_file)) {
                $image = $request->file('icon_file');
                $data['icon']=$this->screenEloquentRepository->saveImage($image);
            }

            if(empty($data['icon']))
            {
                session()->flash('flash_message_error', "Не задано иконка");
                return redirect()->route('admin.splashScreens.index');
            }

            $model = $this->screenEloquentRepository->updateValue($data['icon']);
            event(new UserModifiedEvent($model, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->route('admin.splashScreens.index');
        }catch (\Exception $e) {
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.splashScreens.index');
        }
    }
}