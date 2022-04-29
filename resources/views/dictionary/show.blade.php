<table class="table">
    <thead><tr><th>No</th><th>Nama Field</th><th>Keterangan</th></tr></thead>
    <tbody>
        @foreach($data->data->response as $key=>$val)
            @if(!in_array($key,array('error_code','error_desc')))
            <tr>
                <td>{{ ($loop->iteration-2)  }}</td>
                <td>{{ str_replace(array('data[',']'),array(""),$key) }}</td>
                <td>{{ $val->keterangan }}</td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>

<pre>
{{ print_r($data) }}
</pre>