<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 31.08.2021
 * Time: 16:27
 */

namespace App\Http\Controllers\Backend\Web\DwhRule;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\DwhRule\IndexDwhRuleRequest;
use App\Http\Requests\Backend\Web\DwhRule\StoreDwhRuleRequest;
use App\Http\Requests\Backend\Web\DwhRule\UpdateDwhRuleRequest;
use App\Repositories\Backend\DwhRule\DwhRuleRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class DwhRuleController extends Controller
{

    protected $dwhRuleRepository;

    public function __construct(DwhRuleRepositoryContract $dwhRuleRepository)
    {
        $this->dwhRuleRepository = $dwhRuleRepository;
        $this->middleware('dwhRule.can-list', ['only' => ['index']]);
        $this->middleware('dwhRule.can-show', ['only' => ['show']]);
        $this->middleware('dwhRule.can-create', ['only' => ['create', 'store']]);
        $this->middleware('dwhRule.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('dwhRule.can-delete', ['only' => ['destroy']]);
    }

    public function index(IndexDwhRuleRequest $request)
    {
        $data = $request->validated();
        $dwhRules = $this->dwhRuleRepository->paginate($data);

        return view('backend.dwhRule.index', compact('dwhRules', 'data'));
    }

    public function create()
    {
        return view('backend.dwhRule.create');
    }

    public function edit($id)
    {
        $dwhRule = $this->dwhRuleRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.DwhRule.edit', $dwhRule);

        return view('backend.dwhRule.edit', compact('dwhRule'));
    }

    public function show($id)
    {
        $dwhRule = $this->dwhRuleRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.DwhRule.show', $dwhRule);

        return view('backend.dwhRule.show', compact('dwhRule'));
    }
    public function destroy($id)
    {
        try {
            $dwhRule = $this->dwhRuleRepository->destroy($id);
            event(new UserModifiedEvent($dwhRule, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));

            return redirect()->route('admin.DwhRule.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));

            return redirect()->route('admin.DwhRule.index');
        }
    }
    public function store(StoreDwhRuleRequest $request)
    {
        $dwhRule = $this->dwhRuleRepository->create($request->validated());
        $dwhRule->setChanges($dwhRule->getAttributes());
        event(new UserModifiedEvent($dwhRule, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));

        return redirect()->route('admin.DwhRule.index');
    }

    public function update(UpdateDwhRuleRequest $request, $id)
    {
        $dwhRule = $this->dwhRuleRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($dwhRule, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));

        return redirect()->route('admin.DwhRule.index');
    }
}