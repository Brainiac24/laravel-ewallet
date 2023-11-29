<option>--- Select ---</option>

@if(!empty($data))

    @foreach($data as $key => $value)

        <option value="{{ $key }}">{{ $value }}</option>

    @endforeach

@endif