<div class="row box-header with-border">
        @php $path = $fileManager->cleanPath($fileManager->newPath);
            $rootUrl = "<a class='link' href='".route('admin.fileManager.index')."'><i class='fa fa-home fa-lg' aria-hidden='true'></i></a>";
            $sep = '<i class="bread-crumb"> / </i>';
        @endphp
        @if($path != '')
            @php
                $exploded = explode('/', $path);
                $linkPaths=array();
                $parentLink='';
                foreach($exploded as $item)
                {
                    $parentLink=trim($parentLink.'/'.$item,'/');
                    $linkPaths[] = "<a class='link' href='".route('admin.fileManager.index','path='.urlencode($parentLink))."'>".htmlspecialchars($item, ENT_QUOTES, 'UTF-8')."</a>";
                }
                $rootUrl.=$sep.implode($sep,$linkPaths);
            @endphp
        @endif
            <div class="col-xs-12 col-sm-12 box-header with-border">
                {!! $rootUrl !!}
                <a title="{{trans('fileManager.backend.navbar.newItem')}}" class="newItem link pull-right" href="#createNewItem" data-toggle="modal" data-target="#createNewItem"><i class="fa fa-plus-square fa-lg"></i> {{trans('fileManager.backend.navbar.newItem')}}</a>
                <a title="{{trans('fileManager.backend.navbar.upload')}}" class="upload link pull-right" data-toggle="modal" data-target="#upload"><i class="fa fa-cloud-upload fa-lg" aria-hidden="true"></i> {{trans('fileManager.backend.navbar.upload')}} </a>

            </div>
    </div>

<!-- New Item creation -->
<div class="modal fade" id="createNewItem" tabindex="-1" role="dialog" aria-label="newItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" id="newItemModalLabel"><i class="fa fa-plus-square fa-fw"></i>{{trans('actions.general.create').' '. trans('fileManager.backend.navbar.newItem')}}</h5>
            </div>
            <div class="modal-body">
                <p><label for="newfile">{{trans('fileManager.backend.navbar.itemType')}}</label></p>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="newfile" value="file" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">{{trans('fileManager.backend.navbar.file')}}</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="newfile" value="folder" class="custom-control-input" checked="">
                    <label class="custom-control-label" for="customRadioInline2">{{trans('fileManager.backend.navbar.folder')}}</label>
                </div>

                <p class="mt-3"><label for="newfilename">{{trans('fileManager.backend.navbar.itemName')}}</label></p>
                <input type="text" name="newfilename" id="newfilename" value="" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> {{trans('actions.general.cancel')}}</button>
                <button type="button" class="btn btn-success" onclick="newfolder('{{$fileManager->urlPath}}');return false;"><i class="fa fa-check-circle"></i> {{trans('actions.general.create')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-label="newItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('actions.general.create').' файл'}}</h4>
            </div>
            <form method='post' action='{{route('admin.fileManager.upload','path='.urlencode($fileManager->newPath))}}' enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    Выбрать файл : <input type='file' name='upload' required id='file' class='form-control' ><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> {{trans('actions.general.cancel')}}</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> {{trans('actions.general.create')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function newfolder(e) {
        var t = document.getElementById("newfilename").value, n = document.querySelector('input[name="newfile"]:checked').value;
        null !== t && "" !== t && n && (window.location.hash = "#", window.location ='{{route('admin.fileManager.mkFolder', 'path='.urlencode($fileManager->newPath))}}' + "&new=" + encodeURIComponent(t) + "&type=" + encodeURIComponent(n))
    }
</script>