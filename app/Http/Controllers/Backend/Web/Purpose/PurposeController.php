<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.08.2019
 * Time: 9:19
 */

namespace App\Http\Controllers\Backend\Web\Purpose;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Purpose\IndexPurposeRequest;
use App\Repositories\Backend\Purpose\PurposeRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class PurposeController extends Controller
{

    /**
     * @var PurposeRepositoryContract
     */
    private $purposeRepositoryContract;

    public function __construct(PurposeRepositoryContract $purposeRepositoryContract)
    {
        $this->middleware('purpose.can-list', ['only' => ['index']]);
        $this->middleware('purpose.can-show', ['only' => ['show']]);
        $this->purposeRepositoryContract = $purposeRepositoryContract;
    }

    public function Index(IndexPurposeRequest $request)
    {
        $data = $request->validated();

        $purposes = $this->purposeRepositoryContract->paginate($data);
        //dd($purposes);
        $purposes->appends($request->validated());
        return view('backend.purpose.index', compact('purposes', 'data'));
    }

    public function show($id)
    {
        $data = $this->purposeRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.purposes.show', $data);
        return view('backend.purpose.show', compact('data'));
    }
}