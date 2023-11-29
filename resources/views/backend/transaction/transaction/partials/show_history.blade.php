		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="">
				<th>{{ trans('transactionHistory.backend.table.from_account_id') }}</th>
				<th>{{ trans('transactionHistory.backend.table.created_at') }}</th>
				<th>{{ trans('transactionHistory.backend.table.updated_at') }}</th>
				<th>{{ trans('transactionHistory.backend.table.params_json') }}</th>
				<th>{{ trans('transactionHistory.backend.table.service_id') }}</th>
				<th>{{ trans('transactionHistory.backend.table.amount') }}</th>
				<th>{{ trans('transactionHistory.backend.table.commission') }}</th>
				<th>{{ trans('transactionHistory.backend.table.currency_rate_value') }}</th>
				<th>{{ trans('transactionHistory.backend.table.currency_iso_name') }}</th>
				<th>{{ trans('transactionHistory.backend.table.transaction_status_id') }}</th>
				<th>{{ trans('transactionHistory.backend.table.transaction_status_detail_id') }}</th>
				<th>{{ trans('transactionHistory.backend.table.session_number') }}</th>
				<th>{{ trans('transactionHistory.backend.table.transaction_type_id') }}</th>
				<th>{{ trans('transactionHistory.backend.table.created_by_user_id') }}</th>
				<th>{{ trans('transactionHistory.backend.table.comment') }}</th>
				<th>{{ trans('transactionHistory.backend.table.account_balance') }}</th>
				</thead>
				<tbody>
				@foreach($transactionHistories as $item)
					<tr>
						<td>{{ $item->from_account_without_g_scopes->user->msisdn ?? null }}</td>
						<td>{{ $item->created_at}}</td>
						<td>{{ $item->updated_at}}</td>
						<td> <div class="{{ $item->params_json==null ?: 'json-params' }}">{{ json_encode($item->params_json, JSON_UNESCAPED_UNICODE) }}</div></td>
						<td>{{ $item->service->name}}</td>
						<td>{{ $item->amount}}</td>
						<td>{{ $item->commission}}</td>
						<td>{{ $item->currency_rate_value}}</td>
						<td>{{ $item->currency_iso_name}}</td>
						<td>{{ $item->TransactionStatus->name}}</td>
						<td>{{ $item->TransactionStatusDetail->name}}</td>
						<td>{{ $item->session_number}}</td>
						<td>{{ $item->TransactionType->name}}</td>

						<td>{{ $item->CreatedUser->msisdn??''}}</td>

						<td>{{ $item->comment}}</td>
						<td>{{ $item->account_balance}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
