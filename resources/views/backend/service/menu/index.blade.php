@extends('adminlte::page')

@section('title', trans('menu.backend.title'))

@section('content_header')
    <h1>{{ trans('menu.backend.title') }}</h1>
@stop

@section('content')

    @include('backend.errors.success')
    @include('backend.errors.error')
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
                multiSearch: true,
                searches: [
                    { field: 'code', caption: 'Код сервиса', type: 'text' },
                    { field: 'category_name', caption: 'Категория', type: 'text' },
                    { field: 'service_processing_code', caption: 'Код процессинга', type: 'text' },
                    { field: 'created_at', caption: 'Создан', type: 'date'}
                ],

                toolbar: {
                    onClick: function (event) {
                        if (event.target == 'append')   window.open('{{url()->current()}}' + "/create", "_self");
                        if (event.target == 'show')     window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        if (event.target == 'edit')     window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit', "_self");
                        if (event.target == 'delete')
                            w2confirm('Вы хотите Удалить ?')
                                .yes(function () {
                                    var selected_category_id = '';
                                     var sel_rec_ids = w2ui.grid.getSelection();
                                        if (sel_rec_ids.length) {
                                            var sel_record = w2ui.grid.get(sel_rec_ids[0]);
                                            selected_category_id = sel_record.category_id;
                                        } else {
                                            console.log("Nothing selected!");
                                        }

                                    window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/delete/'+selected_category_id, "_self");
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
                        {type: 'break', id: 'break0'},
                    ]
                },
                columns: [
                    {field: 'recid', caption: 'ID', size: '50px', sortable: true, attr: 'align=left'},
                    {
                        field: 'category_name',
                        caption: '{{ trans("category.backend.table.name") }}',
                        size: '500px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'photo',
                        caption: '{{ trans("service.backend.table.icon_url") }}',
                        size: '40px',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'code',
                        caption: '{{ trans("service.backend.table.code") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },

                    {
                        field: 'service_processing_code',
                        caption: '{{ trans("service.backend.table.processing_code") }}',
                        size: '90px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'service_is_active',
                        caption: '{{ trans("service.backend.table.is_active") }}',
                        size: '90px',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'service_updated_at',
                        caption: '{{ trans("service.backend.table.updated_at") }}',
                        size: '90px',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'position',
                        caption: '{{ trans("service.backend.table.position") }}',
                        size: '90px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'updated_at',
                        caption: '{{ trans("service.backend.table.updated_at") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_at',
                        caption: '{{ trans("service.backend.table.created_at") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                ],
                onSelect: function (event) {
                    //this.toolbar.enable('edit');
                    this.toolbar.enable('show');
                    this.toolbar.enable('delete');
                },
                onUnselect: function (event) {
                    //this.toolbar.disable('edit');
                    this.toolbar.disable('show');
                    this.toolbar.disable('delete');
                },
                records: [
                    @include('backend.service.menu.partials.table')
                ]
            });

        });
    </script>
@stop