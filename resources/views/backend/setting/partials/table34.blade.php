<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>
        <th>{{ trans('setting.backend.key') }}</th>
        <th>{{ trans('setting.backend.value') }}</th>
        <th class="col-xs-1">{{ trans('actions.general.action') }}</th>
        </thead>
        <tbody>
            @foreach($settings as $key=>$value)
                <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $key}}"></td>
                <td>{{ $key }}</td>
                <td>{{ $value }}</td>
                <td class="text-center">
                        {{-- @if(Auth::user()->ability('sadmin','role-operation-edit')) --}}

                            <a class="btn btn-primary btn-xs" href="{!! route('admin.settings.edit', [$key]) !!}"><i class="fa fa-pencil"></i></a>
                        {{-- @endif --}}
                        {{-- @if(Auth::user()->ability('sadmin','role-operation-delete')) --}}

                        {{-- @endif --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>