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
        @if(isset($transactions))
            {{$transactions->render() }}
        @endif
    </div><!-- box-footer -->
</div><!-- /.box -->
<script type="text/javascript">
    var currentUrl = 0;
    jQuery(function ($) {
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
                    if (event.target == 'child') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/child', "_self");
                    if (event.target == 'delete')
                        w2confirm('Вы хотите заблокировать ?')
                            .yes(function () {
                                window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/delete', "_self");
                            })
                            .no(function () {
                                //No
                            });
                    if (event.target == 'unlock')
                        w2confirm('Вы хотите разблокировать ?')
                            .yes(function () {
                                window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/unlock', "_self");
                            })
                            .no(function () {
                                //No
                            });
                },
                items: [
                    {type: 'button', id: 'append', text: 'Добавить', icon: 'w2ui-icon-plus', disabled: true},
                    {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
                    {type: 'button', id: 'edit', text: 'Редактировать', icon: 'w2ui-icon-pencil', disabled: true},
                    {type: 'button', id: 'child', text: 'Дочерные транзакции', icon: 'w2ui-icon-check', disabled: true},
                    {type: 'break', id: 'break0'},


                ]
            },
            columns: [
                {
                    field: 'recid', caption: 'ID', size: '30px', sortable: true, attr: 'align=left'
                },
                {
                    field: 'created_at',
                    caption: '{{ trans("transaction.backend.table.created_at") }}',
                    size: '160px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'sms_confirm_try_at',
                    caption: '{{ trans("transaction.backend.table.sms_confirm_try_at") }}',
                    size: '160px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'finished_at',
                    caption: '{{ trans("transaction.backend.table.finished_at") }}',
                    size: '160px',
                    sortable: true,
                    attr: 'align=left'
                },

                {
                    field: 'from_gateway',
                    caption: '{{ trans("transaction.backend.table.from_gateway") }}',
                    size: '190px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'from_account_id',
                    caption: '{{ trans("transaction.backend.table.from_account_id") }}',
                    size: '140px',
                    sortable: true,
                    attr: 'align=left'
                },
                /*{
                    field: 'to_account_id',
                    caption: '{{ trans("transaction.backend.table.to_account_id") }}',
                        size: '140px',
                        sortable: true,
                        attr: 'align=left'
                    },*/
                {
                    field: 'to_gateway',
                    caption: '{{ trans("transaction.backend.table.to_gateway") }}',
                    size: '180px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'params_json_to_account',
                    caption: '{{ trans("transaction.backend.table.params_json_to_account") }}',
                    size: '120px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'params_json_to_merchant_item',
                    caption: '{{ trans("transaction.backend.table.params_json_to_merchant_item") }}',
                    size: '120px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'service_name',
                    caption: '{{ trans("transaction.backend.table.service_id") }}',
                    size: '180px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'amount',
                    caption: '{{ trans("transaction.backend.table.amount") }}',
                    size: '80px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'from_currency_iso_name',
                    caption: '{{ trans("transaction.backend.table.from_currency_iso_name") }}',
                    size: '40px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'currency_rate_value',
                    caption: '{{ trans("transaction.backend.table.currency_rate_value") }}',
                    size: '60px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'converted_amount',
                    caption: '{{ trans("transaction.backend.table.converted_amount") }}',
                    size: '80px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'to_currency_iso_name',
                    caption: '{{ trans("transaction.backend.table.to_currency_iso_name") }}',
                    size: '40px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'commission',
                    caption: '{{ trans("transaction.backend.table.commission") }}',
                    size: '80px',
                    sortable: true,
                    attr: 'align=left'
                },
                /*{
                    field: 'currency_iso_name',
                    caption: '{{ trans("transaction.backend.table.currency_iso_name") }}',
                        size: '40px',
                        sortable: true,
                        attr: 'align=left'
                    },*/
                {
                    field: 'transaction_status_id',
                    caption: '{{ trans("transaction.backend.table.transaction_status_id") }}',
                    size: '80px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'transaction_status_detail_id',
                    caption: '{{ trans("transaction.backend.table.transaction_status_detail_id") }}',
                    size: '50px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'transaction_sync_status_id',
                    caption: '{{ trans("transaction.backend.table.transaction_sync_status_id") }}',
                    size: '170px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'is_otp',
                    caption: '{{ trans("transaction.backend.table.is_otp") }}',
                    size: '40px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'account_balance',
                    caption: '{{ trans("transaction.backend.table.account_balance") }}',
                    size: '120px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'session_number',
                    caption: '{{ trans("transaction.backend.table.session_number") }}',
                    size: '70px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'order_id',
                    caption: '{{ trans("transaction.backend.table.order_id") }}',
                    size: '70px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'comment',
                    caption: '{{ trans("transaction.backend.table.comment") }}',
                    size: '120px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'created_by_user_id',
                    caption: '{{ trans("transaction.backend.table.created_by_user_id") }}',
                    size: '120px',
                    sortable: true,
                    attr: 'align=left'
                },
                {
                    field: 'params_json',
                    caption: '{{ trans("transaction.backend.table.params_json") }}',
                    size: '400px',
                    sortable: true,
                    attr: 'align=left'
                },

            ],
            onSelect: function (event) {

                var record = this.get(event.recid);

                if (record.service_name == "Оплата по QR") {
                    this.toolbar.enable('child');
                }

                this.toolbar.enable('edit');
                this.toolbar.enable('show');
                this.toolbar.enable('delete');
            },
            onUnselect: function (event) {
                this.toolbar.disable('edit');
                this.toolbar.disable('child');
                this.toolbar.disable('show');
                this.toolbar.disable('delete');
            },
            records: {!! json_encode($transactions_to_array, JSON_UNESCAPED_UNICODE) !!}
        });

    });

</script>