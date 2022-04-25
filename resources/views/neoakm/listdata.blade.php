@if($data->error_code == 0)
<div>Jumlah Perhalaman : {{ count($data->data) }} record, Jumlah Data {{ count($datacount->data) }} record</div>
<div>
@php    
    if(count($data->data) > 0){
        $halaman = App\Helpers\Hfungsi::paging(count($datacount->data),$limit,$offset,'neoakm/listdata');
        echo $halaman; 
    }
@endphp    
</div>

<table class="table">
    <thead><tr><th>Aksi</th><th>No</th><th>NIM</th><th>Nama Mahasiswa</th><th>Program Studi</th><th>Angkatan</th><th>Semester</th><th>Status</th><th>IPS</th><th>IPK</th><th>sks Semester</th><th>sks Total</th></tr></thead>
    <tbody>   
    @if( count($data->data) == 0)
        <tr><td colspan="12">tidak ada data</td></tr>
    @else
        @php
            $mulai = ($offset>1) ? ($offset * count($data->data)) - count($data->data) : 0;
            $no = $mulai;
        @endphp
        @foreach($data->data as $akm)
            @php
            $no++;
            @endphp
            <tr>
            <td>Aksi</td>
            <td>{{ $no }}</td>
            <td><a href="{{ url('neoakm/detail/detailakm') }}/{{ $akm->id_mahasiswa }}/{{ $akm->id_semester}}">{{ $akm->nim }}</a></td>
            <td>{{ $akm->nama_mahasiswa }}</td>
            <td>{{ $akm->nama_program_studi }}</td>
            <td>{{ $akm->angkatan }}</td>
            <td>{{ $akm->nama_semester }}</td>
            <td>{{ $akm->nama_status_mahasiswa }}</td>
            <td>{{ $akm->ips }}</td>
            <td>{{ $akm->ipk }}</td>
            <td>{{ $akm->sks_semester }}</td>
            <td>{{ $akm->sks_total }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
@else
    <div>{{ $data->error_desc }}</div>
@endif



