<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Service\Category;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Service\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Web\Service\Category\UpdateCategoryRequest;
use App\Repositories\Backend\Service\Category\CategoryRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->middleware('service.category.can-list', ['only' => ['index']]);
        $this->middleware('service.category.can-show', ['only' => ['show']]);
        $this->middleware('service.category.can-create', ['only' => ['create','store']]);
        $this->middleware('service.category.can-edit', ['only' => ['edit','update']]);
        $this->middleware('service.category.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data=[];
        $categoryRepository = $this->categoryRepository->allWithoutRelations();
        $category = $this->buildTree($categoryRepository->toArray(),"parent_id","id");

       return view('backend.service.category.index', compact('category','data'));
    }

    public function create()
    {
        $categoryList = $this->categoryRepository->all()->pluck('name','id');
        return view('backend.service.category.create',compact('categoryList'));
    }

    public function edit($id)
    {
        $categoryRepository = $this->categoryRepository->findById($id);
        $categoryList = $this->categoryRepository->all()->pluck('name','id');

        Breadcrumbs::setCurrentRoute('admin.categories.edit', $categoryRepository);
        return view('backend.service.category.edit', compact('categoryRepository','categoryList'));
    }

    public function show($id)
    {
        $categoryRepository = $this->categoryRepository->findById($id);
        $categoryList = $this->categoryRepository->findById($categoryRepository->id);

        Breadcrumbs::setCurrentRoute('admin.categories.show', $categoryRepository);
        return view('backend.service.category.show', compact('categoryRepository','categoryList'));
    }

    public function destroy($id)
    {
        try{
            $category = $this->categoryRepository->destroy($id);
            event(new UserModifiedEvent($category, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.categories.index');
        }catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.categories.index');
        }

    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->validated());
        $category->setChanges($category->getAttributes());
        event(new UserModifiedEvent($category, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.categories.index');
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        if($request->parent_id=='ae44b5fc-8c31-11e9-9c0b-b06ebfbfa715')
        {
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->back();
        }
        else
        {
            $category = $this->categoryRepository->update($request->validated(), $id);
            event(new UserModifiedEvent($category, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->route('admin.categories.index');
        }
    }

    function buildTree($flat, $pidKey, $idKey = null)
    {
        $arrlength = count($flat);
        for($x = 0; $x < $arrlength; $x++) {
            $flat[$x]['is_active2']=trans('InterfaceTranses.status.'.$flat[$x]['is_active']);
            $flat[$x]['is_enabled2']=trans('InterfaceTranses.enabled.'.$flat[$x]['is_enabled']);
            $flat[$x]['is_searchable']=trans('InterfaceTranses.status.'.$flat[$x]['is_searchable']);
        }

        $grouped = array();
        foreach ($flat as $sub){
            $grouped[$sub[$pidKey]][] = $sub;

        }
        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if(isset($grouped[$id])) {
                    $sibling['w2ui']['children'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;

            }

            return $siblings;
        };
        $tree = $fnBuilder($grouped['00000000-0000-0000-0000-000000000000']);


        return $tree;
    }

}