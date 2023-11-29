@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('userSessionCode.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.user.userSessionCode.partials.search_box')
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
            {{$userSessionCodes->render() }}
        </div><!-- box-footer -->
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
                        if (event.target == 'show') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        },
                    items: [
                        {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
                    ]
                },
                multiSearch: true,
                searches: [
                    {field: 'value', caption: '{{ trans('userSessionCode.backend.table.value') }}', type: 'text'},
                    {field: 'code', caption: '{{ trans('userSessionCode.backend.table.code') }}', type: 'text'},
                ],
                columns: [
                    {
                        field: 'recid',
                        caption: 'ID',
                        size: '50px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'value',
                        caption: '{{ trans('userSessionCode.backend.table.value') }}',
                        size: '45%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'code',
                        caption: '{{ trans('userSessionCode.backend.table.code') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'unblock_at',
                        caption: '{{ trans('userSessionCode.backend.table.unblock_at') }}',
                        size: '55%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'blocked_at',
                        caption: '{{ trans('userSessionCode.backend.table.blocked_at') }}',
                        size: '55%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'code_sent_at',
                        caption: '{{ trans('userSessionCode.backend.table.code_sent_at') }}',
                        size: '45%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_by_user_id',
                        caption: '{{ trans('userSessionCode.backend.table.created_by_user_id') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'user_session_code_type_id',
                        caption: '{{ trans('userSessionCode.backend.table.user_session_code_type_id') }}',
                        size: '75%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_at',
                        caption: '{{ trans('userSessionCode.backend.table.created_at') }}',
                        size: '65%',
                        sortable: true,
                        attr: 'align=left'
                    }
                ],
                onSelect: function (event) {
                    this.toolbar.enable('show');
                },
                onUnselect: function (event) {
                    this.toolbar.disable('show');
                },
                records: [
                    @include('backend.user.userSessionCode.partials.table')
                ]
            });
        });
    </script>
@stop