@if($data->error_code == 0)
<div>Jumlah Perhalaman : {{ count($data->data) }} record, Jumlah Data {{ count($datacount->data) }} record</div>
<div>
@php    
    if(count($data->data) > 0){
        $halaman = App\Helpers\Hfungsi::paging(count($datacount->data),$limit,$offset,'neokelas/listdata');
        echo $halaman; 
    }
@endphp    
</div>

<table class="table">
    <thead><tr><th>Aksi</th><th>No</th><th>Semester</th><th>Kode MK</th><th>Nama Matakuliah</th><th>Nama Kelas</th><th>Bobot MK (sks)</th><th>Dosen Mengajar</th><th>Peserta Kelas</th></tr></thead>
    <tbody>   
    @if( count($data->data) == 0)
        <tr><td colspan="9">tidak ada data</td></tr>
    @else
        @php
            $mulai = ($offset>1) ? ($offset * count($data->data)) - count($data->data) : 0;
            $no = $mulai;
        @endphp
        @foreach($data->data as $kelas)
            @php
            $no++;
            @endphp
            <tr>
            <td>Aksi</td>
            <td>{{ $no }}</td>
            <td>{{ $kelas->nama_semester }}</td>
            <td><a href="{{ url('neokelas/detail/detailkelas') }}/{{ $kelas->id_kelas_kuliah }}">{{ $kelas->kode_mata_kuliah }}</a></td>
            <td>{{ $kelas->nama_mata_kuliah }}</td>
            <td>{{ $kelas->nama_kelas_kuliah }}</td>
            <td>{{ $kelas->sks }}</td>
            <td>{{ $kelas->nama_dosen }}</td>
            <td>{{ $kelas->jumlah_mahasiswa }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
@else
    <div>{{ $data->error_desc }}</div>
@endif



