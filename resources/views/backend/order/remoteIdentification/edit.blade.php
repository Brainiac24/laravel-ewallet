@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('remoteIdentification.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.error')
    @include('backend.errors.success')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($data , ['method' => 'patch','class'=>'form-horizontal','id'=>'form-remote-identification','autocomplete'=>'off']) !!}
            @include('backend.order.remoteIdentification.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!! Form::submit("Отменить заявку", ['class' => 'btn btn-danger '.($rejecttable == true?'':'hidden-disabled-btn').'','form'=>'form-category',"id"=>"btn-reject",  "disabled" => $rejecttable == true ? null : true]) !!}
            @if (config("app_settings.remote_indentification_requred_check_nalog") == true)
                {!! Form::submit("Принять заявку", ['class' => 'btn btn-success '.($accepttable == true?'':'hidden-disabled-btn').'','form'=>'form-category',"id"=>"btn-accept-check-nalog", "disabled" => $accepttable == true ? null : true]) !!}
            @else
                {!! Form::submit("Принять заявку", ['class' => 'btn btn-success '.($accepttable == true?'':'hidden-disabled-btn').'','form'=>'form-category',"id"=>"btn-accept", "disabled" => $accepttable == true ? null : true]) !!}
            @endif
            {!! Form::submit("Поиск клиента", ['class' => 'btn btn-light '.($searchable == true?'':'hidden-disabled-btn').'','form'=>'form-category',"id"=>"btn-search",  "disabled" => $searchable == true ? null : true]) !!}
            {!! Form::submit(trans('Сохранить анкету'), ['class' => 'btn btn-primary '.($updatable == true?'':'hidden-disabled-btn').'','form'=>'form-category',"id"=>"btn-update", "disabled" => $updatable == true ? null : true]) !!}
            {!! Form::submit("Проверить на дубликаты", ['class' => 'btn btn-light','form'=>'form-category',"id"=>"btn-search-pre-processing"]) !!}
            @if($registerable)
                <a class="btn btn-primary" href="{!! route("admin.remoteIdentification.register",["id" => $data->id]) !!}">Повторная регистрация клиента в АБС</a>
            @endif
            <span class="message"></span>
        </div><!-- box-footer -->
    </div><!-- /.box -->
    @include('backend.order.remoteIdentification.partials.modals')
    @include('backend.order.remoteIdentification.partials.edit_history')
@stop

@section('page_js')
    @include('backend.order.remoteIdentification.scripts.edit')
    <script src="{{asset('js/jquery.ez-plus.js')}}"></script>
    <script>

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
        $("#additional-photo-zoom-image").ezPlus({
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
                            // return alert($(this).html() + " \nCannot eval JSON: " + error);
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