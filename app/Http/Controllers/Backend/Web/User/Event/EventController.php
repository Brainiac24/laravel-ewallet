<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 13:42
 */

namespace App\Http\Controllers\Backend\Web\User\Event;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Event\IndexEventRequest;
use App\Repositories\Backend\User\Event\EventRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class EventController extends Controller
{
    /**
     * @var EventRepositoryContract
     */
    private $eventRepositoryContract;

    public function __construct(EventRepositoryContract $eventRepositoryContract)
        {
            $this->eventRepositoryContract = $eventRepositoryContract;
            $this->middleware('events.can-manage');
        }

    public function index(IndexEventRequest $request)
    {
        $data = $request->validated();
        $events = $this->eventRepositoryContract->paginate($data);
        $events->appends($request->validated());
        return view('backend.user.event.index', compact('events', 'data'));
    }

    public function show($id)
    {
        //
        $data = $this->eventRepositoryContract->getById($id);

        Breadcrumbs::setCurrentRoute('admin.users.events.show', $data);
        return view('backend.user.event.show', compact('data'));
    }
}