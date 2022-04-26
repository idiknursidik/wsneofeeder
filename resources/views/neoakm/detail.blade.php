@extends('layouts/main')
@section('title','Aktivitas Kuliah Mahasiswa')
@section('container')
<a href="{{ url('neoakm') }}">DAFTAR</a>
<hr>
<div id="resultcontent">loading data...</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#resultcontent").load("{{ url('neoakm') }}/{{ $aksi }}/{{ $id_mahasiswa }}/{{ $id_semester }}");
</script>
@endsection