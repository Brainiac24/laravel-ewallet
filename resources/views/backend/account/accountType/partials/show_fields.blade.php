<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('accountType.backend.table.code').':', ['class' => 'control-label col-sm-3']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $accountTypes->code }}</p>
	</div>
</div>
<!-- from_account_id Field -->
<div class="form-group">
	{!! Form::label('from_account_id', trans('accountType.backend.table.name').':', ['class' => 'control-label col-sm-3']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypes->name }}</p>
	</div>
</div>
<!-- to_account_id Field -->
<div class="form-group">
	{!! Form::label('to_account_id', trans('accountType.backend.table.gateway').':', ['class' => 'control-label col-sm-3']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypes->gateway->name }}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('params_json', trans('accountType.backend.table.params_json').':', ['class' => 'control-label col-sm-3']) !!}
	<div class='col-sm-8'>
		<p class="form-control-static">
            <span class="json-params">
                {{ json_encode($accountTypes->params_json, JSON_UNESCAPED_UNICODE) }}
            </span>
		</p>
	</div>
</div>
<!-- is_exclude_for_fill Field -->
<div class="form-group">
	{!! Form::label('is_exclude_for_fill', trans('accountType.backend.table.is_exclude_for_fill').':', ['class' => 'control-label col-sm-3']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.yesno')[$accountTypes->is_exclude_for_fill] }}</p>
	</div>
</div>

<!-- is_show_menu_block_unblock Field -->
<div class="form-group">
	{!! Form::label('is_show_menu_block_unblock', trans('accountType.backend.table.is_show_menu_block_unblock').':', ['class' => 'control-label col-sm-3']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.yesno')[$accountTypes->is_show_menu_block_unblock] }}</p>
	</div>
</div>
<!-- is_exclude_for_fill Field -->
<div class="form-group">
	{!! Form::label('is_autocheck_balance', trans('accountType.backend.table.is_autocheck_balance').':', ['class' => 'control-label col-sm-3']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.yesno')[$accountTypes->is_autocheck_balance] }}</p>
	</div>
</div>

<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('accountType.backend.table.created_at').':', ['class' => 'control-label col-sm-3']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypes->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('accountType.backend.table.updated_at').':', ['class' => 'control-label col-sm-3']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypes->updated_at }}</p>
	</div>
</div>