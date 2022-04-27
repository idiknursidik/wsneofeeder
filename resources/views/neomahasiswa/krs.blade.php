<div class="card">
    <div class="card-header"> Data Mahasiswa </div>
    <div class="card-body">
        <div class="row">
            <div class="col form-group">
                <label>NIM</label>
                <input type="text" name="nim" value="{{ $databiodata->data[0]->nim }}" class="form-control">
            </div>   
            <div class="col form-group">
                <label>Nama</label>
                <input type="text" name="nama_mahasiswa" value="{{ $databiodata->data[0]->nama_mahasiswa }}" class="form-control">
            </div>         
        </div>
        <div class="row">    
            <div class="col form-group">
                <label>Prodi</label>
                <input type="text" name="nama_program_studi" value="{{ $databiodata->data[0]->nama_program_studi }}" class="form-control">
            </div>
            <div class="col form-group">
                <label>Angkatan</label>
                <input type="text" name="id_periode_masuk" value="{{ substr($databiodata->data[0]->id_periode_masuk,0,4) }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header"> KRS Mahasiswa </div>
    <div class="card-body">
        <select name="id_semester">
            @foreach($GetTahunAjaran->data as $semester)
                @foreach(App\Models\Mfungsi::semester() as $key=>$val)
                    <option value="{{ $semester->id_tahun_ajaran }}{{ $key }}"
                    @if($semester->a_periode_aktif == 1 && $key==1) selected="selected" @endif
                    >{{ $semester->nama_tahun_ajaran }} {{ $val }}</option>
                @endforeach
            @endforeach
        </select>
        <table class="table">
            <thead>
                <tr><th>Action</th><th>No</th><th>Kode MK</th><th>Nama MK</th><th>Kelas</th><th>Bobot MK (sks)</th></tr>
            </thead>
            <tbody>
            @if(empty($krs->data))
                <tr><td colspan="6">Tidak ada data</tr>
            @else
                @foreach($krs->data as $krs)
                    <tr>
                    <td></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $krs->kode_mata_kuliah }}</td>
                    <td>{{ $krs->nama_mata_kuliah }}</td>
                    <td>{{ $krs->nama_kelas_kuliah }}</td>
                    <td>{{ $krs->sks_mata_kuliah }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>