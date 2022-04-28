@extends('layouts/main')
@section('title','Kelas')
@section('container') 
<div class="card">
    <div class="card-header"> Kelas Kuliah </div>
    <div class="card-body">
        <form method="post" id="form-tambah" action="{{ url('neokelas/insert') }}">
            @csrf
            <div class="row">
                <div class="col">
                    <label>Program Studi </label> 
                    <select class="form-control" name="id_prodi">
                        @foreach($dataprodi->data as $prodi)
                            <option value="{{ $prodi->id_prodi }}" @if($prodi->id_prodi == old("id_prodi")) selected="selected" @endif>{{ $prodi->nama_program_studi }} - {{ $prodi->nama_jenjang_pendidikan }}
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Semester </label>  
                    <select class="form-control" name="id_semester" id="id_semester">
                        @foreach($GetTahunAjaran->data as $thnajaran)
                            @foreach($semester as $key=>$val)
                                <option value="{{ $thnajaran->id_tahun_ajaran }}{{ $key }}" @if($thnajaran->a_periode_aktif == 1 && $key==1) selected="selected" @endif> {{ $thnajaran->nama_tahun_ajaran }} {{ $val }} </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">    
                <div class="col">
                    <label>Mata Kuliah</label>  
                    <select class="form-control" name="id_matkul" id="id_matkul">
                        @foreach($GetMataKuliah->data as $matkul)
                            <option value="{{ $matkul->id_matkul }}" @if($matkul->id_matkul == old("id_matkul")) selected="selected" @endif>{{ $matkul->kode_mata_kuliah }} - {{ $matkul->nama_mata_kuliah }} - {{ $matkul->nama_kurikulum }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Nama Kelas</label>   
                    <input type="text" class="form-control" name="nama_kelas_kuliah" value="{{ old('nama_kelas_kuliah') }}">
                </div>
            </div>
            <div class="row">    
                <div class="col">
                    <label>Lingkup</label> 
                    <select class="form-control" name="lingkup" id="lingkup"> 
                        <option value="null" selected="selected">--lingkup kelas--</option>
                        @foreach($lingkupkelas as $key=>$val)
                            <option value="{{ $key }}" @if($key == old("lingkup")) selected="selected" @endif>{{ $val }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Mode Kuliah</label> 
                    <select class="form-control" name="mode" id="mode">
                        <option value="null" selected="selected">--mode kuliah--</option>
                        @foreach($modekuliah as $key=>$val)
                            <option value="{{ $key }}" @if($key == old("mode")) selected="selected" @endif>{{ $val }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">    
                <div class="col">
                    <label>Tanggal Mulai Efektif </label> 
                    <input type="date" class="form-control" name="tanggal_mulai_efektif" value="{{ old('tanggal_mulai_efektif') }}">
                </div>
                <div class="col">
                    <label>Tanggal Akhir Efektif </label> 
                    <input type="date" class="form-control" name="tanggal_akhir_efektif" value="{{  old('tanggal_akhir_efektif') }}">
                </div>
            </div>
            <hr>
            <div><button type="submit" class="btn btn-primary">Simpan</button></div>
        </form>        
    </div>
</div>  
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#id_matkul,#id_semester').select2({
        theme: 'bootstrap-5'
    });
    $("#form-tambah").on("submit",function(e){
        e.preventDefault();
        var dString = $(this).serialize();
        var url =  $(this).attr("action");
        $.ajax({
           url:url,
           method:'POST',
           data:dString,
           success:function(response){
              if(response.success == true){
                  alert(response.messages) //Message come from controller
                  window.location.href = "{{ url('neokelas/detail/detailkelas') }}/"+response.id_kelas_kuliah; 
                }else{
                  alert(response.messages)
              }
           },
           error:function(error){
              console.log(error)
           }
        });
	});
</script>
@endsection