<?php

namespace App\Http\Controllers\Backend\Web\Order\OrderCardContractType;

use App\Http\Requests\Backend\Web\Order\OrderCardContractType\StoreOrderCardContractTypeRequest;
use App\Models\OrderCardContractType\OrderCardContractType;
use App\Repositories\Backend\OrderCardContractType\OrderCardContractTypeRepositoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderCardContractTypeController extends Controller
{
    private $cardContractTypeRepository;

    public function __construct(OrderCardContractTypeRepositoryContract $cardContractTypeRepositoryContract)
    {
        $this->cardContractTypeRepository = $cardContractTypeRepositoryContract;
        $this->middleware('orderCardType.can-list', ['only' => ['index']]);
        $this->middleware('orderCardType.can-create', ['only' => ['create', 'store']]);
        $this->middleware('orderCardType.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('orderCardType.can-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderCardContractTypes = $this->cardContractTypeRepository->all();

        return view('backend.order.orderCardContractType.index',compact('orderCardContractTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.order.orderCardContractType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderCardContractTypeRequest $request)
    {
        $formFields = $request->validated();
        $this->cardContractTypeRepository->create($formFields);

        return redirect()->route('admin.order.cardContractType.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderCardContractType\OrderCardContractType  $orderCardContractType
     * @return \Illuminate\Http\Response
     */
    public function show(OrderCardContractType $orderCardContractType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderCardContractType\OrderCardContractType  $orderCardContractType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderCardContractType = $this->cardContractTypeRepository->findById($id);
        return view('backend.order.orderCardContractType.edit',compact('orderCardContractType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderCardContractType\OrderCardContractType  $orderCardContractType
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrderCardContractTypeRequest $request, $id)
    {
        $formFields = $request->validated();
        $this->cardContractTypeRepository->update($formFields, $id);

        return redirect()->route('admin.order.cardContractType.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderCardContractType\OrderCardContractType  $orderCardContractType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cardContractTypeRepository->disable($id);

        return redirect()->route('admin.order.cardContractType.index');
    }
}
