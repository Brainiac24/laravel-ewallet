<!-- code Field -->
<div class="form-group">
	{!! Form::label('service_name', trans('menu.backend.table.service_name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $menu[0]['service_name'] }}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('category_name', trans('menu.backend.table.category_name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $menu[0]['category_name'] }}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('service_code', trans('menu.backend.table.service_code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $menu[0]['service_code'] }}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('service_processing_code', trans('menu.backend.table.service_processing_code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $menu[0]['service_processing_code'] }}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('position', trans('menu.backend.table.position').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $menu[0]['position'] }}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('service_icon_url', trans('menu.backend.table.service_icon_url').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static"><img src="{{ config('app_settings.service_icons_url_host').'/hdpi/'.$menu[0]['service_icon_url'] }}" alt=""></p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('service_is_active', trans('menu.backend.table.service_is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$menu[0]['service_is_active'] )}}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('service_updated_at', trans('menu.backend.table.service_updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $menu[0]['service_updated_at'] }}</p>
	</div>
</div>