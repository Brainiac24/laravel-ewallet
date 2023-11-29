<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>

        <th>Название файла</th>
        <th>Дата создания</th>
        <th>Ссылка</th>
        </thead>
        <tbody>
        @foreach($files as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item['file'] }}"></td>
                <td>{{ $item['file'] }}</td>
                <td>{{ $item['last_modified'] }}</td>
                <td>{!! empty($item['link']) ? '' :  sprintf('<a href="%s">Скачать</a>', $item['link'])!!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>