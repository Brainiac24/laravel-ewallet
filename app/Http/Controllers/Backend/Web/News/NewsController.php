<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 9:57
 */

namespace App\Http\Controllers\Backend\Web\News;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\News\DeleteImageNewsRequest;
use App\Http\Requests\Backend\Web\News\IndexNewsRequest;
use App\Http\Requests\Backend\Web\News\StoreNewsRequest;
use App\Http\Requests\Backend\Web\News\UpdateNewsRequest;
use App\Notifications\FcmToTopicNotification;
use App\Repositories\Backend\News\NewsRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Services\Backend\Web\Notification\NotificationServiceContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Image\ImageServiceContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Ramsey\Uuid\Uuid;

class NewsController extends Controller
{
    /**
     * @var NewsRepositoryContract
     */
    private $newsRepository;
    /**
     * @var ImageServiceContract
     */
    private $imageService;
    /**
     * @var NotificationServiceContract
     */
    private $notificationService;
    /**
     * @var UserRepositoryContract
     */
    private $userRepository;

    public function __construct(NewsRepositoryContract $newsRepository,
                                ImageServiceContract $imageService,
                                NotificationServiceContract $notificationService,
                                UserRepositoryContract $userRepository)
    {

        $this->newsRepository = $newsRepository;

        $this->middleware('news.can-list', ['only' => ['index']]);
        $this->middleware('news.can-show', ['only' => ['show']]);
        $this->middleware('news.can-create', ['only' => ['create', 'store']]);
        $this->middleware('news.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('news.can-delete', ['only' => ['destroy']]);
        $this->imageService = $imageService;
        $this->notificationService= $notificationService;
        $this->userRepository= $userRepository;
    }

    public function index(IndexNewsRequest $request)
    {
        $data = $request->validated();
        $news = $this->newsRepository->paginate($data);
        $news->appends($request->validated());
        return view('backend.news.index', compact('news', 'data'));
    }

    public function show($id)
    {
        //
        $news = $this->newsRepository->findById($id);

        Breadcrumbs::setCurrentRoute('admin.news.show', $news);
        return view('backend.news.show', compact('news'));
    }

    public function create()
    {
        //
        $news = $this->newsRepository->all('')->pluck('title', 'id');
        return view('backend.news.create', compact('news'));
    }

    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();

        if(!isset($data['position']))
            $data['position']=0;

        if ($request->has('image_name')) {

            $image = $request->file('image_name');
            $folder = public_path(str_replace('/',DIRECTORY_SEPARATOR,'imgs/news/'));
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
            $name = Uuid::uuid4(). '_' . $timestamp;
            $nameBig = $name. '_big.jpg';
            //$nameMin = $name. '_min.jpg';

//            $this->imageService->saveWithParam($folder.'1',$image,296,176,$nameMin);
            $this->imageService->saveWithParam($folder.'1',$image,328,200,$nameBig);

//            $this->imageService->saveWithParam($folder.'2',$image,592,352, $nameMin);
            $this->imageService->saveWithParam($folder.'2',$image,656,400, $nameBig);

//            $this->imageService->saveWithParam($folder.'3',$image,888,528, $nameMin);
            $this->imageService->saveWithParam($folder.'3',$image,984,600, $nameBig);

//            $this->imageService->saveWithParam($folder.'hdpi',$image,444,264, $nameMin);
            $this->imageService->saveWithParam($folder.'hdpi',$image,492,300, $nameBig);

//            $this->imageService->saveWithParam($folder.'ldpi',$image,222,132, $nameMin);
            $this->imageService->saveWithParam($folder.'ldpi',$image,246,150, $nameBig);

//            $this->imageService->saveWithParam($folder.'mdpi',$image,296,176, $nameMin);
            $this->imageService->saveWithParam($folder.'mdpi',$image,328,200, $nameBig);

//            $this->imageService->saveWithParam($folder.'xhdpi',$image,592,352, $nameMin);
            $this->imageService->saveWithParam($folder.'xhdpi',$image,656,400, $nameBig);

//            $this->imageService->saveWithParam($folder.'xxhdpi',$image,888,528, $nameMin);
            $this->imageService->saveWithParam($folder.'xxhdpi',$image,984,600, $nameBig);

//            $this->imageService->saveWithParam($folder.'xxxhdpi',$image,1184,704, $nameMin);
            $this->imageService->saveWithParam($folder.'xxxhdpi',$image,1312,800, $nameBig);

            $data['image_name'] = $name;
        }

        $news = $this->newsRepository->create($data);
        $news->setChanges($news->getAttributes());

        if($data['is_push_notification']=='1')
        {
            $title =$data['title'];
            $short_description =$data['short_description'];

            //Отключили, из-за хранение одинаковых информации и в вкладке уведомление и в вкладке новости.
            //После создание новости пользователь получить push с ссылкой на вкладку новостей
            //$user_id =\Auth::user()->id;
            //$this->notificationService->save($user_id, $title, $short_description);

            $with_topic = 'news';

            if (\App::environment('local'))
                $with_topic = 'news_test';

            \Auth::user()->notify(new FcmToTopicNotification($title, $short_description, $with_topic));
        }

        event(new UserModifiedEvent($news, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.news.index');
    }

    public function edit($id)
    {
        $news = $this->newsRepository->findById($id);

        //dd($news);
        Breadcrumbs::setCurrentRoute('admin.news.edit', $news);
        return view('backend.news.edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, $id)
    {
        //
        $data = $request->validated();

        if ($request->has('image_name')) {
            $folder = public_path(str_replace('/',DIRECTORY_SEPARATOR,'imgs/news/'));

            $old_name = $this->newsRepository->findById($id)->image_name;
            $nameBig = $old_name. '_big.jpg';
            $nameMin = $old_name. '_min.jpg';

            $this->imageService->delete($folder.'1', $nameMin);
            $this->imageService->delete($folder.'1', $nameBig);

            $this->imageService->delete($folder.'2', $nameMin);
            $this->imageService->delete($folder.'2', $nameBig);

            $this->imageService->delete($folder.'3', $nameMin);
            $this->imageService->delete($folder.'3', $nameBig);

            $this->imageService->delete($folder.'hdpi', $nameMin);
            $this->imageService->delete($folder.'hdpi', $nameBig);

            $this->imageService->delete($folder.'ldpi', $nameMin);
            $this->imageService->delete($folder.'ldpi', $nameBig);

            $this->imageService->delete($folder.'mdpi', $nameMin);
            $this->imageService->delete($folder.'mdpi', $nameBig);

            $this->imageService->delete($folder.'xhdpi', $nameMin);
            $this->imageService->delete($folder.'xhdpi', $nameBig);

            $this->imageService->delete($folder.'xxhdpi', $nameMin);
            $this->imageService->delete($folder.'xxhdpi', $nameBig);

            $this->imageService->delete($folder.'xxxhdpi', $nameMin);
            $this->imageService->delete($folder.'xxxhdpi', $nameBig);

            $image = $request->file('image_name');
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
            $name = Uuid::uuid4(). '_' . $timestamp;
            $nameBig = $name. '_big.jpg';
            $nameMin = $name. '_min.jpg';

//            $this->imageService->saveWithParam($folder.'1',$image,296,176,$nameMin);
            $this->imageService->saveWithParam($folder.'1',$image,328,200,$nameBig);

//            $this->imageService->saveWithParam($folder.'2',$image,592,352, $nameMin);
            $this->imageService->saveWithParam($folder.'2',$image,656,400, $nameBig);

//            $this->imageService->saveWithParam($folder.'3',$image,888,528, $nameMin);
            $this->imageService->saveWithParam($folder.'3',$image,984,600, $nameBig);

//            $this->imageService->saveWithParam($folder.'hdpi',$image,444,264, $nameMin);
            $this->imageService->saveWithParam($folder.'hdpi',$image,492,300, $nameBig);

//            $this->imageService->saveWithParam($folder.'ldpi',$image,222,132, $nameMin);
            $this->imageService->saveWithParam($folder.'ldpi',$image,246,150, $nameBig);

//            $this->imageService->saveWithParam($folder.'mdpi',$image,296,176, $nameMin);
            $this->imageService->saveWithParam($folder.'mdpi',$image,328,200, $nameBig);

//            $this->imageService->saveWithParam($folder.'xhdpi',$image,592,352, $nameMin);
            $this->imageService->saveWithParam($folder.'xhdpi',$image,656,400, $nameBig);

//            $this->imageService->saveWithParam($folder.'xxhdpi',$image,888,528, $nameMin);
            $this->imageService->saveWithParam($folder.'xxhdpi',$image,984,600, $nameBig);

//            $this->imageService->saveWithParam($folder.'xxxhdpi',$image,1184,704, $nameMin);
            $this->imageService->saveWithParam($folder.'xxxhdpi',$image,1312,800, $nameBig);

            $data['image_name'] = $name;
        }

        $news = $this->newsRepository->update($data, $id);

        if($data['is_push_notification']=='1')
        {
            $title =$data['title'];
            $short_description =$data['short_description'];

            //Отключили, из-за хранение одинаковых информации и в вкладке уведомление и в вкладке новости.
            //После создание новости пользователь получить push с ссылкой на вкладку новостей
            //$user_id =\Auth::user()->id;
            //$this->notificationService->save($user_id, $title, $short_description);

            $with_topic = 'news';

            if (\App::environment('local'))
                $with_topic = 'news_test';

            \Auth::user()->notify(new FcmToTopicNotification($title, $short_description, $with_topic));
        }

        event(new UserModifiedEvent($news, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.news.index');
    }

    public function destroy($id)
    {
        //
        try {
            $news = $this->newsRepository->destroy($id);
            event(new UserModifiedEvent($news, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.news.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.news.index');
        }
    }

    public function deleteImage($id)
    {
        try {
            $image_name = $this->newsRepository->findById($id)->image_name;

            $folder = public_path(str_replace('/',DIRECTORY_SEPARATOR,'imgs/news/'));
            $nameBig = $image_name. '_big.jpg';
            $nameMin = $image_name. '_min.jpg';

            $this->imageService->delete($folder.'1', $nameMin);
            $this->imageService->delete($folder.'1', $nameBig);

            $this->imageService->delete($folder.'2', $nameMin);
            $this->imageService->delete($folder.'2', $nameBig);

            $this->imageService->delete($folder.'3', $nameMin);
            $this->imageService->delete($folder.'3', $nameBig);

            $this->imageService->delete($folder.'hdpi', $nameMin);
            $this->imageService->delete($folder.'hdpi', $nameBig);

            $this->imageService->delete($folder.'ldpi', $nameMin);
            $this->imageService->delete($folder.'ldpi', $nameBig);

            $this->imageService->delete($folder.'mdpi', $nameMin);
            $this->imageService->delete($folder.'mdpi', $nameBig);

            $this->imageService->delete($folder.'xhdpi', $nameMin);
            $this->imageService->delete($folder.'xhdpi', $nameBig);

            $this->imageService->delete($folder.'xxhdpi', $nameMin);
            $this->imageService->delete($folder.'xxhdpi', $nameBig);

            $this->imageService->delete($folder.'xxxhdpi', $nameMin);
            $this->imageService->delete($folder.'xxxhdpi', $nameBig);

            $news = $this->newsRepository->deleteImage($id);

            event(new UserModifiedEvent($news, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.news.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.news.edit', $id);
        }
    }
}