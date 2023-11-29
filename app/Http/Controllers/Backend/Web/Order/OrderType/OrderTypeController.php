<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 15:50
 */

namespace App\Http\Controllers\Backend\Web\Order\OrderType;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Order\OrderType\OrderTypeRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class OrderTypeController extends Controller
{
    /**
     * @var OrderTypeRepositoryContract
     */
    private $orderTypeRepositoryContract;

    /**
     * OrderTypeController constructor.
     * @param OrderTypeRepositoryContract $orderTypeRepositoryContract
     */
    public function __construct(OrderTypeRepositoryContract $orderTypeRepositoryContract)
    {
        $this->middleware('order.orderType.can-list', ['only' => ['index']]);
        $this->middleware('order.orderType.can-show', ['only' => ['show']]);
        $this->orderTypeRepositoryContract = $orderTypeRepositoryContract;
    }

    public function Index()
    {
        $data = $this->orderTypeRepositoryContract->getAll('');

        return view('backend.order.orderType.index', compact('data'));
    }

    public function show($id)
    {
        $data= $this->orderTypeRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.order.orderType.show', $data);
        return view('backend.order.orderType.show', compact('data'));
    }
}