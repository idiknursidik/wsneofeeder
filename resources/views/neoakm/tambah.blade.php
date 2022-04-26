@extends('layouts/main')
@section('title','Aktivitas Kuliah Mahasiswa')
@section('container') 
<div class="card">
    <div class="card-header"> Aktivitas Kuliah Mahasiswa</div>
    <div class="card-body">
        <form method="post" id="form-tambah" action="{{ url('neoakm/insert') }}">
            @csrf
            <div class="row">
                <div class="col">
                    <label>Mahasiswa</label> 
                    <select class="form-control" name="id_registrasi_mahasiswa">
                        @foreach($datamahasiswa->data as $mhs)
                            <option value="{{ $mhs->id_registrasi_mahasiswa }}"> {{ $mhs->nim }}-{{ $mhs->nama_mahasiswa }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col"> 
                    <label>Semester</label> 
                    <select class="form-control" name="id_semester">
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
                    <label>Status Mahasiswa</label>  
                    <select class="form-control" name="id_status_mahasiswa">
                        @foreach($GetStatusMahasiswa->data as $statusmhs)
                            <option value="{{ $statusmhs->id_status_mahasiswa }}"> {{ $statusmhs->nama_status_mahasiswa }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>IPS</label>  
                    <input type="text" class="form-control" name="ips">
                </div>
            </div> 
            <div class="row">
                <div class="col">
                    <label>IPK</label>  
                    <input type="text" class="form-control" name="ipk">
                    <small>*untuk decimal menggunakan titik</small>
                </div>
                <div class="col">
                    <label>sks Semester [<a href="#" data-bs-target="#modalku" class="modalButton" data-bs-toggle="modal" data-src="#" title="TamKRS mahasiswa">KRS</a>]</label>  
                    <input type="text" class="form-control" name="sks_semester">
                </div>
            </div> 
            <div class="row">
                <div class="col">
                    <label>sks Total</label>  
                    <input type="text" class="form-control" name="sks_total" >
                    <small>*untuk decimal menggunakan titik</small>
                </div>
                <div class="col">
                    <label>Biaya Kuliah (semester)</label>  
                    <input type="text" class="form-control" name="biaya_kuliah_smt" >
                </div>
            </div>
            <hr>
            <button class="btn btn-primary btn-submit" type="submit">Simpan</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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