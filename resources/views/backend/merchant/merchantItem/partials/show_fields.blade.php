<!-- code Field -->
<div class="form-group">
    {!! Form::label('id', trans('merchantItem.backend.id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $merchantItem->id }}</p>
	</div>
</div>

<!-- name Field -->
<div class="form-group">
	{!! Form::label('name', trans('merchantItem.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $merchantItem->name }}</p>
	</div>
</div>

<!-- params_json Field -->
<div class="form-group">
	{!! Form::label('merchant_id', trans('merchantItem.backend.merchant_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $merchantItem->merchant->name ?? ''}}</p>
	</div>
</div>

{{--<div class="form-group">--}}
	{{--{!! Form::label('account_number', trans('merchantItem.backend.account_number').':', ['class' => 'control-label col-sm-2']) !!}--}}
	{{--<div class='col-sm-9'>--}}
		{{--<p class="form-control-static">{{ $merchantItem->account_number }}</p>--}}
	{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
	{{--{!! Form::label('account_id', trans('merchantItem.backend.account_id').':', ['class' => 'control-label col-sm-2']) !!}--}}
	{{--<div class='col-sm-9'>--}}
		{{--<p class="form-control-static">{{ $merchantItem->account->number ?? '' }}</p>--}}
	{{--</div>--}}
{{--</div>--}}

<div class="form-group">
	{!! Form::label('phone', trans('merchantItem.backend.phone').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $merchantItem->phone }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('email', trans('merchantItem.backend.email').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $merchantItem->email }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('address', trans('merchantItem.backend.address').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $merchantItem->address }}</p>
	</div>
</div>

<!-- is_active Field -->
<div class="form-group">
	{!! Form::label('is_active', trans('merchantItem.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$merchantItem->is_active) }}</p>
	</div>
</div>

<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('merchantItem.backend.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $merchantItem->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('merchantItem.backend.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $merchantItem->updated_at }}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('updated_at', trans('merchantItem.backend.qr_code_text').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $qr_code_base64 }}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('updated_at', trans('merchantItem.backend.qr_code_photo').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<img src="data:image/svg+xml;base64, {!! $qr_photo_base64 !!} ">
		<a download="data:image/svg+xml;base64, {!! $qr_photo_base64 !!}"
		   href="data:image/svg+xml;base64, {!! $qr_photo_base64 !!}" title="Qr code">Скачать</a>
	</div>
</div>