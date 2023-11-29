<?php

namespace App\Http\Controllers\Backend\Web\Error;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        return response()->view('backend.errors.403', [], 403);
    }
}
