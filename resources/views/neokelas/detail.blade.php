@extends('layouts/main')
@section('title','Kelas')
@section('container')
<a href="#">PENUGASAN PENGAJAR</a> | <a href="#">MAHASISWA KRS/PESERTA KELAS</a>  
<hr>
<div id="resultcontent">loading data...</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#resultcontent").load("{{ url('neokelas') }}/{{ $aksi }}/{{ $id_kelas_kuliah }}");
</script>
@endsection