@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('tempUsers.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.user.tempUser.partials.search_box')
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
            {{$tempUsers->render() }}
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
                    {field: 'number', caption: '{{ trans('tempUsers.backend.table.number') }}', type: 'text'},
                    {field: 'username', caption: '{{ trans('tempUsers.backend.table.username') }}', type: 'text'},
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
                        field: 'code_map',
                        caption: '{{ trans('tempUsers.backend.table.code_map') }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'username',
                        caption: '{{ trans('tempUsers.backend.table.username') }}',
                        size: '100%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'msisdn',
                        caption: '{{ trans('tempUsers.backend.table.msisdn') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'contacts_json',
                        caption: '{{ trans('tempUsers.backend.table.contacts_json') }}',
                        size: '65%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'country_born_id',
                        caption: '{{ trans('tempUsers.backend.table.country_born') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'country_id',
                        caption: '{{ trans('tempUsers.backend.table.country') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'region_id',
                        caption: '{{ trans('tempUsers.backend.table.region') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'area_id',
                        caption: '{{ trans('tempUsers.backend.table.area') }}',
                        size: '65%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'city_id',
                        caption: '{{ trans('tempUsers.backend.table.city') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'document_type_id',
                        caption: '{{ trans('tempUsers.backend.table.document_type') }}',
                        size: '55%',
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
                    @include('backend.user.tempUser.partials.table')
                ]
            });
        });
    </script>
@stop