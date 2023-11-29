<hr>
<div class="form-group required">
    {!! Form::label('parameters', trans('commission.backend.params_exists').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-6'>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <th>{{ trans('commission.backend.table.min') }}</th>
                        <th>{{ trans('commission.backend.table.max') }}</th>
                        <th>{{ trans('commission.backend.table.value') }}</th>
                        <th>{{ trans('commission.backend.table.is_persentage') }}</th>
                        <th class="col-xs-1">{{ trans('actions.general.action') }}</th>
                        </thead>
                        <tbody>
                        @foreach($commission->params_json as $item)
                            <tr>
                                <td>{{ $item['min'] }}</td>
                                <td>{{ $item['max'] }}</td>
                                <td>{{ $item['value'] }}</td>
                                <td>{{ trans('InterfaceTranses.procentage.'.$item['is_percentage']) }}</td>
                                <td class="text-center">
                                    {!! Form::open(['route' => ['admin.services.commissions.deleteCommissionData',$commission->id ],'class'=>'form-horizontal']) !!}
                                    <input type="hidden" name="params[id]" value="{{ $item['id'] }}">
                                    {!! Form::submit(trans('actions.general.delete'), ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
        </div>
    </div>
</div>
