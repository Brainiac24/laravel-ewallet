@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('order.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.order.order.partials.search_box')
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
            {{  $orders->render() }}
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
                        if (event.target == 'show') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        if (event.target == 'edit') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit', "_self");
                        },
                    items: [
                        {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
                        {
                            type: 'button',
                            id: 'edit',
                            text: 'Редактировать',
                            icon: 'w2ui-icon-pencil',
                            disabled: true
                        },
                    ]
                },
                multiSearch: true,
                searches: [
                    {field: 'order_type', caption: '{{ trans('order.backend.table.order_type') }}', type: 'text'},
                    {field: 'number', caption: '{{ trans('order.backend.table.number') }}', type: 'text'},
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
                        field: 'order_type_id',
                        caption: '{{ trans('order.backend.table.order_type') }}',
                        size: '65%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'number',
                        caption: '{{ trans('order.backend.table.number') }}',
                        size: '20%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'from_user_id',
                        caption: '{{ trans('order.backend.table.from_user') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'from_user_full_name',
                        caption: '{{ trans('order.backend.table.from_user_fio') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'to_user_id',
                        caption: '{{ trans('order.backend.table.to_user') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'entity_type',
                        caption: '{{ trans('order.backend.table.entity') }}',
                        size: '15%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'entity_id',
                        caption: '{{ trans('order.backend.table.entity_id') }}',
                        size: '15%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {{--{--}}
                        {{--field: 'payload_params_json',--}}
                        {{--caption: '{{ trans('order.backend.table.payload_param_json') }}',--}}
                        {{--size: '55%',--}}
                        {{--sortable: true,--}}
                        {{--attr: 'align=left'--}}
                    {{--},--}}
                    {{--{--}}
                        {{--field: 'response',--}}
                        {{--caption: '{{ trans('order.backend.table.response') }}',--}}
                        {{--size: '55%',--}}
                        {{--sortable: true,--}}
                        {{--attr: 'align=left'--}}
                    {{--},--}}
                    {
                        field: 'order_status_id',
                        caption: '{{ trans('order.backend.table.order_status') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'order_process_status_id',
                        caption: '{{ trans('order.backend.table.order_process_status_id') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'updated_at',
                        caption: '{{ trans('order.backend.table.updated_at') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'created_at',
                        caption: '{{ trans('order.backend.table.created_at') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },

                ],
                onSelect: function (event) {
                    this.toolbar.enable('show');
                    this.toolbar.enable('edit');
                },
                onUnselect: function (event) {
                    this.toolbar.disable('show');
                    this.toolbar.disable('edit');
                },
                records: [
                    @include('backend.order.order.partials.table')
                ]
            });
        });
    </script>
@stop