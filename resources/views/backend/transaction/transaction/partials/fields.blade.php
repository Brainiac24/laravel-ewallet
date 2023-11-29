<!-- id Field -->
<div class="form-group">
    {!! Form::label('id', trans('transaction.backend.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('id', $transaction->id, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('transaction_type', trans('transaction.backend.transaction_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('transaction_type' , $transaction->transaction_type->name ?? null, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_account_id', trans('transaction.backend.from_account_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>

        {!! Form::text('from_account_id' , ($transaction->from_account_without_g_scopes!=null &&
    $transaction->from_account_without_g_scopes->account_type!=null &&
    $transaction->from_account_without_g_scopes->account_type->account_category_type != null) ?
    ($transaction->from_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
    $transaction->from_account_without_g_scopes->user->msisdn :
    $transaction->from_account_without_g_scopes->number) : $transaction->service->name, ['class' => 'form-control','readonly' => 'true']) !!}

    </div>
</div>

<div class="form-group">
    {!! Form::label('from_gateway', trans('transaction.backend.from_gateway').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('from_gateway' , $transaction->from_account_without_g_scopes->account_type->gateway->name ?? $transaction->service->gateway->name, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('to_account_id', trans('transaction.backend.to_account_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>

        {!! Form::text('to_account_id' , ($transaction->to_account_without_g_scopes!=null &&
    $transaction->to_account_without_g_scopes->account_type!=null &&
    $transaction->to_account_without_g_scopes->account_type->account_category_type != null) ?
    ($transaction->to_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
    $transaction->to_account_without_g_scopes->user->msisdn :
    $transaction->to_account_without_g_scopes->number) : $transaction->service->name, ['class' => 'form-control','readonly' => 'true']) !!}

    </div>
</div>

<div class="form-group">
    {!! Form::label('to_gateway', trans('transaction.backend.to_gateway').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('to_gateway' , ($transaction->to_account_without_g_scopes!=null &&
			 $transaction->to_account_without_g_scopes->account_type !=null &&
			 $transaction->to_account_without_g_scopes->account_type->gateway!=null) ?
			 $transaction->to_account_without_g_scopes->account_type->gateway->name : $transaction->service->gateway->name, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('service_id', trans('transaction.backend.service_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('service_id' , $transaction->service->name ?? null, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('params_json', trans('transaction.backend.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <span class="json-params">{{ json_encode($transaction->params_json, JSON_UNESCAPED_UNICODE) }}</span>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('transaction.backend.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('created_at' , $transaction->created_at, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('sms_confirm_try_at', trans('transaction.backend.sms_confirm_try_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('sms_confirm_try_at' , $transaction->confirmed_at ??  $transaction->sms_confirm_try_at, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('finished_at', trans('transaction.backend.finished_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('finished_at' , $transaction->finished_at, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('amount', trans('transaction.backend.amount').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('amount' , $transaction->amount, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('commission', trans('transaction.backend.commission').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('commission' , $transaction->commission, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('currency_rate_value', trans('transaction.backend.currency_rate_value').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('currency_rate_value' , $transaction->currency_rate_value, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('currency_iso_name', trans('transaction.backend.currency_iso_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('currency_iso_name' , $transaction->currency_iso_name, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_currency_iso_name', trans('transaction.backend.from_currency_iso_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('from_currency_iso_name' , $transaction->from_currency_iso_name, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('to_currency_iso_name', trans('transaction.backend.to_currency_iso_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('to_currency_iso_name' , $transaction->to_currency_iso_name, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('converted_amount', trans('transaction.backend.converted_amount').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('converted_amount' , $transaction->converted_amount, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('process_payload_json', trans('transaction.backend.process_payload_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        	<span class="json-params">{{ json_encode($transaction->process_payload_json, JSON_UNESCAPED_UNICODE) }}</span>
    </div>
</div>

<div class="form-group">
    {!! Form::label('transaction_status_detail_id', trans('transaction.backend.transaction_status_detail_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('transaction_status_detail_id' , $transaction->transaction_status_detail->name ?? "", ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('session_number', trans('transaction.backend.session_number').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('session_number' , $transaction->session_number ?? "", ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('account_balance', trans('transaction.backend.account_balance').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('account_balance' , $transaction->account_balance, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('session_in', trans('transaction.backend.session_in').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('session_in' , $transaction->session_in, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('created_by_user_id', trans('transaction.backend.created_by_user_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('created_by_user_id' , $transaction->user->msisdn ?? "", ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('add_to_favorite', trans('transaction.backend.add_to_favorite').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('add_to_favorite' , trans('InterfaceTranses.add_to_favorite.'.$transaction->add_to_favorite), ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_queued', trans('transaction.backend.is_queued').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('is_queued_text' , trans('InterfaceTranses.is_queied.'.$transaction->is_queued), ['class' => 'form-control','readonly' => 'true']) !!}
        {!! Form::hidden('is_queued' , $transaction->is_queued, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('sms_code_sent_at', trans('transaction.backend.sms_code_sent_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('sms_code_sent_at' , $transaction->sms_code_sent_at ?? "", ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('cache_json', trans('transaction.backend.cache_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
      	<span class="json-params">
				{{ json_encode($transaction->cache_json, JSON_UNESCAPED_UNICODE) }}
			</span>
    </div>
</div>


<div class="form-group">
    {!! Form::label('transaction_status', trans('transaction.backend.transaction_current_status').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('transaction_status' , $transaction->transaction_status->name, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('message_description', 'Описание процесса', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9 text-danger' id="continue_rule_message" style="padding-top: 7px;">
        {!! $message !!}
    </div>
</div>

{{--@if($transaction->transaction_status_id != App\Services\Common\Helpers\TransactionStatus::COMPLETED)--}}
{{--    <hr>--}}
{{--    <div class="form-group">--}}
{{--        {!! Form::label('transaction_status_id', trans('transaction.backend.transaction_status_id').':', ['class' => 'control-label col-sm-2']) !!}--}}
{{--        <div class='col-sm-9'>--}}
{{--            <div class="col-sm-3">--}}
{{--                {!! Form::select('transaction_status_id', $transactionStatuses, null, ['class'=>'form-control']) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        {!! Form::label('comment', trans('transaction.backend.comment').':', ['class' => 'control-label col-sm-2']) !!}--}}
{{--        <div class='col-sm-9'>--}}
{{--            {!! Form::textarea('comment', $transaction->comment, ['class' => 'form-control']) !!}--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        {!! Form::label('send_to_processing', trans('transaction.backend.send_to_processing').':', ['class' => 'control-label col-sm-2']) !!}--}}
{{--        <div class='col-sm-9'>--}}
{{--            {!! Form::hidden('send_to_processing', 0, ['class' => 'form-control']) !!}--}}
{{--            {!! Form::checkbox('send_to_processing', null, false) !!}--}}

{{--        </div>--}}
{{--        <div class='col-sm-8'>--}}
{{--            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn btn-primary btn-margin-top-10','form'=>'form-category',  'onclick'=>"return confirm('". trans('alerts.general.confirm_changed_transaction_status')."')"]) !!}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}

@if($transaction->transaction_status_id == App\Services\Common\Helpers\TransactionStatus::COMPLETED && $transaction->service_id == App\Services\Common\Helpers\Service::MERCHANT)
    <div class="form-group">
        {!! Form::label('comment', trans('transaction.backend.comment').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            {!! Form::textarea('comment', $transaction->comment, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('send_to_processing', trans('transaction.backend.send_to_processing').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            {!! Form::hidden('send_to_processing', 0, ['class' => 'form-control']) !!}
            {!! Form::checkbox('send_to_processing', null, false) !!}

        </div>
        <div class='col-sm-8'>
            {!! Form::hidden('transaction_status_id', '1d001ec2-867b-11e8-90c7-b06ebfbfa715', ['class' => 'form-control']) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn btn-primary btn-margin-top-10','form'=>'form-category',  'onclick'=>"return confirm('". trans('alerts.general.confirm_changed_transaction_status')."')"]) !!}
        </div>
    </div>
@elseif(count($transactionStatuses)>0)
    <hr>
    <div class="form-group">
        {!! Form::label('transaction_status_id', trans('transaction.backend.transaction_status_to').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <div class="col-sm-3">
                {!! Form::select('transaction_status_id', $transactionStatuses, null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('comment', trans('transaction.backend.comment').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            {!! Form::textarea('comment', $transaction->comment, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('send_to_processing', trans('transaction.backend.send_to_processing').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            {!! Form::hidden('send_to_processing', 0, ['class' => 'form-control']) !!}
            {!! Form::checkbox('send_to_processing', null, false) !!}

        </div>
        <div class='col-sm-8'>
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn btn-primary btn-margin-top-10','form'=>'form-category',  'onclick'=>"return confirm('". trans('alerts.general.confirm_changed_transaction_status')."')"]) !!}
        </div>
    </div>
@endif
