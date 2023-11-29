@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('currencyRate.backend.title') }}</h1>
@stop

@section('content')

    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.currency.currencyRate.partials.search_box')   {{--KAMOL--}}
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
            {{ $currencyRates->render() }}
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
                    toolbarSearch: false,
                    toolbarInput: false,
                    toolbarEdit: false,
                },
                toolbar: {
                    onClick: function (event) {
                        if (event.target == 'append') window.open('{{url()->current()}}' + "/create", "_self");
                        if (event.target == 'show') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        if (event.target == 'edit') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit', "_self");
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


                    ]
                },
                columns: [
                    {field: 'recid', caption: 'ID', size: '50px', sortable: true, attr: 'align=left'},
                    {
                        field: 'code',
                        caption: '{{ trans("currency.backend.table.code") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'name',
                        caption: '{{ trans("currency.backend.table.name") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'short_name',
                        caption: '{{ trans("currency.backend.table.short_name") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'iso_name',
                        caption: '{{ trans("currency.backend.table.iso_name") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'symbol_left',
                        caption: '{{ trans("currency.backend.table.symbol_left") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'symbol_right',
                        caption: '{{ trans("currency.backend.table.symbol_right") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'is_primary',
                        caption: '{{ trans("currency.backend.table.is_primary") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'is_active',
                        caption: '{{ trans("currency.backend.table.is_active")}}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'value_buy',
                        caption: '{{ trans("currencyRate.backend.table.value_buy")}}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'value_sell',
                        caption: '{{ trans("currencyRate.backend.table.value_sell")}}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'currency_rate_category_name',
                        caption: '{{ trans("currencyRate.backend.table.currency_rate_category_name")}}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_at',
                        caption: '{{ trans("currencyRate.backend.table.created_at") }}',
                        size: '120px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'updated_at',
                        caption: '{{ trans("currencyRate.backend.table.updated_at") }}',
                        size: '120px',
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
                    @include('backend.currency.currencyRate.partials.table')
                ]
            });

        });
    </script>

@stop