<?php


namespace App\Services\Common\Helpers;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FileManager
{
    public $rootPath;
    public $urlPath='';
    public $parentUrl=null;
    public $newPath='';
    public $isFileExistsStorage=false;
    public function __construct()
    {
        $this->newPath=request()->get('path')??null;
        $this->setRootPath($this->newPath);
        $this->isFileExistsStorage=$this->fileExistsStorage($this->newPath);
        if (!$this->isFileExistsStorage){
            $this->newPath='';
        }
    }

    function getLocalPath(){
        if (!\File::isDirectory(storage_path('customer_files'))){
            $this->mkdir(storage_path('customer_files'), false);
        }
        return storage_path('customer_files');
    }

    public function cleanPath($path, $trim = true)
    {
        $path = $trim ? trim($path) : $path;
        $path = trim($path, '\\/');
        $path = str_replace(array('../', '..\\'), '', $path);
        $path = $this->getAbsolutePath($path);
        if ($path == '..') {
            $path = '';
        }
        return str_replace('\\', '/', $path);
    }

    public function getAbsolutePath($path)
    {
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutes = array();
        foreach ($parts as $part) {
            if ('.' == $part) continue;
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        return implode(DIRECTORY_SEPARATOR, $absolutes);
    }

    public function getFileInFolder($path){
        $path=$this->getLocalPath().'/'.$path;
        $objects = is_readable($path) ? scandir($path) : array();
        $data=[
            'files'=>[],
            'folders'=>[],
        ];
        $folders = array();
        $files = array();
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                if (substr($file, 0, 1) === '.') {
                    continue;
                }
                $new_path = $path . '/' . $file;
                if (@is_file($new_path)) {
                    $data['files'][] = $file;
                } elseif (@is_dir($new_path) && $file != '.' && $file != '..') {
                     $data['folders'][] = $file;
                }
            }
        }
        return $data;
    }

    public function fileExistsStorage($path)
    {
        return \File::isDirectory($this->getLocalPath().'/'.$path);
    }

    public function setRootPath($path)
    {
        if ($this->fileExistsStorage($path)){
            $this->rootPath=$this->getLocalPath().'/'.$path;
        }else{
            $this->rootPath=$this->getLocalPath();
        }
    }

    public function setParentUrl($path)
    {
        $urls=explode('/',$path);
        if (count($urls)>1){
            unset($urls[count($urls)-1]);
            $this->parentUrl='path='. urlencode(implode('/',$urls));
        }elseif (count($urls)==1 && isset($urls[0]) && $urls[0]!=''){
            $this->parentUrl='path=';
        }
    }

    public function setUrlPath($path)
    {
        $this->urlPath='path='.urlencode($path);
    }

    /**
     * Get CSS classname for file
     * @param string $path
     * @return string
     */
    public function getFileIconClass($path)
    {
        // get extension
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        switch ($ext) {
            case 'ico':
            case 'gif':
            case 'jpg':
            case 'jpeg':
            case 'jpc':
            case 'jp2':
            case 'jpx':
            case 'xbm':
            case 'wbmp':
            case 'png':
            case 'bmp':
            case 'tif':
            case 'tiff':
            case 'svg':
                $img = 'fa fa-picture-o';
                break;
            case 'passwd':
            case 'ftpquota':
            case 'sql':
            case 'js':
            case 'json':
            case 'sh':
            case 'config':
            case 'twig':
            case 'tpl':
            case 'md':
            case 'gitignore':
            case 'c':
            case 'cpp':
            case 'cs':
            case 'py':
            case 'map':
            case 'lock':
            case 'dtd':
                $img = 'fa fa-file-code-o';
                break;
            case 'txt':
            case 'ini':
            case 'conf':
            case 'log':
            case 'htaccess':
                $img = 'fa fa-file-text-o';
                break;
            case 'css':
            case 'less':
            case 'sass':
            case 'scss':
                $img = 'fa fa-css3';
                break;
            case 'zip':
            case 'rar':
            case 'gz':
            case 'tar':
            case '7z':
                $img = 'fa fa-file-archive-o';
                break;
            case 'php':
            case 'php4':
            case 'php5':
            case 'phps':
            case 'phtml':
                $img = 'fa fa-code';
                break;
            case 'htm':
            case 'html':
            case 'shtml':
            case 'xhtml':
                $img = 'fa fa-html5';
                break;
            case 'xml':
            case 'xsl':
                $img = 'fa fa-file-excel-o';
                break;
            case 'wav':
            case 'mp3':
            case 'mp2':
            case 'm4a':
            case 'aac':
            case 'ogg':
            case 'oga':
            case 'wma':
            case 'mka':
            case 'flac':
            case 'ac3':
            case 'tds':
                $img = 'fa fa-music';
                break;
            case 'm3u':
            case 'm3u8':
            case 'pls':
            case 'cue':
                $img = 'fa fa-headphones';
                break;
            case 'avi':
            case 'mpg':
            case 'mpeg':
            case 'mp4':
            case 'm4v':
            case 'flv':
            case 'f4v':
            case 'ogm':
            case 'ogv':
            case 'mov':
            case 'mkv':
            case '3gp':
            case 'asf':
            case 'wmv':
                $img = 'fa fa-file-video-o';
                break;
            case 'eml':
            case 'msg':
                $img = 'fa fa-envelope-o';
                break;
            case 'xls':
            case 'xlsx':
            case 'ods':
                $img = 'fa fa-file-excel-o';
                break;
            case 'csv':
                $img = 'fa fa-file-text-o';
                break;
            case 'bak':
                $img = 'fa fa-clipboard';
                break;
            case 'doc':
            case 'docx':
            case 'odt':
                $img = 'fa fa-file-word-o';
                break;
            case 'ppt':
            case 'pptx':
                $img = 'fa fa-file-powerpoint-o';
                break;
            case 'ttf':
            case 'ttc':
            case 'otf':
            case 'woff':
            case 'woff2':
            case 'eot':
            case 'fon':
                $img = 'fa fa-font';
                break;
            case 'pdf':
                $img = 'fa fa-file-pdf-o';
                break;
            case 'psd':
            case 'ai':
            case 'eps':
            case 'fla':
            case 'swf':
                $img = 'fa fa-file-image-o';
                break;
            case 'exe':
            case 'msi':
                $img = 'fa fa-file-o';
                break;
            case 'bat':
                $img = 'fa fa-terminal';
                break;
            default:
                $img = 'fa fa-info-circle';
        }

        return $img;
    }

    public function getSize($path)
    {
        return \File::size($path);
    }
    public function getFileSize($size)
    {
        $size = (float) $size;
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return sprintf('%s %s', round($size / pow(1024, $power), 2), $units[$power]);
    }

    /**
     * Delete  file or folder (recursively)
     * @param string $path
     * @return bool
     */
    public function rdelete($path)
    {
        if (is_link($path)) {
            return unlink($path);
        } elseif (is_dir($path)) {
            $objects = scandir($path);
            $ok = true;
            if (is_array($objects)) {
                foreach ($objects as $file) {
                    if ($file != '.' && $file != '..') {
                        if (!$this->rdelete($path . '/' . $file)) {
                            $ok = false;
                        }
                    }
                }
            }
            return ($ok) ? rmdir($path) : false;
        } elseif (is_file($path)) {
            return unlink($path);
        }
        return false;
    }

    public function isvalidFilename($text) {
        return (strpbrk($text, '/?%*:|"<>') === FALSE) ? true : false;
    }

    public function mkdir($dir, $force)
    {
        if (file_exists($dir)) {
            if (is_dir($dir)) {
                return $dir;
            } elseif (!$force) {
                return false;
            }
            unlink($dir);
        }
        return mkdir($dir, 0777, true);
    }

    /**
     * Check the file extension which is allowed or not
     * @param string $filename
     * @return bool
     */
    public function isValidExt($filename)
    {
        $allowed = [];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $isFileAllowed = ($allowed) ? in_array($ext, $allowed) : true;

        return ($isFileAllowed) ? true : false;
    }

    /**
     * Safely rename
     * @param string $old
     * @param string $new
     * @return bool|null
     */
    public function rename($old, $new)
    {
        $isFileAllowed = $this->isValidExt($new);

        if(!$isFileAllowed) return false;

        return (!file_exists($new) && file_exists($old)) ? rename($old, $new) : null;
    }
}