@foreach($attestations as $item)
    {   recid: '{{$item['id']}}',
{{--    code: '<a href="{!! route('admin.attestations.edit', [$item['id']]) !!}">{{(string)$item['code'] }}</a>',--}}
    code: '{{(string)$item['code'] }}',
    name:'{{ $item['name']}}',
    day_limit:'{{ $item['params_json']['day']['limit']}}',
    week_limit:'{{ $item['params_json']['week']['limit']}}',
    month_limit:'{{ $item['params_json']['month']['limit']}}',
    balance_limit:'{{ $item['params_json']['balance']['limit']}}',
    updated_at:'{{ $item['updated_at']}}',
    created_at:'{{ $item['created_at']}}',

    @if ($item['id']===false)
        "w2ui": { "style": "color: red" },
    @endif
    @if ($item['id']===false)
        "w2ui": { "style": "background-color: #C2F5B4" }
    @endif

    },
@endforeach
{{--

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>
        <th>{{ trans('attestations.backend.table.code') }}</th>
        <th>{{ trans('attestations.backend.table.name') }}</th>
        <th>{{ trans('attestations.backend.table.day_limit') }}</th>
        <th>{{ trans('attestations.backend.table.week_limit') }}</th>
        <th>{{ trans('attestations.backend.table.month_limit') }}</th>
        <th>{{ trans('attestations.backend.table.balance') }}</th>
        <th>{{ trans('attestations.backend.table.created_at') }}</th>
        <th>{{ trans('attestations.backend.table.updated_at') }}</th>
        <th class="col-xs-1">{{ trans('actions.general.action') }}</th>
        </thead>
        <tbody>
            @foreach($attestations as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{ $item->code }}</td>
                <td>{{  link_to(route('admin.attestations.show', [$item->id]), $item->name) }}</td>
                <td>{{ $item->params_json['day']['limit'] }}</td>
                <td>{{ $item->params_json['week']['limit'] }}</td>
                <td>{{ $item->params_json['month']['limit'] }}</td>
                <td>{{ $item->params_json['balance']['limit'] }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td class="text-center">

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
--}}