@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('serviceOtpLimits.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.service.serviceOtpLimits.partials.search_box')
    <script src="{{asset('vendor/grid/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/grid/w2ui.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/grid/w2ui.min.css')}}"/>
    <div class="box box-solid">
        <style>
            .myPaddingClass {
                padding: 6px 12px;
            }
            .form-group {
                margin-bottom: 15px !important;
            }
            .control-label {
                padding-right: 15px !important;
            }
        </style>
        <div id="grid" style="width: 100%; min-height: 700px; max-height: 1000px; height: 100%;"></div>
    </div><!-- /.box -->
    <script type="text/javascript">
        var currentUrl = 0 ;
        jQuery(function ($) {
            console.log(document.getElementsByTagName('template')[0]);
            $('#grid').w2grid({
                name: 'grid',
                multiSelect: false,
                reorderColumns: true,
                show: {
                    toolbar: true,
                    toolbarReload: false,
                    footer: true,
                    toolbarAdd: false,
                    toolbarDelete: false,
                    toolbarSearch: true,
                    toolbarInput: true,
                    toolbarEdit: false,
                },
                toolbar: {
                    onClick: function (event) {
                        if (event.target == 'append')   window.open('{{url()->current()}}' + "/create", "_self");
                        if (event.target == 'show')     window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        if (event.target == 'edit')     window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit', "_self");
                        {{--if (event.target == 'delete')--}}
                            {{--w2confirm('Вы хотите Удалить ?')--}}
                                {{--.yes(function () {--}}
                                    {{--window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/delete', "_self");--}}
                                {{--})--}}
                                {{--.no(function () {--}}
                                    {{--//No--}}
                                {{--});--}}
                    },
                    items: [
                        {type: 'button', id: 'append', text: 'Добавить', icon: 'w2ui-icon-plus', disabled: false},
                        {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
                        {
                            type: 'button',
                            id: 'edit',
                            text: 'Редактировать',
                            icon: 'w2ui-icon-pencil',
                            disabled: true
                        },
                        // {type: 'button', id: 'delete', text: 'Удалить', icon: 'fa fa-eraser', disabled: false},
                        {type: 'break', id: 'break0'},
                    ]
                },
                multiSearch: true,
                searches: [
                    { field: 'code', caption: '{{trans('serviceOtpLimits.backend.table.code') }}', type: 'text' },
                    { field: 'name', caption: '{{trans('serviceOtpLimits.backend.table.name')}}', type: 'text' },
                ],
                columns: [
                    {field: 'recid', caption: 'ID', size: '50px', sortable: true, attr: 'align=left'},
                    {
                        field: 'code',
                        caption: '{{ trans('serviceOtpLimits.backend.table.code') }}',
                        size: '100px',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'name',
                        caption: '{{ trans('serviceOtpLimits.backend.table.name')}}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    {{--},{--}}
                        {{--field: 'params_json',--}}
                        {{--caption: '{{ trans('serviceOtpLimits.backend.table.params_json')}}',--}}
                        {{--size: '120%',--}}
                        {{--sortable: true,--}}
                        {{--attr: 'align=left'--}}
                    },{
                        field: 'updated_at',
                        caption: '{{trans('serviceOtpLimits.backend.table.updated_at') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'created_at',
                        caption: '{{trans('serviceOtpLimits.backend.table.created_at') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                ],
                onSelect: function (event) {
                    this.toolbar.enable('edit');
                    this.toolbar.enable('show');
                    this.toolbar.enable('delete');
                },
                onUnselect: function (event) {
                    this.toolbar.disable('edit');
                    this.toolbar.disable('show');
                    this.toolbar.disable('delete');
                },
                records: [
                    @include('backend.service.serviceOtpLimits.partials.table')
                ]
            });
        });
    </script>
@stop