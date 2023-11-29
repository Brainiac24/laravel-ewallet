@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('remoteIdentification.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.order.remoteIdentification.partials.search_box')
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
            {{  $remoteIdentifications->render() }}
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
                        if (event.target == 'edit') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit?url={{base64_encode(Request::fullUrl())}}', "_self");
                        if (event.target == 'show') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        if (event.target == 'update_status') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/updateStatus', "_self");
                        if (event.target == 'identification-accounts-check-run') window.open('{{route("admin.remoteIdentification.identificationAccountsCheckRun")}}', "_self");
                        if (event.target == 'take-to-work') {

                            $.getJSON( '{{url()->current()}}'+ "/" + w2ui.grid.getSelection() + '/takeToWork', function( data ) {

                                $("#takeToWorkConfirmModal .ok").off();
                                $("#takeToWorkConfirmModal .ok").click(function () {
                                    $.getJSON( '{{url()->current()}}'+ "/" + w2ui.grid.getSelection() + '/takeToWork?confirmed=1', function( data ) {
                                        window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit?url={{base64_encode(Request::fullUrl())}}', "_self");
                                    }).fail(function(data) {
                                        errorModal(data);
                                    });
                                });

                                $("#takeToWorkConfirmModal .message").text(data.message);

                                if(data.code == 2) {
                                    $("#takeToWorkConfirmModal .ok").attr("disabled", "disabled");
                                    takeToWorkConfirmModal("show");
                                }else if(data.code == 3){
                                    $("#takeToWorkConfirmModal .ok").click();
                                }else{
                                    $("#takeToWorkConfirmModal .ok").removeAttr("disabled");
                                    takeToWorkConfirmModal("show");
                                }

                            }).fail(function(data) {
                                errorModal(data);
                            });
                        }
                        },
                    items: [
                        {
                            type: 'button',
                            id: 'show',
                            text: 'Детально',
                            icon: 'w2ui-icon-check',
                            disabled: true
                        },
                        {
                            type: 'button',
                            id: 'edit',
                            text: 'Редактировать',
                            icon: 'w2ui-icon-pencil',
                            disabled: true
                        },
                        {
                            type: 'button',
                            id: 'take-to-work',
                            text: 'Взять на работу',
                            disabled: true
                        },
                        {
                            type: 'button',
                            id: 'update_status',
                            text: 'Отменить заявку',
                            disabled: true
                        },
                        {
                            type: 'button',
                            id: 'identification-accounts-check-run',
                            text: 'Запустить команду'
                        }
                    ]
                },
                multiSearch: true,
                columns: [
                    {
                        field: 'recid',
                        caption: 'ID',
                        size: '50px',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_at',
                        caption: '{{ trans('remoteIdentification.backend.table.created_at') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'updated_at',
                        caption: '{{ trans('remoteIdentification.backend.table.updated_at') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'user_full_name',
                        caption: '{{ trans('remoteIdentification.backend.table.user_full_name') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'msisdn',
                        caption: '{{ trans('remoteIdentification.backend.table.msisdn') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'passport',
                        caption: '{{ trans('remoteIdentification.backend.table.passport') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'address',
                        caption: '{{ trans('remoteIdentification.backend.table.address') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'inn',
                        caption: '{{ trans('remoteIdentification.backend.table.inn') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'status',
                        caption: '{{ trans('remoteIdentification.backend.table.status') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'process_status',
                        caption: '{{ trans('remoteIdentification.backend.table.process_status') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'information',
                        caption: '{{ trans('remoteIdentification.backend.table.information') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'user_attestation',
                        caption: '{{ trans('users.backend.table.attestation_id') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'processed_by_user',
                        caption: 'Обработал',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'processed_by_user_id',
                        caption: '',
                        hidden: true
                    },
                    {
                        field: 'status_id',
                        caption: '',
                        hidden: true
                    },
                    {
                        field: 'comment',
                        caption: '{{ trans('remoteIdentification.backend.comment') }}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'call_status',
                        caption: 'Статус звонка',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'number',
                        caption: '{{trans('remoteIdentification.backend.number')}}',
                        size: '40%',
                        sortable: true,
                        attr: 'align=left'
                    },

                ],
                onSelect: function (event) {
                    var index = w2ui['grid'].find({ recid: event.recid }, true)[0];
                    var status = w2ui['grid'].getCellValue(index, 14);
                    var processedByUserId = w2ui['grid'].getCellValue(index, 13);

                    if(processedByUserId == "{{\Auth::user()->id}}") {
                        this.toolbar.enable('edit');
                    }

                    if(processedByUserId != "{{\Auth::user()->id}}" &&
                      (new Array("new", "in_process", "accepted")).indexOf(status) != -1) {

                        this.toolbar.enable('take-to-work');
                    }
                    
                    if ((new Array("in_process")).indexOf(status) != -1) {
                        this.toolbar.enable('update_status');
                    }

                    this.toolbar.enable('show');
                },
                onUnselect: function (event) {
                    this.toolbar.disable('edit');
                    this.toolbar.disable('show');
                    this.toolbar.disable('take-to-work');
                },
                records: [
                    @include('backend.order.remoteIdentification.partials.table')
                ]
            });
        });
    </script>

    <div class="modal" id="takeToWorkConfirmModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="message"></h4>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary btn-sm ok" value="Взять на работу" />
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Отменить</button>
                </div>
            </div>
        </div>
    </div>

    <!--  Модальная окна для всяких ошибок -->
    <div class="modal" id="alertModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                    <div class="alert" role="alert" style="border-radius: 0;">

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('page_js')
    <script>
        function takeToWorkConfirmModal($e) {
            $("#takeToWorkConfirmModal").modal($e);
        }

        function errorModal(data) {
            console.log('Error:', data);
            $('#alertModal .modal-body .alert').removeClass("alert-success").addClass("alert-danger");
            if(data.responseJSON.errors != undefined){
                var msErrors = "<ul>";
                $.each(data.responseJSON.errors, function (key, value) {
                    msErrors += "<li>" + value + "</li>";
                });
                msErrors += "</ul>";
                $('#alertModal .modal-body .alert').html(msErrors);
            }else {
                $('#alertModal .modal-body .alert').html(data.responseJSON.message);
            }
            $('#alertModal').modal('show');
        }
    </script>
@stop