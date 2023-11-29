<div class="panel-body box-primary">
	<h3>Информация о пользователе</h3>
	<div class="col-md-12" style="margin-top:10px">
		<table class="table">
			<tr>
				<td>{{ trans("users.backend.table.last_login_at") }}</td>
				<td>{{$user->last_login_at}}</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.created_at") }}</td>
				<td>{!! $user->created_at !!}</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.updated_at") }}</td>
				<td>{!! $user->updated_at !!}</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.is_active") }}</td>
				<td>{!! trans('InterfaceTranses.is_active.'.(int)$user->is_active) !!}</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.user_settings_json") }}</td>
				<td>{!! json_encode($user->user_settings_json) !!}</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.description") }}</td>
				<td>{!! $user->description !!}</td>
			</tr>
		</table>
	</div>
	<div class="text-right panel-body">
		@if($block_result === false)
			@if(Auth::user()->ability('sadmin','user-lock-manage'))
				{{-- LOCK--}}
				<a type="submit" class="btn btn " style="background: #26C6DA; color:#FFFFFF" href="{!! route('admin.users.block', [$user->id]) !!}"
				   onclick="return confirm('{{ trans('alerts.general.confirm_block') }}')">
					Блокировать
				</a>
			@endif
		@else
			@if(Auth::user()->ability('sadmin','user-unlock-manage'))
				{{-- UNLOCK--}}
				<a type="submit" class="btn" style="background: #26C6DA" href="{!! route('admin.users.unlock', [$user->id]) !!}"
				   onclick="return confirm('{{ trans('alerts.general.confirm_unlock') }}')">
					Разблокировать
				</a>
			@endif
		@endif
		@if($user->email != '')
			{{-- DELETE EMAIL--}}
			@if(Auth::user()->ability('sadmin','user-delete-email'))
				<a type="submit" class="btn" style="background: #26C6DA; color:#FFFFFF; margin-left: 8px"
				   href="{!! route('admin.users.deleteEmail', [$user->id]) !!}"
				   onclick="return confirm('{{ trans('alerts.general.confirm_delete') }}')">
					Удалить Email
				</a>
			@endif
		@endif
		


	</div>
</div>

