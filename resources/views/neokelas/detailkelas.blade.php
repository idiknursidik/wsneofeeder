<div class="card">
    <div class="card-header"> Kelas Kuliah </div>
    <div class="card-body">
        <form method="post" id="form-edit" action="{{ url('neokelas/update') }}">            
            @csrf
            <input type="hidden" name="id_kelas_kuliah" value="{{ $id_kelas_kuliah }}">
        <div class="row">
            <div class="col">
                <label>Program Studi </label> 
                <input type="text" class="form-control" readonly value="{{ $datadetail->data[0]->nama_program_studi }}">
                <input type="hidden" name="id_prodi" value="{{ $datadetail->data[0]->id_prodi }}">
            </div>
            <div class="col">
                <label>Semester </label>  
                <input type="text" class="form-control" readonly value="{{ $datadetail->data[0]->nama_semester }}">
                <input type="hidden" name="id_semester" value="{{ $datadetail->data[0]->id_semester }}">
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
                <input type="text" class="form-control" name="nama_kelas_kuliah" value="{{ $datadetail->data[0]->nama_kelas_kuliah }}">
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <label>Bobot Mata Kuliah</label> 
                <input type="text" class="form-control" name="sks_mata_kuliah" value="{{ $data->data[0]->sks }}">
            </div>
            <div class="col">
                <label>Bobot Tatap Muka</label> 
                <input type="text" class="form-control" name="sks_tatap_muka" value="{{ $datamatakuliah->data[0]->sks_tatap_muka }}">
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <label>Bobot Praktikum</label> 
                <input type="text" class="form-control" name="sks_praktek" value="{{ $datamatakuliah->data[0]->sks_praktek }}">
            </div>
            <div class="col">
                <label>Bobot Praktek Lapangan</label> 
                <input type="text" class="form-control" name="sks_praktek_lapangan" value="{{ $datamatakuliah->data[0]->sks_praktek_lapangan }}">
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <label>Bahasan</label> 
                <textarea class="form-control" name="bahasan">{{ $datadetail->data[0]->bahasan }}</textarea>
            </div>
            <div class="col">
                <label>Bobot Simulasi</label> 
                <input type="text" class="form-control" name="sks_simulasi" value="{{ $datamatakuliah->data[0]->sks_simulasi }}">
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <label>Lingkup</label> 
                <select class="form-control" name="lingkup" id="lingkup"> 
                    <option value="null" selected="selected">--lingkup kelas--</option>
                    @foreach($lingkupkelas as $key=>$val)
                        <option value="{{ $key }}" @if($key == 0) selected="selected" @endif>{{ $val }} </option>
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
                <input type="date" class="form-control" name="tanggal_mulai_efektif" value="{{ $datadetail->data[0]->tanggal_mulai_efektif }}">
            </div>
            <div class="col">
                <label>Tanggal Akhir Efektif</label> 
                <input type="date" class="form-control" name="tanggal_akhir_efektif" value="{{ $datadetail->data[0]->tanggal_akhir_efektif }}">
            </div>
        </div>
        <hr>
            <div><button type="submit" class="btn btn-primary">Simpan</button></div>
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
    $("#form-edit").on("submit",function(e){
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
<pre>
{{ print_r($data) }}
</pre>
<pre>
{{ print_r($datadetail->data[0]) }}
</pre><pre>
{{ print_r($datamatakuliah->data[0]) }}
</pre>
<pre>
{{ print_r($GetMataKuliahDetail->data[0]) }}
</pre>