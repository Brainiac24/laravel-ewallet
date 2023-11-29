<?php

namespace App\Http\Controllers\Backend\Web\Order\OrderComment ;

use Breadcrumbs;
use App\Http\Controllers\Controller;
use App\Services\Common\Helpers\Events;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Repositories\Backend\Order\OrderType\OrderTypeRepositoryContract;
use App\Http\Requests\Backend\Web\Order\OrderComment\IndexOrderCommentRequest;
use App\Http\Requests\Backend\Web\Order\OrderComment\StoreOrderCommentRequest;
use App\Http\Requests\Backend\Web\Order\OrderComment\UpdateOrderCommentRequest;
use App\Repositories\Backend\Order\OrderComment\OrderCommentRepositoryContract;

class OrderCommentController extends Controller
{
   
    private $orderCommentRepositoryContract;
    private $orderTypeRepositoryContract;

    public function __construct(OrderCommentRepositoryContract $orderCommentRepositoryContract,
                                OrderTypeRepositoryContract $orderTypeRepositoryContract)
    {
        $this->orderCommentRepositoryContract = $orderCommentRepositoryContract;
        $this->orderTypeRepositoryContract = $orderTypeRepositoryContract;

        $this->middleware('orderComment.can-list', ['only' => ['index']]);
        $this->middleware('orderComment.can-show', ['only' => ['show']]);
        $this->middleware('orderComment.can-create', ['only' => ['create', 'store']]);
        $this->middleware('orderComment.can-edit', ['only' => ['edit', 'update']]);

    }

    public function index()
    {
        $orderComments = $this->orderCommentRepositoryContract->paginate();
        return view('backend.order.orderComment.index', compact('orderComments'));
    }

    public function show($id)
    {
        $data  = $this->orderCommentRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.order.orderComment.show', $data );
        return view('backend.order.orderComment.show', compact('data'));
    }

    public function create()
    {
        $orderTypes = $this->orderTypeRepositoryContract->listAll();
        return view('backend.order.orderComment.create',compact('orderTypes'));
    }

    public function store(StoreOrderCommentRequest $request)
    {
        $orderComment = $this->orderCommentRepositoryContract->create($request->validated());
        $orderComment->setChanges($orderComment->getAttributes());
        event(new UserModifiedEvent($orderComment, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.order.orderComment.index');
    }

    public function edit($id)
    {
        $data = $this->orderCommentRepositoryContract->findById($id);
        $orderTypes = $this->orderTypeRepositoryContract->listAll();
        Breadcrumbs::setCurrentRoute('admin.order.orderComment.edit', $data);
        return view('backend.order.orderComment.edit', compact('data','orderTypes'));
    }

    public function update(UpdateOrderCommentRequest $request, $id)
    {
        $data = $this->orderCommentRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.order.orderComment.index');
    }
}
