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

<!--  Модальная окно для подтверждения отклонение заявки -->

<div class="modal" id="confirmRejectModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Вы действительно хотите отменить заявку?</h4>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-sm ok" value="Да" />
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Нет</button>
            </div>
        </div>
    </div>
</div>

<!--  Модальная окно для создания клиента -->

<div class="modal" id="createClientModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="message"></h4>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-sm ok" value="Создать" />
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Отменить</button>
            </div>
        </div>
    </div>
</div>

<!--  Модальная окно если клиент найдено более один -->

<div class="modal" id="foundManyClientModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Ок</button>
            </div>
        </div>
    </div>
</div>

<!--  Модальная окно для подверждение заявки после создание клиента -->

<div class="modal" id="confirmCreateClientModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="message"></h4>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary ok" value="Поиск" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
            </div>
        </div>
    </div>
</div>

<!--  Модальная окно для подверждение заявки после поиска клиента -->

<div class="modal" id="confirmSearchModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="text-align: center;font-weight: bold;color: #2283ff;font-size: 22px;" class="modal-title" id="confirmModalLabel">Modal Title</h4>
            </div>
            {{ Form::open(['route' => ['admin.remoteIdentification.confirm', $data->id],'method' => 'patch','id' => 'form-remote-identification-confirm'])}}
            {{Form::hidden("job_id",null)}}
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-primary btn-update-client" value="Обновить" />
                <input type="submit" class="btn btn-primary" value="Подтвердить" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>


<div class="modal bd-example-modal-lg" id="ajaxLoaderModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="overlay" style="text-align: center;">
            <i style="font-size: 14px;font-size: 70px;color: white;" class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
</div>

<!--  Модальная окна для message -->

<div class="modal" id="messageModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                укпуык ыукпцу кцуыкепрцу укернукер
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Ок</button>
            </div>
        </div>
    </div>
</div>


@if (config("app_settings.remote_indentification_requred_check_nalog") == true)
    <div class="modal" id="checkNalogInnModal" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="text-align: center;font-weight: bold;color: #2283ff;font-size: 22px;" class="modal-title">
                        Сверка ИНН с базой Налогового комитета!
                    </h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    {!! Form::submit("Данные совпадают", ['class' => 'btn btn-success ','form'=>'form-category', "id"=>"btn-accept"]) !!}
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Данные не совпадает</button>
                </div>
            </div>
        </div>
    </div>
@endif

<style>
    .bd-example-modal-lg .modal-dialog{
        display: table;
        position: relative;
        margin: 0 auto;
        top: calc(50% - 24px);
    }

    .bd-example-modal-lg .modal-dialog .modal-content{
        background-color: transparent;
        border: none;
    }

    .modal.in {
        z-index: 2000 !important;
    }

</style>