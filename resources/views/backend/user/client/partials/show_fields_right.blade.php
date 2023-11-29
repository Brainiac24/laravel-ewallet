<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" >
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    Информация
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <table class="table" style="word-break: break-word">
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.is_active") }}</td>
                        @if($client->is_active===false)
                        <td class="col-md-8" style="color:red">{{ 'Блокирован' }}</td>
                        @else
                        <td class="col-md-8" style="color:green">{{ 'Активный' }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.is_auth") }}</td>
                        @if($client->is_auth===false)
                        <td style="color:red">{{ $client->is_auth===false ? 'Неавторизован' : 'Авторизован' }}</td>
                        @else
                        <td style="color:green">{{ $client->is_auth===false ? 'Неавторизован' : 'Авторизован' }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.created_at") }}</td>
                        <td>{{ empty($client->created_at)?'':\Carbon\Carbon::parse($client->created_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.balance") }}</td>
                        <td>
                            <span class="label-danger"
                                style="padding: 8px 16px;border-radius: 4px;">{{ !empty($account->balance_all)?number_format($account->balance_all,2,',',''):"НЕТ СЧЕТА" }}
                                {{$account->currency->iso_name??null}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.balance_amount") }}</td>
                        <td>
                            <span
                                style="padding: 8px 16px;border-radius: 4px; background-color: #dfe4ea;">{{ !empty($account->balance)?number_format($account->balance,2,',',''):"НЕТ СЧЕТА" }}
                                {{$account->currency->iso_name??null}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.balance_blocked") }}</td>
                        <td>
                            <span class="label-default"
                                style="padding: 8px 16px;border-radius: 4px; background-color: #dfe4ea;">{{ !empty($account->blocked_balance)?number_format($account->blocked_balance,2,',',''):"НЕТ СЧЕТА" }}
                                {{$account->currency->iso_name??null}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.attestation") }}</td>
                        <td>{{ $client->attestation->name }}
                            @if(in_array($client->verification_params_json['is_verified'],[2]))
                            <br>(Ожидание подтверждения)
                            @endif
                            @if(isset($client->verification_params_json['is_verified']) &&
                            in_array($client->verification_params_json['is_verified'],[0]))
                            <br>(Отменено со стороны абонента)
                            @endif
                            @if(isset($client->verification_params_json['is_verified']) &&
                            in_array($client->verification_params_json['is_verified'],[1]))
                            <br>(Подтверждено со стороны абонента)
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.code_map") }}</td>
                        <td>
                            @if(!empty($client->code_map))
                            @if(Auth::user()->ability('','client-deleteCodeMap'))
                            {!! Form::model($client, ['route' => ['admin.clients.deleteCodeMap', $client->id], 'method'
                            => 'patch','class'=>'form-horizontal','id'=>'form-code-map']) !!}

                            <div class='col-sm-5'>
                                {!! Form::text('code_map', null, ['class' => 'form-control','readonly']) !!}
                            </div>
                            <div class='col-sm-4'>
                                {!! Form::submit(trans('actions.general.delete'), ['class' => 'btn
                                btn-danger','form'=>'form-code-map']) !!}
                            </div>
                            @else
                            <div class='col-sm-5'>
                                {!! Form::text('code_map', $client->code_map, ['class' => 'form-control','readonly'])
                                !!}
                            </div>
                            @endif
                            @else
                            @if(Auth::user()->ability('','client-addCodeMap'))
                            {!! Form::model($client, ['route' => ['admin.clients.addCodeMap', $client->id], 'method' =>
                            'patch','class'=>'form-horizontal','id'=>'form-code-map']) !!}

                            <div class='col-sm-5'>
                                {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class='col-sm-4'>
                                {!! Form::submit(trans('actions.general.save'), ['class' => 'btn
                                btn-primary','form'=>'form-code-map']) !!}
                            </div>
                            @else
                            <div class='col-sm-5'>
                                {!! Form::text('code_map', $client->code_map, ['class' => 'form-control','readonly'])
                                !!}
                            </div>
                            @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.card_last_sync_at") }}</td>
                        <td>{{ empty($client->card_last_sync_at)?'':\Carbon\Carbon::parse($client->card_last_sync_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.account_last_sync_at") }}</td>
                        <td>{{ empty($client->account_last_sync_at)?'':\Carbon\Carbon::parse($client->account_last_sync_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.credit_last_sync_at") }}</td>
                        <td>{{ empty($client->credit_last_sync_at)?'':\Carbon\Carbon::parse($client->credit_last_sync_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.deposit_last_sync_at") }}</td>
                        <td>{{ empty($client->deposit_last_sync_at)?'':\Carbon\Carbon::parse($client->deposit_last_sync_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.card_last_update_balance_sync_at") }}</td>
                        <td>{{ empty($client->card_last_update_balance_sync_at)?'':\Carbon\Carbon::parse($client->card_last_update_balance_sync_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>

                    
                    <tr>
                        <td class="col-md-4"><b>{{ trans("client.backend.table.auth_title") }}</b></td>
                        <td class="col-md-8"></td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.updated_at") }}</td>
                        <td class="col-md-8">{{ empty($client->updated_at)?'':\Carbon\Carbon::parse($client->updated_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.blocked_at") }}</td>
                        <td class="col-md-8">{{ empty($client->blocked_at)?'':\Carbon\Carbon::parse($client->blocked_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.unblock_at") }}</td>
                        <td class="col-md-8">{{ empty($client->unblock_at)?'':\Carbon\Carbon::parse($client->unblock_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.last_login_at") }}</td>
                        <td class="col-md-8">{{ empty($client->last_login_at)?'':\Carbon\Carbon::parse($client->last_login_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans("client.backend.table.ip") }}</td>
                        <td>{{ $client->ip }}</td>
                    </tr>


                </table>
                <div class="text-right panel-body">
                    @if($client->password_params_json!=null)
                    @if(Auth::user()->can('client-resetPassword'))
                    <a type="submit" class="btn" style="color: white; background: #1b6d85"
                        href="{!! route('admin.clients.resetPassword', [$client->id]) !!}"
                        onclick="return confirm('{{ trans('alerts.general.confirm_reset_password') }}')">
                        Сбросить пароль и секретное слово
                    </a>
                    @endif
                    @endif

                    @if($client->verification_params_json['is_verified']==1)
                        @if(Auth::user()->can('client-deleteCodeMap'))
                    <a type="submit" class="btn" style="color: white; background: #1c67e1"
                        href="{!! route('admin.clients.resetIdentification', [$client->id]) !!}"
                        onclick="return confirm('{{ trans('alerts.general.confirm_reset_identification') }}')">
                        Сбросить идентификацию
                    </a>
                    @endif
                    @endif
                
                    @if($block_result === false)
                    @if(Auth::user()->ability('sadmin','client-lock-manage'))
                    {{-- LOCK--}}
                    <a type="submit" class="btn btn " style="background: #da2626; color:#FFFFFF"
                        href="{!! route('admin.clients.block', [$client->id]) !!}"
                        onclick="return confirm('{{ trans('alerts.general.confirm_block') }}')">
                        Блокировать
                    </a>
                    @endif
                    @else
                    @if(Auth::user()->ability('sadmin','client-unlock-manage'))
                    {{-- UNLOCK--}}
                    <a type="submit" class="btn" style="background: #00aa4f; color:#FFFFFF" href="{!! route('admin.clients.unlock', [$client->id]) !!}"
                        onclick="return confirm('{{ trans('alerts.general.confirm_unlock') }}')">
                        Разблокировать
                    </a>
                    @endif
                    @endif
                    @if($client->email != '')
                    {{-- DELETE EMAIL--}}
                    @if(Auth::user()->ability('sadmin','client-delete-email'))
                    <a type="submit" class="btn" style="background: #26C6DA; color:#FFFFFF; margin-left: 8px"
                        href="{!! route('admin.clients.deleteEmail', [$client->id]) !!}"
                        onclick="return confirm('{{ trans('alerts.general.confirm_delete') }}')">
                        Удалить Email
                    </a>
                    @endif
                    @endif
                    @if($client->pin_params_json != null)
                        {{-- DELETE PIN--}}
                        @if(Auth::user()->ability('sadmin','client-delete-pin'))
                            <a type="submit" class="btn" style="background: #da2626; color:#FFFFFF; margin-left: 8px"
                                href="{!! route('admin.clients.deletePin', [$client->id]) !!}"
                                onclick="return confirm('{{ trans('alerts.general.confirm_delete_pin') }}')">
                                Удалить ПИН код
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    {{ trans("client.backend.table.system_data") }}
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <table class="table" style="word-break: break-word">
                    
                    <tr>
                        <td class="col-md-4"><b>{{trans("client.backend.table.qr")}}</b></td>
                        <td class="col-md-8"></td>
                    </tr>
                    <tr>
                        <td class="col-md-4">
                            {!! Form::label('value', trans("client.backend.table.qr_code"), ['class' =>
                            'control-label']) !!}
                        </td>
                        <td class="col-md-8">{{ $qr_code_base64 }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">
                            {!! Form::label('value', trans("client.backend.table.qr_photo"), ['class' =>
                            'control-label']) !!}
                        </td>
                        <td class="col-md-8">
                            <img src="data:image/svg+xml;base64, {!! $qr_photo_base64 !!} ">
                            <a download="data:image/svg+xml;base64, {!! $qr_photo_base64 !!}"
                                href="data:image/svg+xml;base64, {!! $qr_photo_base64 !!}" title="Qr code">Скачать</a>
                        </td>
                    </tr>
                    

                <tr>
                    <td>{{ trans("client.backend.table.settings") }}</td>
                    <td>
                        <div class="{{ $client->user_settings_json==null ?: 'json-params-uncollapsed' }}">
                            {{ json_encode($client->user_settings_json, JSON_UNESCAPED_UNICODE) }}</div>
                    </td>
                </tr>
                <tr>
                    <td>{{ trans("client.backend.table.device") }}</td>
                    <td>
                        <div class="{{ $client->devices_json==null ?: 'json-params-uncollapsed' }}">
                            {{ json_encode($client->devices_json, JSON_UNESCAPED_UNICODE) }}</div>
                    </td>
                </tr>
                <tr>
                    <td>{{ trans("client.backend.table.verification") }}</td>
                    <td>
                        <div class="{{ $client->verification_params_json==null ?: 'json-params-uncollapsed' }}">
                            {{ json_encode($client->verification_params_json, JSON_UNESCAPED_UNICODE) }}</div>
                    </td>
                </tr>
                </table>
                
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true"
                    aria-controls="collapseThree">
                    {{ trans("client.backend.table.user_session_data") }}
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                <table class="table" style="word-break: break-word">
                    
                    @foreach ($client->user_session as $session)
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.user_session_platform") }}</td>
                        <td class="col-md-8">
                            @if ($session->platform===0)
                            {{'IOS'}}
                            @elseif ($session->platform===1)
                            {{'ANDROID'}}
                            @elseif ($session->platform===2)
                            {{'WEB'}}
                            @else
                            {{'ERROR PLATFORM'}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.user_session_device_code") }}</td>
                        <td class="col-md-8">{{ $session->device_code ?? "" }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.user_session_device_params_json") }}</td>
                        <td class="col-md-8">
                            <p class="{{ $session->device_params_json==null ?: 'json-params' }}">
                                {{ json_encode($session->device_params_json, JSON_UNESCAPED_UNICODE) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.user_session_access_token_expires_at") }}</td>
                        <td class="col-md-8">{{ empty($session->access_token_expires_at)?'':\Carbon\Carbon::parse($session->access_token_expires_at ?? "")->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.user_session_refresh_token_expires_at") }}</td>
                        <td class="col-md-8">{{ empty($session->refresh_token_expires_at)?'':\Carbon\Carbon::parse($session->refresh_token_expires_at ?? "")->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.user_session_revoked_at") }}</td>
                        <td class="col-md-8">{{ empty($session->revoked_at)?'':\Carbon\Carbon::parse($session->revoked_at)->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">--------------</td>
                        <td class="col-md-8"></td>
                    </tr>

                    @endforeach

                
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFour">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true"
                    aria-controls="collapseOne">
                    Дополнительная информация
                </a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
            <div class="panel-body">
                <table class="table" style="word-break: break-word">
                    <tr>
                        <td class="col-md-4"><b>{{trans("client.backend.table.sms")}}</b></td>
                        <td class="col-md-8"></td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.sms_code_sent_at") }}</td>
                        <td class="col-md-8">{{ empty($client->sms_params_json['code_sent_at'])?'':\Carbon\Carbon::parse($client->sms_params_json['code_sent_at'])->format("d.m.Y H:i:s")}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.retry_send_code_try_count") }}</td>
                        <td class="col-md-8">{{ $client->sms_params_json['retry_send_code_try_count']??'' }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.failed_confirm_try_count") }}</td>
                        <td class="col-md-8">{{ $client->sms_params_json['failed_confirm_try_count']??'' }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.confirm_try_at") }}</td>
                        <td class="col-md-8">{{ empty($client->sms_params_json['confirm_try_at'])?'':\Carbon\Carbon::parse($client->sms_params_json['confirm_try_at'])->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.sms_whole_count") }}</td>
                        <td class="col-md-8">{{ $client->sms_params_json['code_sent_count']??'' }}</td>
                    </tr>
                    
                    <tr>
                        <td class="col-md-4"><b>{{ trans("client.backend.table.email") }}</b></td>
                        <td class="col-md-8"></td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.sms_code_sent_at") }}</td>
                        <td class="col-md-8">{{ empty($client->email_params_json['code_sent_at'])?'':\Carbon\Carbon::parse($client->email_params_json['code_sent_at'])->format("d.m.Y H:i:s")}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.failed_confirm_try_count") }}</td>
                        <td class="col-md-8">{{ $client->email_params_json['failed_confirm_try_count']??'' }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.sms_whole_count") }}</td>
                        <td class="col-md-8">{{ $client->email_params_json['code_sent_count']??'' }}</td>
                    </tr>

                    <tr>
                        <td class="col-md-4"><b>{{ trans("client.backend.table.pin") }}</b></td>
                        <td class="col-md-8"></td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.failed_confirm_try_at") }}</td>
                        <td class="col-md-8">{{ empty($client->pin_params_json['failed_confirm_try_at'])?'':\Carbon\Carbon::parse($client->pin_params_json['failed_confirm_try_at'])->format("d.m.Y H:i:s")}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.failed_confirm_try_count") }}</td>
                        <td class="col-md-8">{{ $client->pin_params_json['failed_confirm_try_count']??'' }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.change_failed_try_count") }}</td>
                        <td class="col-md-8">{{ $client->pin_params_json['change_failed_try_count']??'' }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.change_status_confirmed") }}</td>
                        <td class="col-md-8">{{ $client->pin_params_json['change_status_confirmed']??'' }}</td>
                    </tr>

                    <tr>
                        <td class="col-md-4"><b>{{ trans("client.backend.table.password") }}</b></td>
                        <td class="col-md-8"></td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.is_registered") }}</td>
                        <td class="col-md-8">{{ $client->password_params_json['is_registered']??''}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.failed_confirm_try_at") }}</td>
                        <td class="col-md-8">{{ empty($client->password_params_json['failed_confirm_try_at'])?'':\Carbon\Carbon::parse($client->password_params_json['failed_confirm_try_at'])->format("d.m.Y H:i:s")}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.failed_confirm_try_count") }}</td>
                        <td class="col-md-8">{{ $client->password_params_json['failed_confirm_try_count']??'' }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.failed_change_try_count") }}</td>
                        <td class="col-md-8">{{ $client->password_params_json['failed_change_try_count']??'' }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.failed_reset_try_count") }}</td>
                        <td class="col-md-8">{{ $client->password_params_json['failed_reset_try_count']??'' }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4">{{ trans("client.backend.table.failed_reset_try_at") }}</td>
                        <td class="col-md-8">{{ empty($client->password_params_json['failed_reset_try_at'])?'':\Carbon\Carbon::parse($client->password_params_json['failed_reset_try_at'])->format("d.m.Y H:i:s") }}</td>
                    </tr>
                    
            </table>
            </div>
        </div>
    </div>
</div>





</div>