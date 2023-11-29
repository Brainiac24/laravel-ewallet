<div class="table-responsive">
    <table class="table table-bordered table-hover ">
        <thead >
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>
        <th>{{ trans('service.backend.table.name') }}</th>
        <th>{{ trans('service.backend.table.code') }}</th>
        <th>{{ trans('service.backend.table.processing_code') }}</th>
        <th>{{ trans('service.backend.table.icon_url') }}</th>
        <th>{{ trans('service.backend.table.params_json') }}</th>
        <th>{{ trans('service.backend.table.min_amount') }}</th>
        <th>{{ trans('service.backend.table.max_amount') }}</th>
        <th>{{ trans('service.backend.table.is_active') }}</th>
        <th>{{ trans('service.backend.table.requestable_balance_params') }}</th>
        <th>{{ trans('service.backend.table.is_to_accountable') }}</th>
        <th>{{ trans('service.backend.table.position') }}</th>
        <th>{{ trans('service.backend.table.service_limit_name') }}</th>
        <th>{{ trans('service.backend.table.gateway_name') }}</th>
        <th>{{ trans('service.backend.table.workday_name') }}</th>
        <th>{{ trans('service.backend.table.commission_name') }}</th>
        <th>{{ trans('service.backend.table.currency_iso_name') }}</th>
        <th>{{ trans('service.backend.table.created_at') }}</th>
        <th>{{ trans('service.backend.table.updated_at') }}</th>
        <th class="col-xs-1">{{ trans('actions.general.action') }}</th>
        </thead>
        <tbody>
            @foreach($service as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{  link_to(route('admin.services.show', [$item->id]), $item->name) }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->processing_code }}</td>
                <td><img src="{{ \App\Services\Common\Helpers\Helper::asset().config('app_settings.service_icons_url_host').'/hdpi/'.$item->icon_url }}" alt=""></td>
                <td><div  class="json-params">{{ json_encode($item->params_json, JSON_UNESCAPED_UNICODE) }}</div></td>
                <td>{{ $item->min_amount }}</td>
                <td>{{ $item->max_amount }}</td>
                <td>{{ $item->is_active }}</td>
                <td>{{ $item->requestable_balance_params }}</td>
                <td>{{ $item->is_to_accountable }}</td>
                <td>{{ $item->position }}</td>
                <td>{{ $item->service_limit->name??null }}</td>
                <td>{{ $item->gateway->name }}</td>
                <td>{{ $item->workday->name??null }}</td>
                <td>{{ $item->commission->name??null }}</td>
                <td>{{ $item->currency->iso_name??null}}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td class="text-center">
                        {{-- @if(Auth::user()->ability('sadmin','role-operation-edit')) --}}

                            <a class="btn btn-primary btn-xs" href="{!! route('admin.services.edit', [$item->id]) !!}"><i class="fa fa-pencil"></i></a>
                        {{-- @endif --}}
                        {{-- @if(Auth::user()->ability('sadmin','role-operation-delete')) --}}
                            <a class="btn btn-danger btn-xs" href="{!! route('admin.service.delete', [$item->id]) !!}" onclick="return confirm('{{ trans('alerts.general.confirm_delete') }}')"><i class="fa fa-trash-o"></i></a>
                        {{-- @endif --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>