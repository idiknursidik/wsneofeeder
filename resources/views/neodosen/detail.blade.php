@extends('layouts/main')
@section('title','Dosen')
@section('container')
<a href="{{ url('neodosen/detail/biodata') }}/{{ $id_dosen }}">DETAIL DOSEN</a> | 
<a href="#">PENUGASAN DOSEN</a> | <a href="#">AKTIVITAS MENGAJAR DOSEN</a> | <a href="#">RIWAYAT FUNGSIONAL</a> | RIWAYAT KEPANGKATAN | RIWAYAT PENDIDIKAN | RIWAYAT SERTIFIKASI | RIWAYAT PENELITIAN | BIMBINGAN AKTIVITAS MAHASISWA | PENGUJI AKTIVITAS MAHASISWA 
<hr>
<div id="resultcontent">loading data...</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#resultcontent").load("{{ url('neodosen') }}/{{ $aksi }}/{{ $id_dosen }}");
</script>
@endsection