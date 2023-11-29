@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('purpose.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.purpose.partials.search_box')

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
            {{  $purposes->render() }}
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
                        },
                    items: [
                        {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
                    ]
                },
                multiSearch: true,
                searches: [
                    {field: 'code', caption: '{{ trans('purpose.backend.table.code') }}', type: 'text'},
                    {field: 'name', caption: '{{ trans('purpose.backend.table.name') }}', type: 'text'},
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
                        field: 'code',
                        caption: '{{ trans('purpose.backend.table.code') }}',
                        size: '20%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'code_map',
                        caption: '{{ trans('purpose.backend.table.code_map') }}',
                        size: '20%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'name',
                        caption: '{{ trans('purpose.backend.table.name') }}',
                        size: '65%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'desc',
                        caption: '{{ trans('purpose.backend.table.desc') }}',
                        size: '65%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'is_active',
                        caption: '{{ trans('orderStatus.backend.table.is_active') }}',
                        size: '20%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'purpose_type_name',
                        caption: '{{ trans('purpose.backend.table.purpose_type_name') }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'updated_at',
                        caption: '{{ trans('orderStatus.backend.table.updated_at') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'created_at',
                        caption: '{{ trans('orderStatus.backend.table.created_at') }}',
                        size: '40%',
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
                    @include('backend.purpose.partials.table')
                ]
            });
        });
    </script>
@stop