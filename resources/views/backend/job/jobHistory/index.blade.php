@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('jobHistory.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.errors')
    @include('backend.errors.error')
    @include('backend.job.jobHistory.partials.search_box')

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
            {{  $jobHistory->render() }}
        </div>
    </div><!-- /.box -->
    <script type="text/javascript">
        var currentUrl = 0;
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
                        if (event.target == 'show') window.open('{{route('admin.jobHistory.index')}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                    },
                    items: [
                        // {type: 'button', id: 'append', text: 'Добавить', icon: 'w2ui-icon-plus', disabled: false},
                        {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
                        {type: 'break', id: 'break0'},
                    ]
                },
                multiSearch: true,
                columns: [
                    {
                        field: 'recid',
                        caption: '{{ trans('jobHistory.backend.table.id') }}',
                        size: '50px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'name',
                        caption: '{{ trans('jobHistory.backend.table.name') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_user',
                        caption: '{{ trans('jobHistory.backend.table.created_user') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'type',
                        caption: '{{ trans('jobHistory.backend.table.type') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_at',
                        caption: '{{ trans('jobHistory.backend.table.created_at') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'processed_at',
                        caption: '{{ trans('jobHistory.backend.table.processed_at') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'finished_at',
                        caption: '{{ trans('jobHistory.backend.table.finished_at') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },

                    {
                        field: 'link',
                        caption: '{{ trans('jobHistory.backend.table.link') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left',
                        render: function (record) {
                            if(record.status_id == 2) {
                                return '<a href="jobHistory/' + record.link + '/download">Скачать</a>';
                            }
                            return '';
                        }
                    },
                    {
                        field: 'status',
                        caption: '{{ trans('jobHistory.backend.table.status') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },

                ],
                onSelect: function (event) {
                    this.toolbar.enable('show');
                },
                onUnselect: function (event) {
                    this.toolbar.disable('show');
                },
                records: [
                    @include('backend.job.jobHistory.partials.table')
                ]
            });
        });
    </script>
@stop