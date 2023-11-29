<!-- id Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->id }}</p>
	</div>
</div>
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static"></p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static"><a
					href="{{route('admin.jobLog.index')}}?search=Поиск&transaction_id={{$transaction->id}}&created_by_user_ids[]={{ $transaction->created_by_user_id }}&created_by_user_ids[]={{ config('app_settings.system_user_id') }}"
					target="_blank"> Перейти в Журнал задач</a></p>
	</div>
</div>
<div class="row r-hov-1">
	<div class='col-sm-12'>
		<p class="form-control-static" style="font-size: 16px;"><b>- Дата -</b></p>
	</div>
</div>
<!-- created_at Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.created_at').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ empty($transaction->created_at)?null:\Carbon\Carbon::parse($transaction->created_at)->format("d.m.Y H:i:s") }}</p>
	</div>
</div>
<!-- sms_code_sent_at Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.sms_code_sent_at').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ empty($transaction->sms_code_sent_at)?null:\Carbon\Carbon::parse($transaction->sms_code_sent_at)->format("d.m.Y H:i:s") }}</p>
	</div>
</div>
<!-- sms_confirm_try_at Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.sms_confirm_try_at').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ empty($transaction->confirmed_at ?? $transaction->sms_confirm_try_at)?null:\Carbon\Carbon::parse($transaction->confirmed_at ?? $transaction->sms_confirm_try_at)->format("d.m.Y H:i:s") }}</p>
	</div>
</div>
<!-- finished_at Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.finished_at').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ empty($transaction->finished_at)?null:\Carbon\Carbon::parse($transaction->finished_at)->format("d.m.Y H:i:s") }}</p>
	</div>
</div>
<div class="row r-hov-1">
	<div class='col-sm-12'>
		<p class="form-control-static" style="font-size: 16px;"><b>- Транзакция -</b></p>
	</div>
</div>
<!-- transaction_type_id Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.transaction_type_id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->transaction_type->name }}</p>
	</div>
</div>

<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.from_gateway').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">
			{{$transaction->from_account_without_g_scopes->account_type->gateway->name ?? $transaction->service->gateway->name }}
		</p>
	</div>
</div>
<!-- from_account_id Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.from_account_id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ ($transaction->from_account_without_g_scopes!=null &&
    $transaction->from_account_without_g_scopes->account_type!=null &&
    $transaction->from_account_without_g_scopes->account_type->account_category_type != null) ?
    ($transaction->from_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
    $transaction->from_account_without_g_scopes->user->msisdn :
    $transaction->from_account_without_g_scopes->number) : $transaction->service->name }}</p>
	</div>
</div>


<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.to_gateway').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">
			{{
			($transaction->to_account_without_g_scopes!=null &&
			 $transaction->to_account_without_g_scopes->account_type !=null &&
			 $transaction->to_account_without_g_scopes->account_type->gateway!=null) ?
			 $transaction->to_account_without_g_scopes->account_type->gateway->name : $transaction->service->gateway->name
			}}
		</p>
	</div>
</div>

<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.to_account_id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ ($transaction->to_account_without_g_scopes!=null &&
    $transaction->to_account_without_g_scopes->account_type!=null &&
    $transaction->to_account_without_g_scopes->account_type->account_category_type != null) ?
    ($transaction->to_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
    $transaction->to_account_without_g_scopes->user->msisdn :
    $transaction->to_account_without_g_scopes->number) : $transaction->service->name  }}</p>
	</div>
</div>

<!-- service_id Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.service_id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->service->name }}</p>
	</div>
</div>
<!-- params_json Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.params_json').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<div class="form-control-static">
			<span class="json-params">{{ json_encode($transaction->params_json, JSON_UNESCAPED_UNICODE) }}
			</span>
		</div>
	</div>
</div>


<!-- amount Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.amount').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ number_format($transaction->amount,2, '.', '') .' '. $transaction->from_currency_iso_name }}</p>
	</div>
</div>
<!-- currency_rate_value Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.currency_rate_value').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ number_format($transaction->currency_rate_value,4, '.', '') }}</p>
	</div>
</div>

<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.converted_amount').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ number_format($transaction->converted_amount,2, '.', '') .' '. $transaction->to_currency_iso_name }}</p>
	</div>
</div>


<!-- amount_all Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.commission').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ number_format($transaction->commission,2, '.', '') }}</p>
	</div>
</div>


<!-- transaction_status_id Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.transaction_status_id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->transaction_status->name }}</p>
	</div>
</div>

<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.transaction_sync_status_id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->transaction_sync_status->name ?? ""  }}</p>
	</div>
</div>

<!-- transaction_status_detail_id Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.transaction_status_detail_id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->transaction_status_detail->name }}</p>
	</div>
</div>
<div class="row r-hov-1">
	<div class='col-sm-12'>
		<p class="form-control-static" style="font-size: 16px;"><b>- Дополнительная информация -</b></p>
	</div>
</div>

<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.process_payload_json').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">
			<span class="json-params">
				{{ json_encode($transaction->process_payload_json, JSON_UNESCAPED_UNICODE)}}
			</span>
		</p>
	</div>
</div>
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.user_service_limit_json').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">
			<span class="json-params">
				{{ json_encode($transaction->user_service_limit_json, JSON_UNESCAPED_UNICODE)}}
			</span>
		</p>
	</div>
</div>
<!-- session_number Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.session_number').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->session_number }}</p>
	</div>
</div>
<!-- account_balance Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.account_balance').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ number_format($transaction->account_balance,2, '.', '') }}</p>
	</div>
</div>
<!-- comment Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.comment').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->comment }}</p>
	</div>
</div>
<!-- session_number Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.session_in').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->session_in }}</p>
	</div>
</div>
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.order_id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->order_id }}</p>
	</div>
</div>
<!-- created_by_user_id Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.created_by_user_id').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transaction->user->msisdn??''}}</p>
	</div>
</div>

<!-- to_account_id Field -->
<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.is_queued').':' !!}</p>
	</div>
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.is_queied.'.$transaction->is_queued) }}</p>
	</div>
</div>


<div class="row r-hov-1">
	<div class='col-sm-2'>
		<p class="form-control-static">{!! trans('transaction.backend.table.cache_json').':' !!}</p>
	</div>
	<div class='col-sm-8'>
		<p class="form-control-static">
			<span class="json-params">
				{{ json_encode($transaction->cache_json, JSON_UNESCAPED_UNICODE) }}
			</span>
		</p>
	</div>
</div>