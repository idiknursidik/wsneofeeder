<pre>
{{ print_r($data) }}
</pre>
<pre>
{{ print_r($datadetail->data[0]) }}
</pre><pre>
{{ print_r($datamatakuliah->data[0]) }}
</pre>

<div class="card">
    <div class="card-header"> Kelas Kuliah </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <label>Program Studi </label> 
                <input type="text" class="form-control" name="nama_program_studi" value="{{ $datadetail->data[0]->nama_program_studi }}">
            </div>
            <div class="col">
                <label>Semester </label>  
                <input type="text" class="form-control" name="nama_semester" value="{{ $datadetail->data[0]->nama_semester }}">
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <label>Mata Kuliah</label>  
                <input type="text" class="form-control" name="kode_mata_kuliah" value="{{ $datadetail->data[0]->kode_mata_kuliah }}">
            </div>
            <div class="col">
                <label>Nama Kelas</label>   
                <input type="text" class="form-control" name="nama_kelas_kuliah" value="{{ $datadetail->data[0]->nama_kelas_kuliah }}">
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <label>Bobot Mata Kuliah</label> 
                <input type="text" class="form-control" name="sks_tatap_muka" value="{{ $datamatakuliah->data[0]->sks_tatap_muka }}">
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
                <input type="text" class="form-control" name="kode_mata_kuliah" value="{{ $datadetail->data[0]->kode_mata_kuliah }}">
            </div>
            <div class="col">
                <label>Mode Kuliah</label> 
                <input type="text" class="form-control" name="nama_kelas_kuliah" value="{{ $datadetail->data[0]->nama_kelas_kuliah }}">
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <label>Tanggal Mulai Efektif </label> 
                <input type="text" class="form-control" name="tanggal_mulai_efektif" value="{{ $datadetail->data[0]->tanggal_mulai_efektif }}">
            </div>
            <div class="col">
                <label>Tanggal Akhir Efektif</label> 
                <input type="text" class="form-control" name="tanggal_akhir_efektif" value="{{ $datadetail->data[0]->tanggal_akhir_efektif }}">
            </div>
        </div>
    </div>
</div>  