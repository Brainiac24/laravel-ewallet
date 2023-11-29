
{{--<div class="form-group required">--}}
{{--    {!! Form::hidden('schedule_type_id', $scheduleTyp->id, ['class' => 'form-control']) !!}--}}
{{--</div>--}}
@foreach($fields as $key=>$field)
    <div class="form-group required">
        {!! Form::label($field['name'], $field['label'].':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            @if($field['type'] == 'select')
                {!! Form::{$field['type']}($field['name'],  $field['entity'], null, ['class' => 'form-control']) !!}
            @else
                {!! Form::{$field['type']}($field['name'], null, ['class' => 'form-control']) !!}
            @endif
        </div>
    </div>
@endforeach