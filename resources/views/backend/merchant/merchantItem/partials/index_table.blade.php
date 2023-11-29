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
        {{--            {{  $merchants->render() }}--}}
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
                    if (event.target == 'append') window.open('{{url()->current()}}' + "/items/create", "_self");
                    if (event.target == 'show') window.open('{{url()->current()}}' + "/items/" + w2ui.grid.getSelection() + '', "_self");
                    if (event.target == 'edit') window.open('{{url()->current()}}' + "/items/" + w2ui.grid.getSelection() + '/edit', "_self");
                    if (event.target == 'delete')
                        w2confirm('Вы хотите отключить?')
                            .yes(function () {
                                window.open('{{url()->current()}}' + "/items/" + w2ui.grid.getSelection() + '/delete', "_self");
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
                {field: 'name', caption: '{{ trans('merchantItem.backend.table.name') }}', type: 'text'}
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
                    caption: '{{ trans('merchantItem.backend.table.name') }}',
                    size: '40%',
                    sortable: true,
                    attr: 'align=left'
                },{
                    field: 'phone',
                    caption: '{{ trans('merchantItem.backend.table.phone') }}',
                    size: '40%',
                    sortable: true,
                    attr: 'align=left'
                },{
                    field: 'email',
                    caption: '{{ trans('merchantItem.backend.table.email') }}',
                    size: '40%',
                    sortable: true,
                    attr: 'align=left'
                },{
                    field: 'address',
                    caption: '{{ trans('merchantItem.backend.table.address') }}',
                    size: '40%',
                    sortable: true,
                    attr: 'align=left'
                },{
                    field: 'account_number',
                    caption: '{{ trans('merchant.backend.table.account_number') }}',
                    size: '25%',
                    sortable: true,
                    attr: 'align=left'
                },{
                    field: 'is_active',
                    caption: '{{ trans('merchantItem.backend.table.is_active') }}',
                    size: '30%',
                    sortable: true,
                    attr: 'align=left'
                },{
                    field: 'updated_at',
                    caption: '{{ trans('merchantItem.backend.table.updated_at') }}',
                    size: '40%',
                    sortable: true,
                    attr: 'align=left'
                }, {
                    field: 'created_at',
                    caption: '{{ trans('merchantItem.backend.table.created_at') }}',
                    size: '40%',
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
                @include('backend.merchant.merchantItem.partials.table')
            ]
        });
    });
</script>