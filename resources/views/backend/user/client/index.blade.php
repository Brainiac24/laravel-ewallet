@extends('adminlte::page')

@section('title',  "AdminLTE ")

@section('content_header')
    <h1>{{ trans('client.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.errors')
    @include('backend.user.client.partials.search_box')   {{--KAMOL--}}
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
            {{$clients->render() }}
        </div><!-- box-footer -->

        `
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
                        if (event.target == 'show') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        if (event.target == 'edit') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit', "_self");
                        if (event.target == 'delete')
                            w2confirm('Вы хотите заблокировать ?')
                                .yes(function () {
                                    window.open(window.location + "/" + w2ui.grid.getSelection() + '/delete', "_self");
                                })
                                .no(function () {
                                    //No
                                });
                        if (event.target == 'unlock')
                            w2confirm('Вы хотите разблокировать ?')
                                .yes(function () {
                                    window.open(window.location + "/" + w2ui.grid.getSelection() + '/unlock', "_self");
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
                        {type: 'break', id: 'break0'},
                        {type: 'spacer'},


                    ]
                },
                columns: [
                    {field: 'recid', caption: '', size: '00px', sortable: true, attr: 'align=left'},
                    {
                        field: 'msisdn',
                        caption: '{{ trans("client.backend.table.msisdn") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'last_name',
                        caption: '{{ trans("client.backend.table.last_name") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'first_name',
                        caption: '{{ trans("client.backend.table.first_name") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'middle_name',
                        caption: '{{ trans("client.backend.table.middle_name") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'balance',
                        caption: '{{ trans("client.backend.table.balance") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'attestation',
                        caption: '{{ trans("client.backend.table.attestation") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'email',
                        caption: '{{ trans("client.backend.table.email") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'is_active',
                        caption: '{{ trans("client.backend.table.is_active") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'is_auth',
                        caption: '{{ trans("client.backend.table.is_auth") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'blocked_at',
                        caption: '{{ trans("client.backend.table.blocked_at")}}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'last_login_at',
                        caption: '{{ trans("client.backend.table.last_login_at")}}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_at',
                        caption: '{{ trans("client.backend.table.created_at") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                ],
                onSelect: function (event) {
                    this.toolbar.enable('edit');
                    //this.toolbar.enable('unlock');
                    this.toolbar.enable('delete');
                },
                onUnselect: function (event) {
                    this.toolbar.disable('edit');
                    //this.toolbar.disable('unlock');
                    this.toolbar.disable('delete');
                },
                records: [
                    @include('backend.user.client.partials.table')
                ]
            });

        });
    </script>
@stop