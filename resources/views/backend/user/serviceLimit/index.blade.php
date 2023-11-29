@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('userServiceLimit.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.errors')
    @include('backend.user.serviceLimit.partials.search_box')   {{--KAMOL--}}
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
        <div id="grid" style="width: 100%; min-height: 700px; max-height: 1000px;"></div>
        <div class="box-footer">
            {{$userServiceLimits->render() }}
        </div><!-- box-footer -->
    </div><!-- /.box -->
    <script type="text/javascript">
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
                    toolbarSearch: false,
                    toolbarInput: false,
                    toolbarEdit: false,

                },
                toolbar: {
                    onClick: function (event) {
                        if (event.target == 'append') window.open(window.location + "/create", "_self");
                        if (event.target == 'show') window.open(window.location + "/" + w2ui.grid.getSelection() + '', "_self");
                        if (event.target == 'edit') window.open(window.location + "/" + w2ui.grid.getSelection() + '/edit', "_self");
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
                        {type: 'button', id: 'append', text: 'Добавить', icon: 'w2ui-icon-plus', disabled: true},
                        {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
                        {
                            type: 'button',
                            id: 'edit',
                            text: 'Редактировать',
                            icon: 'w2ui-icon-pencil',
                            disabled: true
                        },
                        {type: 'button', id: 'delete', text: 'Удалить', icon: 'fa fa-eraser', disabled: true},
                        {type: 'break', id: 'break0'},
                        {type: 'spacer'},
                        ]
                },
                columns: [
                    {field: 'recid', caption: 'ID', size: '50px', sortable: true, attr: 'align=left'},
                    {
                        field: 'name',
                        caption: '{{ trans("userServiceLimit.backend.table.name") }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'msisdn',
                        caption: '{{ trans("users.backend.table.msisdn") }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'full_name',
                        caption: '{{ trans("users.backend.table.fio") }}',
                        size: '75%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'service_id',
                        caption: '{{ trans("userServiceLimit.backend.table.service_id") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'params_json',
                        caption: '{{ trans("userServiceLimit.backend.table.params_json") }}',
                        size: '75%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'extend_params_json',
                        caption: '{{ trans("userServiceLimit.backend.table.extend_params_json") }}',
                        size: '75%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'updated_at',
                        caption: '{{ trans("userServiceLimit.backend.table.updated_at") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_at',
                        caption: '{{ trans("userServiceLimit.backend.table.created_at") }}',
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
                    @include('backend.user.serviceLimit.partials.table')
                ]
            });

        });
    </script>
@stop