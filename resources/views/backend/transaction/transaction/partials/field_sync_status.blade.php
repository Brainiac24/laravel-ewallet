@if ($transaction->transaction_status_id == App\Services\Common\Helpers\TransactionStatus::COMPLETED && count($transactionSyncStatus)>0)
    @if(Auth::user()->ability('','transaction-changeTransactionSyncStatus'))
        <hr>
        <div class="form-group">
            {!! Form::label('transaction_sync_status_id', trans('transaction.backend.transaction_sync_status_id').':', ['class' => 'control-label col-sm-2']) !!}
            <div class='col-sm-3'>
                {!! Form::select('transaction_sync_status_id', $transactionSyncStatus, $selectedTransactionStatus??null, ['class'=>'form-control']) !!}
                {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary btn-margin-top-10','form'=>'form-change-transaction_sync_status',  'onclick'=>"return confirm('". trans('alerts.general.confirm_changed_transaction_status')."')"]) !!}
            </div>
        </div>
    @endif
@endif