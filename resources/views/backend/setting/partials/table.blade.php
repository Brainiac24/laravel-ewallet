@foreach($settings as $key=>$value)
    {   recid: '{{ $key }}',
    {{--key: '<a href="{{$key}}/edit">{{$key}}</a>',--}}
    key: '{{$key}}',
    value: '{{json_encode($value,JSON_UNESCAPED_UNICODE)}}',
    },
@endforeach


