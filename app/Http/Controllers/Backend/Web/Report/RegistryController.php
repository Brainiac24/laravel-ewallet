<?php

namespace App\Http\Controllers\Backend\Web\Report;

use App\Http\Controllers\Controller;

class RegistryController extends Controller
{
    /**
     * RegistryController constructor.
     */
    public function __construct()
    {
        $this->middleware('registry.can-manage', ['only' => ['index']]);
    }

    public function index()
    {
//        $files =array_filter( \Storage::disk('report')->files(), function ($item){
//            return strpos($item, 'xlsx');
//        });

        $files = \Storage::disk('report')->files();

        $newFiles = [];
        foreach ($files as $file) {
            if (!strpos($file, '.xlsx')) {
                unset($file);
                continue;
            }

            $link = null;
            $last_modified = null;
            $public_path = public_path() . DIRECTORY_SEPARATOR . 'reports' . DIRECTORY_SEPARATOR . $file;
            $storage_path = storage_path() . DIRECTORY_SEPARATOR . 'reports' . DIRECTORY_SEPARATOR . $file;
            $timestamp = filemtime($storage_path);

            if (\File::exists($public_path)) {
                $last_modified = date("d-m-Y H:i:s", filemtime($public_path));

                $link = asset('reports/' . $file);
            }
//                $link = asset('reports/' . $file);

            $newFiles[] = [
                'file' => $file,
                'link' => $link,
                'last_modified' => $last_modified,
                'timestamp' => $timestamp,
            ];
        }

        usort($newFiles, function ($a, $b) {
            return $b['timestamp'] - $a['timestamp'];
        });

        return view('backend.reports.registries.index')->with('files', $newFiles);

    }
}
