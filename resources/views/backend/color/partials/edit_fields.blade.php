{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--}}

<div class="form-group required">
    {!! Form::label('code', trans('color.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('color', trans('color.backend.color').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('color', null, ['class' => 'form-control']) !!}
    </div>
</div>

{{--<div class="form-group required">--}}
    {{--{!! Form::label('color', trans('color.backend.color').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-1'>--}}
        {{--{!! Form::color('selColor', null, ['class' => 'form-control','onClick' => 'SetTextBoxValue()','id'=>'selColor'],$color->color) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('color.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled') , $color->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>

{{--<script type="text/javascript">--}}


    {{--function SetTextBoxValue() {--}}
        {{--console.log(document.getElementById('selColor').value);--}}
        {{--document.getElementById('color').value = document.getElementById('selColor').value;--}}
    {{--}--}}

{{--</script>--}}