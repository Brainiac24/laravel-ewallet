@foreach($transactions_to_array as $item)
    {!! json_encode($item, JSON_UNESCAPED_UNICODE) !!},
@endforeach