<h3>Request</h3>
<table class="table">
    <thead><tr><th>No</th><th>Nama Field</th><th>Type</th><th>Keterangan</th></tr></thead>
    <tbody>
        @php $no=0; @endphp
        @foreach($data->data->request as $key=>$val)
            @if(!in_array($key,array('error_code','error_desc','data','token')))
            @php $no++ @endphp
            <tr>
                <td>{{ $no  }}</td>
                <td>{{ str_replace(array('record[',']','key['),array(""),$key) }}</td>
                <td>@if(!empty($val->type)) {{ $val->type }} @else @endif</td>
                <td>@if(!empty($val->keterangan)) {{ $val->keterangan }} @else @endif</td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>

<h3>Response</h3>
<table class="table">
    <thead><tr><th>No</th><th>Nama Field</th><th>Keterangan</th></tr></thead>
    <tbody>
        @php $no=0; @endphp
        @foreach($data->data->response as $key=>$val)
            @if(!in_array($key,array('error_code','error_desc','data')))
            @php $no++ @endphp
            <tr>
                <td>{{ $no  }}</td>
                <td>{{ str_replace(array('data[',']'),array(""),$key) }}</td>
                <td>@if($val->keterangan) {{ $val->keterangan }} @else @endif</td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>

<pre>
{{ print_r($data) }}
</pre>