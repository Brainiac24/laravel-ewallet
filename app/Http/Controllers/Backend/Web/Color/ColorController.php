<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.07.2019
 * Time: 16:05
 */

namespace App\Http\Controllers\Backend\Web\Color;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Color\StoreColorRequest;
use App\Http\Requests\Backend\Web\Color\UpdateColorRequest;
use App\Repositories\Backend\Color\ColorRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class ColorController extends Controller
{
    /**
     * @var ColorRepositoryContract
     */
    private $colorRepositoryContract;

    public function __construct(ColorRepositoryContract $colorRepositoryContract)
    {
        $this->colorRepositoryContract = $colorRepositoryContract;
        $this->middleware('colors.can-manage');
    }

    public function index()
    {
        $colors = $this->colorRepositoryContract->all('');
        return view('backend.color.index', compact('colors'));
    }

    public function create()
    {
        //
        $color = $this->colorRepositoryContract->all('')->pluck('name','id');
        return view('backend.color.create',compact('color'));
    }

    public function store(StoreColorRequest $request)
    {
        //
        $color = $this->colorRepositoryContract->create($request->validated());
        $color->setChanges($color->getAttributes());
        event(new UserModifiedEvent($color, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.colors.index');
    }

    public function show($id)
    {
        $color = $this->colorRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.colors.show', $color);
        return view('backend.color.show', compact('color'));
    }

    public function edit($id)
    {
        $color = $this->colorRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.colors.edit', $color);
        return view('backend.color.edit', compact('color'));
    }

    public function update(UpdateColorRequest $request, $id)
    {
        //
        $color = $this->colorRepositoryContract->update($request->validated(), $id);

        event(new UserModifiedEvent($color, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.colors.index');
    }

    public function destroy($id)
    {
        //
        try {
            $color = $this->colorRepositoryContract->destroy($id);
            event(new UserModifiedEvent($color, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.colors.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.colors.index');
        }
    }
}