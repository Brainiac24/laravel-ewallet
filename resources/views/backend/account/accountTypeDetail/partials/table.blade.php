<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <th style="width: 1px;">
                <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
            </th>
            <th>{{ trans('accountTypeDetail.backend.table.code') }}</th>
            <th>{{ trans('accountTypeDetail.backend.table.name') }}</th>
            <th>{{ trans('accountTypeDetail.backend.table.account_type') }}</th>
            <th>{{ trans('accountTypeDetail.backend.table.created_at') }}</th>
            <th>{{ trans('accountTypeDetail.backend.table.updated_at') }}</th>
            <th class="col-xs-1">{{ trans('actions.general.action') }}</th>
        </thead>
        <tbody>

            @foreach($accountTypeDetails as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{ $item->code}}</td>
                <td>{{ link_to(route('admin.accounts.types-detail.show', [$item->id]), $item->name) }}</td>
                <td>{{ $item->accountType->name}}</td>
                <td>{{ $item->created_at}}</td>
                <td>{{ $item->updated_at}}</td>
                <td class="text-center">
                    {{-- @if(Auth::user()->ability('sadmin','role-operation-edit')) --}}

                    <a class="btn btn-primary btn-xs" href="{!! route('admin.accounts.types-detail.edit', [$item->id]) !!}"><i class="fa fa-pencil"></i></a>                    {{-- @endif --}} {{-- @if(Auth::user()->ability('sadmin','role-operation-delete')) --}}
                    <a class="btn btn-danger btn-xs" href="{!! route('admin.accounts.types-detail.delete', [$item->id]) !!}" onclick="return confirm('{{ trans('alerts.general.confirm_delete') }}')"><i class="fa fa-trash-o"></i></a>                    {{-- @endif --}}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>