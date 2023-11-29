<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 10:39
 */

namespace App\Http\Controllers\Backend\Web\Order\OrderStatus;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Order\OrderStatus\OrderStatusRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class OrderStatusController extends Controller
{
    /**
     * @var OrderStatusRepositoryContract
     */
    private $orderStatusRepositoryContract;

    public function __construct(OrderStatusRepositoryContract $orderStatusRepositoryContract)
    {
        $this->middleware('order.orderStatus.can-list', ['only' => ['index']]);
        $this->middleware('order.orderStatus.can-show', ['only' => ['show']]);
        $this->orderStatusRepositoryContract = $orderStatusRepositoryContract;
    }

    public function Index()
    {
        $data = $this->orderStatusRepositoryContract->getAll('');

        return view('backend.order.orderStatus.index', compact('data'));
    }

    public function show($id)
    {
        $data= $this->orderStatusRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.order.orderStatus.show', $data);
        return view('backend.order.orderStatus.show', compact('data'));
    }
}