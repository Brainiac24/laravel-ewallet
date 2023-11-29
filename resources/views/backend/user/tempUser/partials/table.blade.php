@foreach($tempUsers as $item)
    {
    recid: '{{$item->id}}',
    code_map: '{{$item->code_map}}',
    username: '{{$item->last_name}}'+' '+'{{$item->first_name}}'+' '+'{{$item->middle_name}}',
    msisdn: '{{$item->msisdn}}',
    contacts_json: '{{json_encode($item->contacts_json,JSON_UNESCAPED_UNICODE)}}',
    country_id: '{{$item->country->name ?? ""}}',
    country_born_id: '{{$item->country_born->name ?? ""}}',
    region_id: '{{$item->region->name ?? ""}}',
    area_id: '{{$item->area->name ?? ""}}',
    city_id: '{{$item->city->name ?? ""}}',
    document_type_id: '{{$item->document_type->name ?? ""}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach