<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31.07.2019
 * Time: 14:00
 */

namespace App\Http\Controllers\Backend\Web\DocumentType;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\DocumentType\StoreDocumentTypeRequest;
use App\Http\Requests\Backend\Web\DocumentType\UpdateDocumentTypeRequest;
use App\Repositories\Backend\User\DocumentType\DocumentTypeRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class DocumentTypeController extends Controller
{
    /**
     * @var DocumentTypeContract
     */
    private $documentTypeContract;

    public function __construct(DocumentTypeRepositoryContract $documentTypeContract)
    {
        $this->documentTypeContract = $documentTypeContract;

        $this->middleware('documentType.can-list', ['only' => ['index']]);
        $this->middleware('documentType.can-show', ['only' => ['show']]);
        $this->middleware('documentType.can-create', ['only' => ['create', 'store']]);
        $this->middleware('documentType.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('documentType.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $documentTypes = $this->documentTypeContract->getAll('');
        return view('backend.documentType.index', compact('documentTypes'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = $this->documentTypeContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.documentTypes.show', $data);
        return view('backend.documentType.show', compact('data'));
    }

    public function edit($id)
    {
        $data = $this->documentTypeContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.documentTypes.edit', $data);
        return view('backend.documentType.edit', compact('data'));
    }

    public function update(UpdateDocumentTypeRequest $request, $id)
    {
        //
        $data = $this->documentTypeContract->update($request->validated(), $id);

        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.documentTypes.index');
    }

    public function create()
    {
        $data = $this->documentTypeContract->getAll('')->pluck('name','id');
        return view('backend.documentType.create',compact('data'));
    }

    public function store(StoreDocumentTypeRequest $request)
    {
        $data = $this->documentTypeContract->create($request->validated());
        $data->setChanges($data->getAttributes());
        event(new UserModifiedEvent($data, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.documentTypes.index');
    }

    public function destroy($id)
    {
        try {
            $data = $this->documentTypeContract->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.documentTypes.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.documentTypes.index');
        }
    }
}