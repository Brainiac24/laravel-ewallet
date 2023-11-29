@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('orderDepositTypeItem.backend.title') }}</h1>
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

        <div class="box-footer">
            {{  $orderDepositTypeItems->render() }}
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
                        if (event.target == 'append') window.open('{{url()->current()}}' + "/create", "_self");
                        if (event.target == 'edit') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit', "_self");
                        if (event.target == 'delete')
                            w2confirm('Вы хотите отключить?')
                                .yes(function () {
                                    window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/delete', "_self");
                                })
                                .no(function () {
                                    //No
                                });
                    },
                    items: [
                        {type: 'button', id: 'append', text: 'Добавить', icon: 'w2ui-icon-plus', disabled: false},
                        {
                            type: 'button',
                            id: 'edit',
                            text: 'Редактировать',
                            icon: 'w2ui-icon-pencil',
                            disabled: true
                        },
                        {type: 'button', id: 'delete', text: 'Отключить', icon: 'fa fa-eraser', disabled: true},
                        {type: 'break', id: 'break0'},
                    ]
                },
                columns: [
                    {
                        field: 'recid',
                        caption: 'ID',
                        size: '50px',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'code',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.code") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'code_map',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.code_map") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'name',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.name") }}',
                        size: '90%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'min_amount',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.min_amount") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'max_amount',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.max_amount") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'day_from_count',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.day_from_count") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'day_to_count',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.day_to_count") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'percentage',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.percentage") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'can_fill_until',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.can_fill_until") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'can_fill_until_is_persentage',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.can_fill_until_is_persentage") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'currency_name',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.currency_name") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'order_deposit_type_name',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.order_deposit_type_name") }}',
                        size: '60%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'position',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.position") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'is_fillable',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.is_fillable") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'is_withdrawable',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.is_withdrawable") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'is_active',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.is_active") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_at',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.created_at") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'updated_at',
                        caption: '{{ trans("orderDepositTypeItem.backend.table.updated_at") }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    }

                ],
                onSelect: function (event) {
                    this.toolbar.enable('edit');
                    this.toolbar.enable('delete');
                },
                onUnselect: function (event) {
                    this.toolbar.disable('edit');
                    this.toolbar.disable('delete');
                },
                records: [
                    @include('backend.order.orderDepositTypeItem.partials.table')
                ]
            });
        });
    </script>
@stop