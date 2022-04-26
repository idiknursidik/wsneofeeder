@if($data->error_code == 0)
<div>Jumlah Perhalaman : {{ count($data->data) }} record, Jumlah Data {{ count($datacount->data) }} record</div>
<div>
@php    
    if(count($data->data) > 0){
        $halaman = App\Helpers\Hfungsi::paging(count($datacount->data),$limit,$offset,'neodosen/listdata');
        echo $halaman; 
    }
@endphp    
</div>

<table class="table">
    <thead><tr><th>Aksi</th><th>No</th><th>Nama</th><th>NIDN</th><th>Jenis Kelamin</th><th>Agama</th><th>Status</th><th>Tangal Lahir</th></tr></thead>
    <tbody>   
    @if( count($data->data) == 0)
        <tr><td colspan="8">tidak ada data</td></tr>
    @else
        @php
            $mulai = ($offset>1) ? ($offset * count($data->data)) - count($data->data) : 0;
            $no = $mulai;
        @endphp
        @foreach($data->data as $dosen)
            @php
            $no++;
            @endphp
            <tr>
            <td>Aksi</td>
            <td>{{ $no }}</td>
            <td><a href="{{ url('neodosen/detail/biodata') }}/{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}</a></td>
            <td>{{ $dosen->nama_dosen }}</td>
            <td>{{ $dosen->nidn }}</td>
            <td>{{ $dosen->jenis_kelamin }}</td>
            <td>{{ $dosen->nama_agama }}</td>
            <td>{{ $dosen->nama_status_aktif }}</td>
            <td>{{ $dosen->tanggal_lahir }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
@else
    <div>{{ $data->error_desc }}</div>
@endif

