@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('jobLog.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.errors')
    @include('backend.jobLog.partials.search_box')

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
            {{  $jobLog->render() }}
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
                        @if(Request::get("is_from_archive") == true)
                        if (event.target == 'show') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/archive/', "_self");
                        @else
                            if (event.target == 'show') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        @endif
                    },
                    items: [
                        // {type: 'button', id: 'append', text: 'Добавить', icon: 'w2ui-icon-plus', disabled: false},
                        {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
                        {type: 'break', id: 'break0'},
                    ]
                },
                multiSearch: true,
                searches: [
                    {field: 'recid', caption: '{{ trans('jobLog.backend.table.id') }}', type: 'text'},
                    {
                        field: 'transaction_id',
                        caption: '{{ trans('jobLog.backend.table.transaction_id') }}',
                        type: 'text'
                    },

                ],
                columns: [
                    {
                        field: 'recid',
                        caption: '{{ trans('jobLog.backend.table.id') }}',
                        size: '50px',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'parent_id',
                        caption: '{{ trans('jobLog.backend.table.parent_id') }}',
                        size: '50px',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'transaction_id',
                        caption: '{{ trans('jobLog.backend.table.transaction_id') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'order_id',
                        caption: '{{ trans('jobLog.backend.table.order_id') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'params_json',
                        caption: '{{ trans('jobLog.backend.table.params_json') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'client_request_log',
                        caption: '{{ trans('jobLog.backend.table.client_request_log') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }
                    , {
                        field: 'client_response',
                        caption: '{{ trans('jobLog.backend.table.client_response') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }
                    , {
                        field: 'is_error',
                        caption: '{{ trans('jobLog.backend.table.is_error') }}',
                        size: '55px',
                        sortable: true,
                        attr: 'align=left'
                    }
                    , {
                        field: 'error_message',
                        caption: '{{ trans('jobLog.backend.table.error_message') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'child_to_process_count',
                        caption: '{{ trans('jobLog.backend.table.child_to_process_count') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'child_processed_count',
                        caption: '{{ trans('jobLog.backend.table.child_processed_count') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'type',
                        caption: '{{ trans('jobLog.backend.table.type') }}',
                        size: '80%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'is_completed',
                        caption: '{{ trans('jobLog.backend.table.is_completed') }}',
                        size: '55px',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'is_lock',
                        caption: '{{ trans('jobLog.backend.table.is_lock') }}',
                        size: '55px',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'allowed_try_count',
                        caption: '{{ trans('jobLog.backend.table.allowed_try_count') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'created_by_user_id',
                        caption: '{{ trans('jobLog.backend.table.created_by_user_id') }}',
                        size: '80%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'created_at',
                        caption: '{{ trans('jobLog.backend.table.created_at') }}',
                        size: '80%',
                        sortable: true,
                        attr: 'align=left'
                    }

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
                    @include('backend.jobLog.partials.table')
                ]
            });
        });
    </script>
@stop