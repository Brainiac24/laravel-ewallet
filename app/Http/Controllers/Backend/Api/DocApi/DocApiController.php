<?php

namespace App\Http\Controllers\Backend\Api\DocApi;

use App\Http\Controllers\Controller;
use App\Models\DocApi\DocApi;
use App\Models\DocApiCategory\DocApiCategory;
use Illuminate\Http\Request;

class DocApiController extends Controller
{
    protected $docApiCategory;
    protected $docApi;

    public function __construct(DocApiCategory $docApiCategory, DocApi $docApi)
    {
        $this->docApiCategory = $docApiCategory;
        $this->docApi = $docApi;
    }

    public function loadApi(Request $request)
    {
        //dd($request->url);
        $data = $this->docApi->where('url_path', $request->url)->first()['response_success_json'];
        
        //dd($data);
        return response()->json($data);
    }
}
