@extends('layouts/main')
@section('title','Dashboard')
@section('container') 
@inject('carbon', 'Carbon\Carbon')
    @if($dataptws->error_code == 0)
        <div class="container">
        @foreach($dataptws->data as $pt)
        <div class="row">
            <div class="col-md-4">Kode Perguruan Tinggi</div>
            <div class="col">{{ $pt->kode_perguruan_tinggi }}</div>
        </div>
        <div class="row">
            <div class="col-md-4">Nama Perguruan Tinggi</div>
            <div class="col">{{ $pt->nama_perguruan_tinggi }}</div>
        </div>
        <div class="row">
            <div class="col-md-4">Alamat</div>
            <div class="col">{{ $pt->jalan }}</div>
        </div>
        @endforeach
        </div>
    @endif
    <hr>
    @if($dataprodiws->error_code == 0)
        <table class="table">
        <thead><tr><th>No</th><th>Kode Prodi</th><th>Nama Prodi</th><th>Jenjang</th><th>Status</th></tr></thead>
        <tbody>
        @foreach($dataprodiws->data as $prodi)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $prodi->kode_program_studi }}</td>
            <td>{{ $prodi->nama_program_studi }}</td>
            <td>{{ $prodi->nama_jenjang_pendidikan }}</td>
            <td>{{ $prodi->status }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    @endif
    <hr>
    <h4>Peiode Lampau</h4>
    @if(!empty($GetPeriodeLampau->data))
        <table class="table">
        <thead><tr><th>No</th><th>Nama Prodi</th><th>Semester</th><th>Tanggal Mulai</th><th>Tanggal Selesai</th><th>Tipe</th></tr></thead>
        <tbody>
        @foreach($GetPeriodeLampau->data as $periode)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $periode->program_studi }}</td>
            <td>{{ $periode->semester }}</td>
            <td>{{ $carbon::parse($periode->tanggal_mulai_periode)->format('d M Y') }}</td>
            <td>{{ $carbon::parse($periode->tanggal_selesai_periode)->format('d M Y') }}</td>
            <td>{{ $periode->tipe_periode }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    @endif
@endsection