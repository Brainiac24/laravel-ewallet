<?php


namespace App\Http\Controllers\Backend\Web\FileManager;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\FileManager\StoreFileMangerRequest;
use App\Services\Common\Helpers\FileManager;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    private $fileManager;

    public function __construct()
    {
        $this->fileManager=new FileManager();
        $this->middleware('FileManager.can-list', ['only' => ['index']]);
        $this->middleware('FileManager.can-delete', ['only' => ['delete']]);
        $this->middleware('FileManager.can-store', ['only' => ['mkFolder','upload']]);
        $this->middleware('FileManager.can-download', ['only' => ['download']]);
        $this->middleware('FileManager.can-edit', ['only' => ['rename']]);
    }
    public function index(Request $request)
    {
        $fileManager=$this->fileManager;
        if (!$fileManager->isFileExistsStorage){
            return redirect()->route('admin.fileManager.index');
        }
        $fileManager->setRootPath($fileManager->newPath);
        $fileManager->setParentUrl($fileManager->newPath);
        $fileManager->setUrlPath($fileManager->newPath);
        $path=$this->fileManager->rootPath;
        return view('backend.fileManager.index', compact('fileManager','path'));
    }

    public function download(Request $request)
    {
        $fileManager=$this->fileManager;
        if (!$fileManager->isFileExistsStorage){
            return redirect()->route('admin.fileManager.index');
        }
        $download = $request->get('download');
        $download = $fileManager->cleanPath($download);
        $download = str_replace('/', '', $download);
        $fileManager->setRootPath($fileManager->newPath);
        $fileManager->setUrlPath($fileManager->newPath);
        if ($download != '' && is_file($fileManager->rootPath . '/' . $download)) {
            return \response()->download($fileManager->rootPath . '/' . $download);
        } else {
            session()->flash('flash_message_error', 'Файл не найден');
        }
        return redirect()->route('admin.fileManager.index', $fileManager->urlPath);
    }

    public function mkFolder(Request $request)
    {
        $fileManager=$this->fileManager;
        if (!$fileManager->isFileExistsStorage){
            return redirect()->route('admin.fileManager.index');
        }
        $type=$request->get('type');
        $new=$request->get('new');
        $fileManager->setUrlPath($fileManager->newPath);
        $new = str_replace( '/', '', $fileManager->cleanPath( strip_tags( $new ) ) );
        if ($fileManager->isvalidFilename($new) && $new != '' && $new != '..' && $new != '.') {
            $fileManager->setRootPath($fileManager->newPath);
            if ($type == "file") {
                if (!file_exists($fileManager->rootPath . '/' . $new)) {
                    if($fileManager->isvalidFilename($new)) {
                        @fopen($fileManager->rootPath . '/' . $new, 'w') or die('Cannot open file:  ' . $new);
                        session()->flash('flash_message', sprintf('Файл %s создан',$new));
                    } else {
                        session()->flash('flash_message_error', 'Расширение файла не разрешено');
                    }
                } else {
                    session()->flash('flash_message', sprintf('Файл %s уже существует',$new));
                }
            } else {
                if ($fileManager->mkdir($fileManager->rootPath . '/' . $new, false) === true) {
                    session()->flash('flash_message', sprintf('Папка %s создан',$new));
                } elseif ($fileManager->mkdir($fileManager->rootPath  . '/' . $new, false) === $fileManager->rootPath . '/' . $new) {
                    session()->flash('flash_message', sprintf('Папка %s уже существует',$new));
                } else {
                    session()->flash('flash_message_error', sprintf('Папка %s не создан',$new));
                }
            }
        } else {
            session()->flash('flash_message_error', 'Недействительные символы в имени файла или папки');
        }
        return redirect()->route('admin.fileManager.index', $fileManager->urlPath);

    }

    public function delete(Request $request)
    {
        $fileManager=$this->fileManager;
        $delete=$request->get('delete');
        $fileManager->setUrlPath($fileManager->newPath);
        if (!$fileManager->isFileExistsStorage && empty($delete) && $delete==null){
            return redirect()->route('admin.fileManager.index', $fileManager->urlPath);
        }

        $del = str_replace( '/', '', $fileManager->cleanPath( $delete ) );
        if ($del != '' && $del != '..' && $del != '.') {
            $fileManager->setRootPath($fileManager->newPath);
            $is_dir = is_dir($fileManager->rootPath . '/' . $del);
            if ($fileManager->rdelete($fileManager->rootPath . '/' . $del)) {
                $msg = $is_dir ? 'Папка %s удалено' : 'Файл %s удалено';
                session()->flash('flash_message', sprintf($msg, $del));
            } else {
                $msg = $is_dir ? 'Папка %s невозможно удалить' : 'Файл %s невозможно удалить';
            }
        } else {
            session()->flash('flash_message_error', 'Неверное имя файла или папки');
        }
        return redirect()->route('admin.fileManager.index', $fileManager->urlPath);
    }

    public function rename(Request $request)
    {
        $fileManager=$this->fileManager;
        $old=$request->get('rename')??'';
        $old=str_replace('/', '', $fileManager->cleanPath($old));
        $new=$request->get('to')??'';
        $new=str_replace('/', '', $fileManager->cleanPath($new));
        if (!$fileManager->isFileExistsStorage){
            return redirect()->route('admin.fileManager.index');
        }
        $fileManager->setRootPath($fileManager->newPath);
        // rename
        if ($fileManager->isvalidFilename($new) && $old != '' && $new != '') {
            if ($fileManager->rename($fileManager->rootPath . '/' . $old, $fileManager->rootPath . '/' . $new)) {
                session()->flash('flash_message',sprintf('Переименован из %s к %s', $old, $new));
            } else {
                session()->flash('flash_message_error',sprintf('Ошибка при переименовании из %s к %s', $old, $new));
            }
        } else {
            session()->flash('flash_message_error', 'Недействительные символы в имени файла');
        }
        $fileManager->setUrlPath($fileManager->newPath);
        return redirect()->route('admin.fileManager.index',$fileManager->urlPath);
    }

    public function upload(StoreFileMangerRequest $request)
    {
        $fileManager=$this->fileManager;
        if (!$fileManager->isFileExistsStorage){
            return redirect()->route('admin.fileManager.index');
        }
        $request->validated();
        $fileManager->setRootPath($fileManager->newPath);
        $fileManager->setUrlPath($fileManager->newPath);
        $file = $request->file('upload');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $fileName.'_'.microtime().'.'.$extension;
        $file->move($fileManager->rootPath, $fileName);
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.fileManager.index', $fileManager->urlPath);

    }
}