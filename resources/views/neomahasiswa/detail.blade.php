@extends('layouts/main')
@section('title','Mahasiswa')
@section('container')
<a href="{{ url('neomahasiswa/detail/biodata') }}/{{ $id_mahasiswa }}">DETAIL MAHASISWA</a> | 
<a href="{{ url('neomahasiswa/detail/historiypendidikan') }}/{{ $id_mahasiswa }}">HISTORI PENDIDIKAN</a> | <a href="{{ url('neomahasiswa/detail/krs') }}/{{ $id_mahasiswa }}">KRS MAHASISWA</a> | <a href="{{ url('neomahasiswa/detail/nilai') }}/{{ $id_mahasiswa }}">HISTORI NILAI</a> | AKTIVITAS PERKULIAHAN | PRESTASI | TRANSKRIP 
<hr>
<div id="resultcontent">loading data...</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#resultcontent").load("{{ url('neomahasiswa') }}/{{ $aksi }}/{{ $id_mahasiswa }}");
</script>
@endsection