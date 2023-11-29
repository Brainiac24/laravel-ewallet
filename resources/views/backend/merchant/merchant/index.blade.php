@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('merchant.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.merchant.merchant.partials.search_box')
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
            {{  $merchants->render() }}
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
                        if (event.target == 'show') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
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
                        {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
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
                multiSearch: true,
                searches: [
                    {field: 'name', caption: '{{ trans('merchant.backend.table.name') }}', type: 'text'}
                ],
                columns: [
                    {
                        field: 'recid',
                        caption: 'ID',
                        size: '50px',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'name',
                        caption: '{{ trans('merchant.backend.table.title') }}',
                        size: '70%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'login',
                        caption: '{{ trans('merchant.backend.table.login') }}',
                        size: '70%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'city_id',
                        caption: '{{ trans('merchant.backend.table.city_id') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'address',
                        caption: '{{ trans('merchant.backend.table.address') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'phone',
                        caption: '{{ trans('merchant.backend.table.phone') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'email',
                        caption: '{{ trans('merchant.backend.table.email') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'inn',
                        caption: '{{ trans('merchant.backend.table.inn') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'account_number',
                        caption: '{{ trans('merchant.backend.table.account_number') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'bank_id',
                        caption: '{{ trans('merchant.backend.table.bank_id') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'merchant_commission_id',
                        caption: '{{ trans('merchant.backend.table.merchant_commission_id') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'merchant_cashback_id',
                        caption: '{{ trans('merchant.backend.table.merchant_cashback_id') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'bank_cashback_id',
                        caption: '{{ trans('merchant.backend.table.bank_cashback_id') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'img_logo',
                        caption: '{{ trans('merchant.backend.table.img_logo') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'img_ad',
                        caption: '{{ trans('merchant.backend.table.img_ad') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'img_detail',
                        caption: '{{ trans('merchant.backend.table.img_detail') }}',
                        size: '25%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'workday',
                        caption: '{{ trans('merchant.backend.table.merchant_workday_id') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    }, {
                        field: 'referral',
                        caption: '{{ trans('merchant.backend.table.referral') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'document',
                        caption: '{{ trans('merchant.backend.table.document') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'position',
                        caption: '{{ trans('merchant.backend.table.position') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'is_active',
                        caption: '{{ trans('merchant.backend.table.is_active') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'is_qr_integrated',
                        caption: '{{ trans('merchant.backend.table.is_qr_integrated') }}',
                        size: '30%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'created_at',
                        caption: '{{ trans('merchant.backend.table.created_at') }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'contract_date_at',
                        caption: '{{ trans('merchant.backend.table.contract_date_at') }}',
                        size: '35%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'updated_at',
                        caption: '{{ trans('merchant.backend.table.updated_at') }}',
                        size: '35%',
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
                    @include('backend.merchant.merchant.partials.table')
                ]
            });
        });
    </script>
@stop