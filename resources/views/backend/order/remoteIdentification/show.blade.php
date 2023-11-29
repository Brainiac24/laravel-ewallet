@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('remoteIdentification.backend.title') }}</h1>
@stop

@section('content')

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($data , ['class'=>'form-horizontal','id'=>'form-remote-identification']) !!}
            @include('backend.order.remoteIdentification.partials.show_fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            <span class="message"></span>
        </div><!-- box-footer -->
    </div><!-- /.box -->
    @include('backend.order.remoteIdentification.partials.modals')
    @include('backend.order.remoteIdentification.partials.edit_history')
@stop

@section('page_js')
    <script src="{{asset('js/jquery.ez-plus.js')}}"></script>
    <script>
        $(".new-window-img").click(function (e) {
            e.preventDefault();
            if ($('.photoviewer-modal').length==0) {
                var thisImg = {
                    src: $(this).attr('href'),
                    title: $(this).attr('data-title')
                };

                var items = [],
                    options = {
                        index: $(this).index(),
                        headerToolbar: [
                            'minimize',
                            'maximize',
                            'close'
                        ],
                        footerToolbar: [
                            'prev',
                            'next',
                            'zoomIn',
                            'zoomOut',
                            'fullscreen',
                            'actualSize',
                            'rotateLeft',
                            'rotateRight',
                        ],
                        modalWidth: 120,
                        modalHeight: 120,
                        callbacks: {
                            beforeChange: function (context, index) {
                                console.log(context, index)
                            },
                            changed: function (context, index) {
                                console.log(context, index)
                            }
                        }
                    };

                items.push(thisImg);

                $('.new-window-img').each(function () {
                    if (thisImg.src != $(this).attr('href')) {
                        items.push({
                            src: $(this).attr('href'),
                            title: $(this).attr('data-title')
                        });
                    }
                });

                new PhotoViewer(items, options);
            }
        });

        $("#front-photo-zoom-image").ezPlus({
            tint: true,
            scrollZoom: true,
            zoomWindowPosition: 10,
            tintColour: '#F90', tintOpacity: 0.1
        });
        $("#back-photo-zoom-image").ezPlus({
            tint: true,
            scrollZoom: true,
            zoomWindowPosition: 10,
            tintColour: '#F90', tintOpacity: 0.1
        });
        $("#selfie-photo-zoom-image").ezPlus({
            tint: true,
            scrollZoom: true,
            zoomWindowPosition: 10,
            tintColour: '#F90', tintOpacity: 0.1
        });
        $("#remote_identification_history").click(function () {
            var call_comment=$("#call_comment").val();
            var history_comment=$("#history_comment").val();
            $.ajax({
                dataType: "json",
                type: "post",
                url: '{{route('admin.remoteIdentification.updateHistory', $data->id)}}',
                data: {'call_comment' : call_comment, 'history_comment' : history_comment, '_token': '{{csrf_token()}}'},
                success: function (response) {
                    $("#json_history_call").text(JSON.stringify(response));
                    var options = {
                        collapsed: true,
                        withQuotes: false
                    };
                    $('.json-params').each(function () {
                        try {
                            if ($(this).html() != null) {
                                var input = eval('(' + $(this).html() + ')');
                                $(this).jsonViewer(input, options);
                            }
                        }  catch (error) {
                            console.log(error);
                        }
                    });
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    </script>
@stop

<style>
    .btn.hidden-disabled-btn:disabled{
        display: none;
    }

    .box-footer .message{
        margin-left: 18px;
        color: #ff0707;
        font-weight: bold;
        font-size: 10px;
    }

    img {
        max-width: none !important;
        max-height: none !important;
    }

    .imgscaleX_1 {
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }

</style>