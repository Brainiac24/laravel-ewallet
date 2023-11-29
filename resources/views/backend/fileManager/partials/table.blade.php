<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" id="main-table">
        <thead class="thead-white">
            <tr>
                <th>{{trans('fileManager.backend.name')}}</th>
                <th>{{trans('fileManager.backend.size')}}</th>
                <th>{{trans('fileManager.backend.modified')}}</th>
                <th>{{trans('fileManager.backend.action')}}</th>
            </tr>
        </thead>
            @if(isset($fileManager->parentUrl))
                <tr>
                    <td class="border-0"><a class="link"  href="{{route('admin.fileManager.index', $fileManager->parentUrl)}}"><i class="fa fa-chevron-circle-left go-back fa-lg"></i> ..</a></td>
                    <td class="border-0"></td>
                    <td class="border-0"></td>
                    <td class="border-0"></td>
                </tr>
            @endif
            @php
                $data=$fileManager->getFileInFolder($fileManager->newPath);
                   foreach ($data['folders'] as $f){
                       $is_link = is_link($fileManager->newPath . '/' . $f);
                       $img = $is_link ? 'icon-link_folder' : 'fa fa-folder-o';
                       $modif_raw = filemtime($path . '/' . $f);
                       $modif = date('d.m.y H:i', $modif_raw);
                       $filesize_raw = 0;
                       $filesize = trans('fileManager.backend.navbar.folder');
            @endphp
        <tr class="content-table">
            <td>
                <div class="filename"><a class="link" href=" {{route('admin.fileManager.index', 'path='.urlencode($fileManager->newPath.'/'.$f))}}"><i class="{{$img}} fa-lg"></i> {{$f}}
                    </a></div>
            </td>
            <td data-sort="a-{{str_pad($filesize_raw, 18, "0", 0)}}">
                {{$filesize}}
            </td>
            <td data-sort="a-{{$modif_raw}}">{{$modif}}</td>
            <td class="inline-actions">
                <a class="link delete-folder"  title="{{trans('actions.general.delete')}}" data-href="{{route('admin.fileManager.delete','path='.urlencode($fileManager->newPath).'&amp;delete='.urlencode($f))}}" data-file="{{$f}}" data-type="folder"> <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
                <a class="link rename-folder" title="{{trans('fileManager.backend.actions.rename')}}" href="#" data-file="{{addslashes($f)}}"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
            </td>
        </tr>
        @php
            }
        @endphp
        @php
                   foreach ($data['files'] as $f){
                       $is_link = is_link($fileManager->newPath . '/' . $f);
                       $img = $is_link ? 'fa fa-file-text-o' : $fileManager->getFileIconClass($fileManager->newPath . '/' . $f);
                       $modif_raw = filemtime($path . '/' . $f);
                       $modif = date('d.m.y H:i', $modif_raw);
                       $filesize_raw = $fileManager->getSize($fileManager->rootPath . '/' . $f);
                       $filesize = $fileManager->getFileSize($filesize_raw);
            @endphp
        <tr class="content-table">
            <td>
                <div class="filename"><i class="{{$img}} fa-lg"></i> {{$f}}{{($is_link ? ' &rarr; <i>' . readlink($fileManager->newPath . '/' . $f) . '</i>' : '')}}</div>
            </td>
            <td data-sort="a-{{str_pad($filesize_raw, 18, "0", 0)}}">
                {{$filesize}}
            </td>
            <td data-sort="a-{{$modif_raw}}">{{$modif}}</td>
            <td class="inline-actions">
                <a class="link delete-folder"  title="{{trans('actions.general.delete')}}" data-href="{{route('admin.fileManager.delete','path='.urlencode($fileManager->newPath).'&amp;delete='.urlencode($f))}}" data-file="{{$f}}" data-type="file"> <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
                <a class="link rename-folder" title="{{trans('fileManager.backend.actions.rename')}}" href="#" data-file="{{addslashes($f)}}"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                <a class="link" title="{{trans('fileManager.backend.actions.download')}}" href="{{route('admin.fileManager.download','path='.urlencode($fileManager->newPath).'&amp;download='.urlencode($f))}}"><i class="fa fa-download fa-lg"></i></a>
            </td>
        </tr>
        @php
            }
        @endphp
    </table>
</div>
<div class="modal fade" id="deleteFolder" tabindex="-1" role="dialog" aria-label="newItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Нет</button>
                    <a class="link-btn-success" href=""><button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i> Да</button></a>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="renameFolder" tabindex="-1" role="dialog" aria-label="newItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Переименовать</h4>
            </div>
            <div class="modal-body">
                Новая название : <input type='text' name='rename' required id='rename' class='form-control' ><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> {{trans('actions.general.cancel')}}</button>
                <a class="link-rename-btn-success" href="#"><button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i> {{trans('actions.general.save')}}</button></a>
            </div>
        </div>
    </div>
</div>
@section('page_js')
<script>
    var pickedup;
    $( ".content-table" ).on( "click", function( event ) {
        if (!$(this).hasClass("selected-row")){
            $( this ).addClass( "selected-row" );
            if (pickedup != null) {
                pickedup.removeClass( "selected-row" );
            }
            pickedup = $( this );
        }else {
            console.log('remove');
            $( this ).removeClass( "selected-row" );
            pickedup=null;
        }
    });
    $('.delete-folder').click(function () {
        var modal =$('#deleteFolder');
        var href= $(this).data('href');
        var type=$(this).data('type');
        var file=$(this).data('file');
        $(modal).find('.link-btn-success').attr('href', href);
        if (type=='file'){
            $(modal).find('.modal-title').text('Удалить Файл');
            $(modal).find('.modal-body').html("Вы действительно хотите удалить этот файл? <br> <b>"+file+"</b>");
        }
        else {
            $(modal).find('.modal-title').text('Удалить Папку');
            $(modal).find('.modal-body').html("Вы действительно хотите удалить эту папку? <br> <b>"+file+"</b>");
        }
        $(modal).modal({
            show: 'true'
        });
    });
    $('.rename-folder').click(function () {
        var modal =$('#renameFolder');
        var file=$(this).data('file');
        var href= '{{route('admin.fileManager.rename', 'path='.urlencode($fileManager->newPath))}}' +"&rename=" + encodeURIComponent(file) + "&to=";
        $(modal).find('#rename').val(file);
        $(modal).find('.link-rename-btn-success').data('href', href);
        $(modal).find('.link-rename-btn-success').data('file', file);
        $(modal).modal({
            show: 'true'
        });
    });
    $('.link-rename-btn-success').click(function () {
        var newFile=$('#rename').val();
        var oldFile=$(this).data('file');
        var href=$(this).data('href');
        if (newFile!=oldFile && newFile != null && newFile != ''  && newFile!=undefined){
            $(this).attr('href', href+encodeURIComponent(newFile));
        }
    })
</script>
@endsection
