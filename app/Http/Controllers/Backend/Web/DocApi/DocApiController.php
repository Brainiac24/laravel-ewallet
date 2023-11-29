<?php

namespace App\Http\Controllers\Backend\Web\DocApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocApiCategory\DocApiCategory;
use App\Models\DocApi\DocApi;

class DocApiController extends Controller
{
    
    protected $docApiCategory;
    protected $docApi;

    public function __construct(DocApiCategory $docApiCategory, DocApi $docApi)
    {
        $this->docApiCategory = $docApiCategory;
        $this->docApi = $docApi;
        $this->middleware('docapi.can-list', ['only' => ['index']]);
    }

    public function index()
    {
        $apiCategories = $this->docApiCategory->with(['apis' => function ($query) {
            $query->orderBy('group', 'asc')->orderBy('version', 'asc');
        }])->orderBy('name')->get();
        //dd($apiCategories);

        return view('backend.docApis.index', compact('apiCategories'));
    }

    public function loadApi($url)
    {
        $data = $this->docApi->where('url_path', $url)->first();
        //dd($apiCategories);

        return response()->apiSuccess('data');
    }


}
