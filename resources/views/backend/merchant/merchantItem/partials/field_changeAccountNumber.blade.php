<div class="form-group required">
    {!! Form::label('account_number', trans('merchantItem.backend.account_number').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        @if(Auth::user()->ability('','merchant-item-changeAccountNumber'))
            <div class='col-sm-4' style="margin-right: -40px;">
                {!! Form::text('account_number', $merchantItem->account_number, ['class' => 'form-control']) !!}
            </div>
            <div class='col-sm-2'>
                {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-danger btn-margin-top-10','form'=>'form-change-accCode']) !!}
            </div>
        @else
            {!! Form::text('account_number', null, ['class' => 'form-control','readonly']) !!}
        @endif
    </div>
</div>