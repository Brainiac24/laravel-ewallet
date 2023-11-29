@foreach($beetweenEwalletEskhataTransactions as $item)
    {
        <?php $params_json_collect = collect($item->params_json)?>
        recid: '{{$item->id}}',
        created_at: '{{$item->created_at}}',
        amount: '{{$item->amount}}',
        params_json_comment: '{{$item->getCommentForReport()}}',

        from_account_user_username: '{{$item->from_account_without_g_scopes->user_without_g_scopes->username ?? ""}}',
        from_account_user_fullname: '{{$item->from_account_without_g_scopes->user_without_g_scopes->fullNameExtendedFormat ?? ""}}',
        from_account_user_date_birth: '{{trim($item->from_account_without_g_scopes->user_without_g_scopes->contacts_json["date_birth"] ?? "")}}',
        from_account_user_street: '{{trim($item->from_account_without_g_scopes->user_without_g_scopes->address ?? "")}}',
        from_account_user_region_name: '{{trim($item->from_account_without_g_scopes->user_without_g_scopes->region->name ?? "")}}',
        from_account_user_area_name: '{{trim($item->from_account_without_g_scopes->user_without_g_scopes->area->name ?? "")}}',
        from_account_user_document_type_name: '{{trim($item->from_account_without_g_scopes->user_without_g_scopes->document_type->name ?? "")}}',
        from_account_user_document_create_date: '{{trim($item->from_account_without_g_scopes->user_without_g_scopes->contacts_json["documentCreateDate"] ?? "")}}',
        from_account_user_citizenship: '{{trim($item->from_account_without_g_scopes->user_without_g_scopes->country->name ?? "")}}',

        to_account_user_username: '{{$item->to_account_without_g_scopes->user_without_g_scopes->username ?? ""}}',
        to_account_user_fullname: '{{$item->to_account_without_g_scopes->user_without_g_scopes->fullNameExtendedFormat ?? ""}}',
        to_account_user_date_birth: '{{trim($item->to_account_without_g_scopes->user_without_g_scopes->contacts_json["date_birth"] ?? "")}}',
        to_account_user_street: '{{trim($item->to_account_without_g_scopes->user_without_g_scopes->address ?? "")}}',
        to_account_user_region_name: '{{trim($item->to_account_without_g_scopes->user_without_g_scopes->region->name ?? "")}}',
        to_account_user_area_name: '{{trim($item->to_account_without_g_scopes->user_without_g_scopes->area->name ?? "")}}',
        to_account_user_document_type_name: '{{trim($item->to_account_without_g_scopes->user_without_g_scopes->document_type->name ?? "")}}',
        to_account_user_document_create_date: '{{trim($item->to_account_without_g_scopes->user_without_g_scopes->contacts_json["documentCreateDate"] ?? "")}}',
        to_account_user_citizenship: '{{trim($item->to_account_without_g_scopes->user_without_g_scopes->country->name ?? "")}}',
    },
@endforeach