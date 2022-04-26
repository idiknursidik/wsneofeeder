@if($data->error_code == 0)
<div>Jumlah Perhalaman : {{ count($data->data) }} record, Jumlah Data {{ count($datacount->data) }} record</div>
<div>
@php    
    if(count($data->data) > 0){
        $halaman = App\Helpers\Hfungsi::paging(count($datacount->data),$limit,$offset,'neomahasiswa/listdata');
        echo $halaman; 
    }
@endphp    
</div>

<table class="table">
    <thead><tr><th>Aksi</th><th>No</th><th>Nama</th><th>NIM</th><th>Jenis Kelamin</th><th>Total SKS diambil</th><th>Tangal Lahir</th><th>Program Studi</th><th>Status</th><th>Angkatan</th></tr></thead>
    <tbody>   
    @if( count($data->data) == 0)
        <tr><td colspan="10">tidak ada data</td></tr>
    @else
        @php
            $mulai = ($offset>1) ? ($offset * count($data->data)) - count($data->data) : 0;
            $no = $mulai;
        @endphp
        @foreach($data->data as $mhs)
            @php
            $no++;
            @endphp
            <tr>
            <td>Aksi</td>
            <td>{{ $no }}</td>
            <td><a href="{{ url('neomahasiswa/detail/biodata') }}/{{ $mhs->id_mahasiswa }}">{{ $mhs->nama_mahasiswa }}</a></td>
            <td>{{ $mhs->nim }}</td>
            <td>{{ $mhs->jenis_kelamin }}</td>
            <td>{{ $mhs->total_sks }}</td>
            <td>{{ $mhs->tanggal_lahir }}</td>
            <td>{{ $mhs->nama_program_studi }}</td>
            <td>{{ $mhs->nama_status_mahasiswa }}</td>
            <td>{{ $mhs->id_periode }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
@else
    <div>{{ $data->error_desc }}</div>
@endif

