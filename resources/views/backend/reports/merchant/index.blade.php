@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>Отчет мерчанта</h1>
@stop

@section('content')
    
    <div class="box box-solid">
        {{-- @ability('sadmin', 'role-operation-create') --}}
        {{-- @endability --}}
        <div class="box-body">
            @include('backend.errors.success')
            @include('backend.errors.error')

        <?php
                
                foreach ($data as $merchant_data) {
 
                    echo '<h2>' . $merchant_data['name'] . '</h2>';
                    echo '<table>';
                    echo '<tr> <th>Дата</th> <th>Код</th> <th>Плательщик</th> <th>Операция</th> <th>Получатель</th> <th>Сумма</th></tr>';
                    echo '';
                    foreach ($merchant_data['transactions'] as $transaction_data) {
                        echo '<tr>';
                        echo '<td>' . $transaction_data['doc_date'] . '</td>';
                        echo '<td>' . $transaction_data['doc_num'] . '</td>';
                        echo '<td>' . $transaction_data['from_account'] . '</td>';
                        echo '<td>' . $transaction_data['service'] . '</td>';
                        echo '<td>' . $transaction_data['to_account'] . '</td>';
                        echo '<td>' . $transaction_data['amount'] . '</td>';

                        echo '<td>';
                        echo '<table>';
                            echo '<tr> <th>Дата</th> <th>Код</th> <th>Плательщик</th> <th>Операция</th> <th>Получатель</th> <th>Сумма</th></tr>';
                        foreach ($transaction_data['transaction_childs'] as $transaction_child) {
                            echo '<tr>';
                            echo '<td>' . $transaction_child['doc_date'] . '</td>';
                            echo '<td>' . $transaction_child['doc_num'] . '</td>';
                            echo '<td>' . $transaction_child['from_account'] . '</td>';
                            echo '<td>' . $transaction_child['service'] . '</td>';
                            echo '<td>' . $transaction_child['to_account'] . '</td>';
                            echo '<td>' . $transaction_child['amount'] . '</td>';
                        }
                        echo '</table>';
                        echo '</td></tr>';
                    }

                    echo '</table>';
                }
            ?>
        </div><!-- /.box-body -->
        <div class="box-footer">
            {{-- $currencyRateHistories->render() --}}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop


<style>
    table {
        border-collapse: collapse !important;
    }
    td {
        border: 1px solid #333 !important;
        padding: 7px !important;
        vertical-align: top !important;
    }
</style>