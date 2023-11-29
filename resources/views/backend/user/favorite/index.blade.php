@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('favorite.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.user.favorite.partials.search_box')   {{--KAMOL--}}
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
        <div class="box-footer">
            {{$favorites->render() }}
        </div><!-- box-footer -->

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
                    toolbarInput: false,
                    toolbarEdit: false,
                },
                toolbar: {
                    onClick: function (event) {
                        if (event.target == 'append')   window.open('{{url()->current()}}' + "/create", "_self");
                        if (event.target == 'show')     window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        if (event.target == 'edit')     window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit', "_self");
                        if (event.target == 'restore')     window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/restore', "_self");
                        if (event.target == 'delete')
                            w2confirm('Вы хотите Удалить ?')
                                .yes(function () {
                                    window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/delete', "_self");
                                })
                                .no(function () {
                                    //No
                                });
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
                        {type: 'button', id: 'delete', text: 'Удалить', icon: 'fa fa-eraser', disabled: true},
                        {type: 'button', id: 'restore', text: 'Восстановить', icon: 'fa fa-mail-reply-all', disabled: true},
                        {type: 'break', id: 'break0'},
                    ]
                },
                columns: [
                    {field: 'recid', caption: 'ID', size: '50px', sortable: true, attr: 'align=left'},
                    {
                        field: 'name',
                        caption: '{{  trans('favorite.backend.table.name')  }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'value',
                        caption: '{{  trans('favorite.backend.table.value')  }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'params_json',
                        caption: '{{  trans('favorite.backend.table.params_json')  }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'service',
                        caption: '{{  trans('service.backend.table.name')  }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'user',
                        caption: '{{  trans('users.backend.table.msisdn')  }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'updated_at',
                        caption: '{{trans('favorite.backend.table.updated_at') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'created_at',
                        caption: '{{trans('favorite.backend.table.created_at') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                ],
                onSelect: function (event) {
                    var record = this.get(event.recid);
                    console.log(record);
                    console.log(record.deleted_at);

                    if (record.deleted_at==null || record.deleted_at==""){
                        this.toolbar.enable('edit');
                        this.toolbar.enable('show');
                        this.toolbar.enable('delete');
                    }else{
                        this.toolbar.enable('restore');
                    }

                },
                onUnselect: function (event) {
                    this.toolbar.disable('edit');
                    this.toolbar.disable('show');
                    this.toolbar.disable('delete');
                    this.toolbar.disable('restore');
                },
                records: [
                    @include('backend.user.favorite.partials.table')
                ]
            });
        });
    </script>
@stop