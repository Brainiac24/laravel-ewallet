<div class="panel-body box-primary">
	<div class="col-md-12 text-center">
		<img src="{{$user->photo??"http://www.appmat.ru/wp-content/uploads/2015/07/no-avatar.jpg"}}"
			 width="100" height="100" style="border-radius: 100%">
	</div>
	<div class="col-md-12" style="margin-top:10px">

		<table class="table">
			<tr>
				<td>{{ trans("users.backend.table.id") }}</td>
				<td>{{$user->id}}</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.username") }}</td>
				<td>{{$user->username}}</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.roles") }}</td>
				<td>@foreach($user->roles as $role){{$role->display_name}};@endforeach,</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.branches") }}</td>
				<td>@foreach($user->branches as $branch){{$branch->name}}<br>@endforeach</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.first_name") }}</td>
				<td>{!! $user->first_name !!}</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.middle_name") }}</td>
				<td>{!! $user->middle_name !!}</td>
			</tr>
			<tr>
				<td>{{ trans("users.backend.table.last_name") }}</td>
				<td>{!! $user->last_name !!}</td>
			</tr>
			<tr>
				<td>{{ trans("client.backend.table.email") }}</td>
				<td>{!! $user->email !!}</td>
			</tr>

		</table>
	</div>
	<div class="row margin-bottom">
		<div class="btn-group col-md-4 margin-bottom" role="group" aria-label="...">
			<a href="{!! $user->id !!}/edit" class="btn btn-default btn-primary col-md-12 " style="" >Редактировать</a>
		</div>
	</div>
</div>

