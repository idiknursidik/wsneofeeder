<pre>
{{ print_r($data) }}
</pre>
<pre>
{{ print_r($datadetail->data[0]) }}
</pre>
<div class="card">
    <div class="card-header"> Kelas Kuliah </div>
    <div class="card-body">
        <div class="row">
            <div class="col"> 
                <input type="text" class="form-control" name="nama_program_studi" value="{{ $datadetail->data[0]->nama_program_studi }}">
            </div>
            <div class="col"> 
                <input type="text" class="form-control" name="nama_semester" value="{{ $datadetail->data[0]->nama_semester }}">
            </div>
            <div class="col"> 
                <input type="text" class="form-control" name="kode_mata_kuliah" value="{{ $datadetail->data[0]->kode_mata_kuliah }}">
            </div>
            <div class="col"> 
                <input type="text" class="form-control" name="nama_kelas_kuliah" value="{{ $datadetail->data[0]->nama_kelas_kuliah }}">
            </div>
            <div class="col"> 
                <input type="text" class="form-control" name="kode_mata_kuliah" value="{{ $datadetail->data[0]->kode_mata_kuliah }}">
            </div>
            <div class="col"> 
                <input type="text" class="form-control" name="nama_kelas_kuliah" value="{{ $datadetail->data[0]->nama_kelas_kuliah }}">
            </div>
        </div>
    </div>
</div>  