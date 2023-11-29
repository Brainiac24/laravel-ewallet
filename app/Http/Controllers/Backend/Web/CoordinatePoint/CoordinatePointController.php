<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\CoordinatePoint;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\CoordinatePoint\IndexCoordinatePointRequest;
use App\Http\Requests\Backend\Web\CoordinatePoint\StoreCoordinatePointRequest;
use App\Http\Requests\Backend\Web\CoordinatePoint\UpdateCoordinatePointRequest;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointCity\CoordinatePointCityRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointType\CoordinatePointTypeRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkdayRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class CoordinatePointController extends Controller
{
    protected $coordinatePointRepository;
    protected $coordinatePointTypeRepository;
    protected $coordinatePointWorkdayRepository;
    protected $merchantRepository;
    protected $coordinatePointCityRepository;

    public function __construct(
        CoordinatePointRepositoryContract $coordinatePointRepository,
        CoordinatePointTypeRepositoryContract $coordinatePointTypeRepository,
        CoordinatePointWorkdayRepositoryContract $coordinatePointWorkdayRepository,
        MerchantRepositoryContract $merchantRepository,
        CoordinatePointCityRepositoryContract $coordinatePointCityRepository
    )
    {
        $this->coordinatePointRepository = $coordinatePointRepository;
        $this->coordinatePointWorkdayRepository = $coordinatePointWorkdayRepository;
        $this->coordinatePointTypeRepository = $coordinatePointTypeRepository;
        $this->merchantRepository = $merchantRepository;
        $this->coordinatePointCityRepository = $coordinatePointCityRepository;
        $this->middleware('coordinatePoint.can-list', ['only' => ['index']]);
        $this->middleware('coordinatePoint.can-show', ['only' => ['show']]);
        $this->middleware('coordinatePoint.can-create', ['only' => ['create','store']]);
        $this->middleware('coordinatePoint.can-edit', ['only' => ['edit','update']]);
        $this->middleware('coordinatePoint.can-delete', ['only' => ['destroy']]);
    }

    public function index(IndexCoordinatePointRequest $request)
    {
        $data=$request->validated();
        $merchants=$this->merchantRepository
            ->all('')
            ->pluck('name','id')
            ->prepend('','');
        $coordinatePointTypes=$this->coordinatePointTypeRepository
            ->all('')
            ->pluck('name','id')
            ->prepend('','');
        $coordinatePointWorkdays=$this->coordinatePointWorkdayRepository
            ->all('')
            ->pluck('name','id')
            ->prepend('','');
        $coordinatePoints = $this->coordinatePointRepository->paginate($data);

        return view('backend.coordinatepoint.index', compact('coordinatePoints','data','merchants','coordinatePointWorkdays','coordinatePointTypes'));
    }

    public function create()
    {
        $merchants=$this->merchantRepository
            ->all('')
            ->pluck('name','id')
            ->prepend('','');
        $coordinatePointTypes=$this->coordinatePointTypeRepository
            ->all('')
            ->pluck('name','id')
            ->prepend('','');
        $coordinatePointWorkdays=$this->coordinatePointWorkdayRepository
            ->all('')
            ->pluck('name','id')
            ->prepend('','');
        $coordinatePointCities=$this->coordinatePointCityRepository
            ->all()
            ->pluck('city.name','id');
        return view('backend.coordinatepoint.create',
            compact('merchants','coordinatePointWorkdays','coordinatePointTypes', 'coordinatePointCities'));
    }

    public function edit($id)
    {
        $merchants=$this->merchantRepository
            ->all('')
            ->pluck('name','id')
            ->prepend('','');
        $coordinatePointTypes=$this->coordinatePointTypeRepository
            ->all('')
            ->pluck('name','id')
            ->prepend('','');
        $coordinatePointWorkdays=$this->coordinatePointWorkdayRepository
            ->all('')
            ->pluck('name','id')
            ->prepend('','');
        $coordinatePointCities=$this->coordinatePointCityRepository
            ->all()
            ->pluck('city.name','id');
        $coordinatePoint = $this->coordinatePointRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.coordinatepoints.edit', $coordinatePoint);
        return view('backend.coordinatepoint.edit',
            compact(
                'coordinatePoint',
                'merchants',
                'coordinatePointWorkdays',
                'coordinatePointTypes',
                'coordinatePointCities'
            ));
    }

    public function show($id)
    {
        $coordinatePoint = $this->coordinatePointRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.coordinatepoints.show', $coordinatePoint);
        return view('backend.coordinatepoint.show', compact('coordinatePoint'));
    }

    public function destroy($id)
    {
        try {
            $coordinatePoint = $this->coordinatePointRepository->destroy($id);
            event(new UserModifiedEvent($coordinatePoint, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.coordinatepoint.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.coordinatepoints.index');
        }
    }

    public function store(StoreCoordinatePointRequest $request)
    {
        $coordinatePoint = $this->coordinatePointRepository->create($request->validated());
        $coordinatePoint->setChanges($coordinatePoint->getAttributes());
        event(new UserModifiedEvent($coordinatePoint, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));

        return redirect()->route('admin.coordinatepoints.index');
    }

    public function update(UpdateCoordinatePointRequest $request, $id)
    {
        $coordinatePoint = $this->coordinatePointRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($coordinatePoint, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));

        return redirect()->route('admin.coordinatepoints.index');
    }
}