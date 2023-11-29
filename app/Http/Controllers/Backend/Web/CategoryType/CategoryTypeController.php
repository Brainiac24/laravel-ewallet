<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.07.2019
 * Time: 17:53
 */

namespace App\Http\Controllers\Backend\Web\CategoryType;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\CategoryType\IndexCategoryTypeRequest;
use App\Repositories\Backend\CategoryType\CategoryTypeRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class CategoryTypeController extends Controller
{
    /**
     * @var CategoryTypeRepositoryContract
     */
    private $categoryTypeRepositoryContract;

    public function __construct(CategoryTypeRepositoryContract $categoryTypeRepositoryContract)
    {

        $this->categoryTypeRepositoryContract = $categoryTypeRepositoryContract;
        $this->middleware('categoryType.can-manage');
    }

    public function index(IndexCategoryTypeRequest $request)
    {
        $data = $request->validated();
        $categoryTypes = $this->categoryTypeRepositoryContract->paginate($data);
        return view('backend.categoryType.index', compact('categoryTypes', 'data'));
    }
}